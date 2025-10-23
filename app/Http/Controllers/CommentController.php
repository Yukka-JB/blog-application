<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{

    public function store(Request $request, $postId)
    {

        $validated = $request->validate([
            'comment' => 'required|string|min:1',
        ]);


        $comment = new Comment();
        $comment->post_id = $postId;
        $comment->user_id = auth()->id(); // null if guests allowed
        $comment->comment = $validated['comment'];
        $comment->save();

        return redirect()->back()->with('success', 'Comment added successfully.');
    }


    public function destroy(Comment $comment)
    {

        $this->authorize('delete', $comment);

        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
}
