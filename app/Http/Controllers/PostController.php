<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostHistory;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class PostController extends Controller
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
    public function create()
    {
        $categories = Category::all();
        return view('post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $date = carbon::now()->format('ymd');

        // validasi form
        $this->validate($request, [
            'post_title' => 'required',
            'category_id' => 'required',
            'post_content' => 'required',
            'post_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // cek apakah user sudah memiliki post history
        $post_history = PostHistory::where('user_id', Auth::user()->id)->first();

        // jika user belum memiliki post history
        if (!$post_history) {
            $post_history = new PostHistory();
            $post_history->user_id = Auth::user()->id;
            $post_history->post_history_total = 1;
            $post_history->save();
        }

        // jika user sudah memiliki post history
        else {
            $post_history->post_history_total += 1;
            $post_history->save();
        }

        // membuat post
        $post = new Post();
        $post->user_id = Auth::user()->id;
        $post->category_id = $request->category_id;
        $post->post_title = $request->post_title;
        $post->post_content = $request->post_content;
        $post->post_history_id = $post_history->id;
        $post->save();

        // upload image jika ada
        if ($request->hasFile('post_image')) {
            $image = $request->post_image;
            $new_image = time() . $image->getClientOriginalName();
            $post->post_image = 'public/uploads/posts/' . $new_image;

            // memindahkan image ke folder public/uploads/posts
            $image->move('public/uploads/posts/', $new_image);
        }

        $post->save();
        return redirect()->route('dashboard')->with('success', 'Post created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        $comments = $post->comments;
        return view('post.show', compact('post', 'categories', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        return view('post.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // read data untuk validasi post history
        $post_history = PostHistory::where('user_id', Auth::user()->id)->first();

        // read data post
        $post = Post::find($id);

        // request validasi
        $this->validate($request, [
            'post_title' => 'nullable',
            'category_id' => 'nullable',
            'post_content' => 'nullable',
            'post_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        
        // jika user input image
        if ($request->hasFile('post_image')) {
            $image = $request->post_image;
            $new_image = time() . $image->getClientOriginalName();
            $post->post_image = 'public/uploads/posts/' . $new_image;

            // memindahkan image ke folder public/uploads/posts
            $image->move('public/uploads/posts/', $new_image);
        }

        // jika user memilih checkbox remove image
        if ($request->remove_image) {
            // hapus image dari folder
            Storage::delete($post->post_image);

            $post->post_image = null;
        }

        $post->update([
            'post_title' => $request->post_title,
            'category_id' => $request->category_id,
            'post_content' => $request->post_content,
            'post_slug' => $request->post_title ? Str::slug($request->post_title, '-') : $post->post_slug
        ]);

        // jika tidak ada perubahan pada post (tidak ada input apapun dan tidak menceklis checkbox)
        if (!$request->post_title && !$request->category_id && !$request->post_content && !$request->hasFile('post_image') && !$request->remove_image) {
            return redirect()->back()->with('error', 'No changes were made');
        }

        // jika gagal update post
        if (!$post) {
            return redirect()->back()->with('error', 'Failed to update post');
        }

        return redirect()->route('posthistory.index')->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        $post->delete();

        // update post history
        $post_history = PostHistory::where('user_id', Auth::user()->id)->first();
        $post_history->post_history_total = Post::where('user_id', auth()->id())->whereNull('deleted_at')->count();
        $post_history->save();

        return redirect()->route('posthistory.index')->with('success', 'Post moved to trash');
    }

    public function trash()
    {
        $posts = Post::onlyTrashed()->get();
        $categories = Category::all();
        return view('post.trash', compact('posts', 'categories'));
    }

    public function restore(string $id)
    {
        $post = Post::withTrashed()->find($id);
        $post->restore();

        // update post history
        $post_history = PostHistory::where('user_id', Auth::user()->id)->first();
        $post_history->post_history_total = Post::where('user_id', auth()->id())->whereNull('deleted_at')->count();
        $post_history->save();

        return redirect()->route('posthistory.index')->with('success', 'Post has been restored');
    }

    public function kill(string $id)
    {
        $post = Post::withTrashed()->find($id);

        // hapus image dari folder jika ada
        if ($post->post_image) {
            Storage::delete($post->post_image);
        }

        // hapus komentar yang terkait dengan post
        $post->comments()->delete();

        $post->forceDelete();

        // update post history
        $post_history = PostHistory::where('user_id', Auth::user()->id)->first();
        $post_history->post_history_total = Post::where('user_id', auth()->id())->whereNull('deleted_at')->count();
        $post_history->save();

        return redirect()->route('posthistory.index')->with('success', 'Post has been deleted permanently');
    }
}
