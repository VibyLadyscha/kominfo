<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        $categories = Category::all();
        return view('dashboard', compact('posts', 'categories'));
    }

    public function category(Category $category)
    {
        $posts = Post::where('category_id', $category->id)->get();
        $categories = Category::all();
        $category_id = Category::find($category->id);
        return view('kategori', compact('posts', 'categories', 'category_id'));
    }

}
