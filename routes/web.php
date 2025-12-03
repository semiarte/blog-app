<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $posts = Post::with('author')->paginate(4);
    return view('home', [
        'posts' => $posts
    ]);
});

// Show
Route::get('/posts/{post:id}', function (Post $post) {
    return view('posts.show', ['post' => $post]);
});
