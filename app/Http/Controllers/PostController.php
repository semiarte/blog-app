<?php

namespace App\Http\Controllers;

use App\Mail\PostPosted;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with('author')->latest();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('body', 'like', '%' . $search . '%');
            });
        }

        $posts = $query->paginate(12);

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
}
