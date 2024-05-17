<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostHistory;
use Illuminate\Support\Facades\Auth;

class PostHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        // ambil total post dari post history
        $postHistory = PostHistory::where('user_id', Auth::user()->id)->first();
        if ($postHistory) {
            $posts = Post::where('post_history_id', $postHistory->id)->get();
        } else {
            $posts = collect(); // kalau tidak ada post history, maka set posts sebagai collection kosong
        }
        return view('posthistory.index', compact('categories', 'posts', 'postHistory'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
