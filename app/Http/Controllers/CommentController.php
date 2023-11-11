<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Post $post, Request $request)
    {
        request()->validate([
            'body' => 'required|min:3|max:255',
        ]);

        $post->comments()->create([
            'user_id' => $request->user()->id,
            'body' => $request->input('body'),
        ]);

        return redirect("posts/$post->slug")->with('success', 'Comment has been uploaded!');
    }
}
