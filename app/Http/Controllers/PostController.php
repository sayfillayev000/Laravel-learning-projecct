<?php

namespace App\Http\Controllers;

use App\Events\PostCreadet;
use App\Events\PostCreated;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Jobs\ChangePost;
use App\Jobs\UploadBigFile;
use App\Mail\PostCreated as MailPostCreated;
use App\Models\Category;
use App\Models\Role;
use App\Models\Tag;
use App\Notifications\PostCreated as NotificationsPostCreated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->authorizeResource(Post::class, 'post');
    }

    public function index()
    {


        // $response = Http::get('http://rulionline.uz/api/api/question/12');

        // dd($response->object());
        $error = 'bu logga yozildi';
        Log::emergency($error);
        Log::alert($error);
        Log::critical($error);
        Log::error($error);
        Log::warning($error);
        Log::notice($error);
        Log::info($error);
        Log::debug($error);

        // $posts = Post::latest()->paginate(9);
        // $posts = Post::latest()->get();
        $post = (Post::cursor()->filter(function ($post) {
            return $post->id == 1;
        }));

        // dd($post);
        $posts = Cache::remember('posts', now()->addSeconds(60), function () {
            return Post::latest()->paginate(9);
        });

        return view('posts.index')->with('posts', $posts);
    }
    public function create()
    {
        // dd(Role::find(3));
        // dd(Role::where('name', 'editor')->first());
        if (!Gate::authorize('create-post', Role::where('name', 'editor')->first())) {
            abort(403);
        }

        return view('posts.create')->with([
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }


    public function store(StorePostRequest $request)
    {

        if ($request->hasFile('photo')) {

            $file = $request->file('photo');

            $name = $file->getClientOriginalName();

            $path = $file->storeAs('photo', $name);
        }

        $post = Post::create([
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'phone_number' => $request->phone_number,
            'short_content' => $request->short_content,
            'content' => $request->content,
            'photo' => $path ?? null
        ]);

        if (isset($request->tags)) {
            foreach ($request->tags as $tag) {
                $post->tags()->attach($tag);
            }
        }

        PostCreated::dispatch($post);

        // UploadBigFile::dispatch($request->file('photo'));

        ChangePost::dispatch($post)->onQueue('uploading');

        Mail::to($request->user())->later(now()->addMinutes(1), (new MailPostCreated($post))->onQueue('sending-mails'));

        Notification::send(auth()->user(), new NotificationsPostCreated($post));

        return redirect()->route('posts.index')->with('status', 'Post created successfully!');
    }

    public function show(Post $post)
    {
        return view('posts.show')->with([
            'post' => $post,
            'recent_posts' => Post::latest()->get()->except($post->id)->take(5),
            'categories' => Category::all(),
            'tags' => Tag::all(),
            // 'auth' => Auth::user(),
        ]);
    }

    public function edit(Post $post)
    {
        // if (! Gate::allows('update-post', $post)) {
        //     abort(403);
        // }
        // Gate::authorize('update-post', $post);

        // Gate::authorize('update',$post);

        // $this->authorize('update',$post);

        return view('posts.edit')->with(['post' => $post]);
    }


    public function update(UpdatePostRequest $request, Post $post)
    {
        // Gate::authorize('update',$post);

        if ($request->hasFile('photo')) {
            if (isset($post->photo)) {
                Storage::delete($post->photo);
            }
            $file = $request->file('photo');
            $name = $file->getClientOriginalName();
            $path = $file->storeAs('photo', $name);
        }


        $post->update([
            'title' => $request->title,
            'phone_number' => $request->phone_number,
            'short_content' => $request->short_content,
            'content' => $request->content,
            'photo' => $path ?? $post->photo,
        ]);

        return redirect()->route('posts.show', ['post' => $post->id]); // ishladi
    }


    public function destroy(Post $post)
    {
        if (isset($post->photo)) {
            Storage::delete($post->photo);
        }
        $post->delete();

        return redirect()->route('posts.index');
    }
}
