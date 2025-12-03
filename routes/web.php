<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $posts = Post::with('author')->paginate(4);
    return view('home', [
        'posts' => $posts
    ]);
});
