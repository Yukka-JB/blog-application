<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{
    // Ensure authorize() is available on this controller
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     *
     * Shows the authenticated user's posts. If no user is authenticated,
     * shows all posts (public view).
     */
    public function index()
    {
        if (auth()->check()) {
            $posts = Post::where('user_id', auth()->id())->latest()->get();
        } else {
            $posts = Post::latest()->get();
        }

        // Render a Blade view that lists posts (resources/views/posts.blade.php)
        return view('posts', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Show a simple create form (resources/views/posts/create.blade.php)
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);

        Post::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return redirect('/posts')->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        // Authorize the current user can update this post.
        $this->authorize('update', $post);

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $this->authorize('update', $post);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);

        $post->update($validated);

        return redirect(route('posts.show', $post->id))->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $this->authorize('update', $post);

        $post->delete();
        return redirect('/posts')->with('success', 'Post deleted.');
    }
}