<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\StorecommentRequest;
use App\Http\Requests\UpdatecommentRequest;
use App\Models\Post;

class CommentController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(StorecommentRequest $request)
    {
        // return json_encode($request->body);
        $comments = Comment::create([
            'body' => $request->body,
            'post_id' => $request->post_id,
            'user_id' => auth()->id(),
          ]);

        // Post::find($request->post_id)->comments()->create([
        //     'body' => $request->body,
        //     'user_id' => $request->post_id,
        // ]);
        return redirect()->back();
    }

    public function show(comment $comment)
    {
        //
    }


    public function edit(comment $comment)
    {
        //
    }

    public function update(UpdatecommentRequest $request, comment $comment)
    {
        //
    }

    public function destroy(comment $comment)
    {
        //
    }
}
