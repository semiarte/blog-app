<?php

namespace App\Http\Controllers;

use App\Mail\PostPosted;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('author')->latest()->paginate(12);
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

        $post = Post::create([
            'title' => request('title'),
            'body' => request('body'),
            'author_id' => 1
        ]);

        Mail::to($post->author->user)->send(
            new PostPosted($post)
        );

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
        Gate::authorize('edit', $post);

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
        Gate::authorize('edit-post', $post);

        $post->delete();
        return redirect('/posts');
    }

    public function search(Request $request)
    {
        $query = $request->input('search');

        $posts = Post::with('author')
            ->when($query, function ($q) use ($query) {
                $q->where('title', 'like', '%' . $query . '%')
                  ->orWhere('body', 'like', '%' . $query . '%');
        })
        ->latest()
        ->paginate(12)
        ->withQueryString();

        return view('posts.search', [
            'posts' => $posts,
            'search' => $query,
        ]);
    }
}
