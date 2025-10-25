<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{

    public function store(Request $request, $postId)
    {
        $post = Post::findOrFail($postId);

        $data = $request->validate([
            'content' => 'nullable|string|min:1|max:2000',
            'comment' => 'nullable|string|min:1|max:2000',
            'author_name' => 'nullable|string|max:100',
        ]);

        $text = $data['content'] ?? $data['comment'] ?? null;

        if (! $text) {
            return redirect()->back()->withErrors(['content' => 'Comment is required.'])->withInput();
        }

        $comment = Comment::create([
            'post_id' => $post->id,
            'user_id' => auth()->check() ? auth()->id() : null,
            'author_name' => auth()->check() ? null : ($data['author_name'] ?? null),
            'content' => $text,
            'comment' => $text,
        ]);

        return redirect()->route('posts.show', $post->id)->with('success', 'Comment added successfully.');
    }


    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return redirect()->route('posts.show', $comment->post_id)->with('success', 'Comment deleted successfully.');
    }
}