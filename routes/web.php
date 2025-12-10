<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use \Illuminate\Http\Request;

Route::get('/', function (Request $request) {
    $query = Post::with('author')->latest();

    if ($request->has('search')) {
      $search = $request->input('search');
      $query->where(function ($q) use ($search) {
          $q->where('title', 'like', '%' . $search . '%')
            ->orWhere('body', 'like', '%' . $search . '%');
      });
    }

    $posts = $query->paginate(8)->withQueryString();

    return view('home', [
        'posts' => $posts
    ]);
});

// Blog Posts
Route::get('/posts', [PostController::class, 'index'])->middleware('auth');
Route::get('/posts/create', [PostController::class, 'create']);
Route::post('/posts', [PostController::class, 'store'])->middleware('auth');
Route::get('/posts/{post}', [PostController::class, 'show']);

Route::get('/posts/{post}/edit', [PostController::class, 'edit'])
    ->middleware('auth')
    ->can('edit', 'post');

Route::patch('/posts/{post}', [PostController::class, 'update']);
Route::delete('/posts/{post}', [PostController::class, 'destroy']);

// Auth
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);

