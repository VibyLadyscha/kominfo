<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Post $post)
    {
        return view('comment.create', ['post' => $post]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post = Post::find($request->post_id);
        $date = carbon::now()->format('ymd');

        $this->validate($request, [
            'comment_content' => 'required',
            'post_id' => 'required|exists:posts,id'
        ]);

        $comment = new Comment();
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $request->post_id;
        $comment->comment_content = $request->comment_content;
        $comment->save();
        
        return redirect('post/'.$post->id)->with('success', 'Comment sucessfully uploaded');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $comment = Comment::find($id);
        $post = Post::find($comment->post_id);
        return view('comment.edit', compact('comment', 'post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $comment = Comment::find($id);
        $post = Post::find($comment->post_id);

        $this->validate($request, [
            'comment_content' => 'required'
        ]);

        $comment->comment_content = $request->comment_content;
        $comment->save();

        return redirect('post/'.$post->id)->with('success', 'Comment has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment = Comment::find($id);
        $post = Post::find($comment->post_id);
        $comment->delete();

        return redirect('post/'.$post->id)->with('success', 'Comment has been deleted');
    }
}
