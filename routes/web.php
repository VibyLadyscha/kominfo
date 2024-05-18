<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostHistoryController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

// Tahap register
Route::get('/register', [SessionController::class, 'register'])->name('register')->middleware('guest');
Route::post('/postregister', [SessionController::class, 'postregister']);

// Tahap login
Route::get('/login', [SessionController::class, 'login'])->name('login')->middleware('guest');
Route::post('/postlogin', [SessionController::class, 'postlogin']);

// Tahap logout
Route::post('/logout', [SessionController::class, 'logout']);

// Masuk ke dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('/dashboard/search', [DashboardController::class, 'search'])->name('dashboard.search')->middleware('auth');
Route::get('/category/{category:id}', [DashboardController::class, 'category'])->name('category');

// Trash Post
Route::get('/post/trash', [PostController::class, 'trash'])->name('post.trash')->middleware('auth');
Route::get('/post/restore/{post:id}', [PostController::class, 'restore'])->name('post.restore')->middleware('auth');
Route::delete('/post/kill/{post:id}', [PostController::class, 'kill'])->name('post.kill')->middleware('auth');

// CRUD Post
Route::resource('/post', PostController::class)->middleware('auth');
Route::get('/post/{post:id}', [PostController::class, 'show'])->middleware('auth');

// CRUD Comment
Route::resource('/comment', CommentController::class)->middleware('auth');
Route::get('/comment/create/{post}', [CommentController::class, 'create'])->name('comment.create')->middleware('auth');

// Post History
Route::resource('/posthistory', PostHistoryController::class)->middleware('auth');

// Profile
Route::resource('/profile', ProfileController::class)->middleware('auth');