<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = DB::table('posts')->get(); // nega bunaqa usullar bilan ishlagansiz Model bilan emas chunki ishlamadi 

        return view('posts.index')->with('posts', $posts);
    }

    public function create()
    {
        return view('posts.create');
    }
    public function store(StorePostRequest $request)
    {
        if ($request->hasFile('photo')) {

            $file = $request->file('photo');
            $name = $file->getClientOriginalName();
            $path = $file->storeAs('photo', $name);
        }

        Post::create([
            'title' => $request->title,
            'phone_number' => $request->phone_number,
            'short_content' => $request->short_content,
            'content' => $request->content,
            'photo' => $path ?? null
        ]);

        return redirect()->route('posts.index');
    }
    public function show($id)
    {
        $post = DB::table('posts')->find($id);
        $recent_posts = DB::table('posts')->latest()->get()->except($post->id)->take(5);

        return view('posts.show')->with(['post' => $post, 'recent_posts' => $recent_posts]);
    }
    public function edit($id)
    {
        $post = DB::table('posts')->find($id);
        
        return view('posts.edit')->with(['post' => $post]);
    }
    public function update(Request $request,$id)
    {
        // dd($id);
        $post = DB::table('posts')->where('id', '=', $id)->first();

        // dd($post);


        // $post = DB::table('posts')->find($post->id);

        if ($request->hasFile('photo')) {
            if (isset($post->photo)){
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
            'photo' => $path ?? $post->photo
        ]);
        return redirect()->route('users');
     }
    public function destroy($id)
    {
        //
    }
}
