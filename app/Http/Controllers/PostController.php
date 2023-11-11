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
        request()->validate([
            'title' => 'required|unique:posts|min:3|max:255',
            'excerpt' => 'required|min:3|max:255',
            'body' => 'required|min:3|max:2555',
        ]);

        $slug = $post->create([
            'user_id' => $request->user()->id,
            'category_id' => $request->input('category'),
            'title' => $request->input('title'),
            'slug' => Str::slug(strtolower($request->input('title')), '-'),
            'excerpt' => $request->input('excerpt'),
            'body' => $request->input('body'),
            'thumbnail' => $request->file('thumbnail')?->store('thumbnails'),
            'published_at' => now(),
        ])->slug;

        return redirect("/posts/$slug")->with('success', 'You have uploaded new post.');
    }
}
