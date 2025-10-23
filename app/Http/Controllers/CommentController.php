<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
    $validated = $request->validate([
        'comment' => 'required|string|min:1',
    ]);

    $comment = new Comment();
    $comment->post_id = $postId;
    $comment->user_id = auth()->id(); // or null for guests if allowed
    $comment->comment = $validated['comment'];
    $comment->save();

    return redirect()->back()->with('success', 'Comment added succesfully.');
    }

}
