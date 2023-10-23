<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::latest()->filter(
                request(
                    [
                        'search',
                        'category',
                        'author'
                    ]
                ))->paginate(6)->withQueryString(),
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post,
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Post $post, Request $request)
    {
        // validate data
        request()->validate([
            'title' => 'required|min:3|max:255',
            'excerpt' => 'required|min:3|max:255',
            'body' => 'required|min:3|max:2555',
        ]);

        // store data
        $post->create([
            'user_id' => $request->user()->id,
            'category_id' => $request->input('category'),
            'title' => $request->input('title'),
            'slug' => Str::slug(strtolower($request->input('title')), '-'),
            'excerpt' => $request->input('excerpt'),
            'body' => $request->input('body'),
            'published_at' => now(),
        ]);
        // redirect
        return redirect('/')->with('success', 'You have uploaded new post.');
    }
}
