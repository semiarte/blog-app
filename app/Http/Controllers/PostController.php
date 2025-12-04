<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('author')->latest()->paginate(4);
        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'min:3'],
            'body' => ['required', 'min:144']
        ]);

        Post::create([
            'title' => request('title'),
            'body' => request('body'),
            'author_id' => 1
        ]);

        return redirect('/posts');
    }

    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => ['required', 'min:3'],
            'body' => ['required', 'min:144']
        ]);
        $post->update([
            'title' => request('title'),
            'body' => request('body')
        ]);

        return redirect('/posts/' . $post->id);
    }
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect('/posts');
    }
}
