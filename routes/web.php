<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $posts = Post::with('author')->latest()->paginate(4);
    return view('home', [
        'posts' => $posts
    ]);
});

// Blog Posts
Route::resource('posts', PostController::class);

// Auth
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);

