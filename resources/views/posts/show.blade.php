@extends('layouts.app')

@section('title', $post->title ?? 'Post')

@section('body')
  <div class="min-h-screen py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
      <article class="bg-card rounded-lg shadow-sm p-6">
        <header class="mb-6">
          <h1 class="text-2xl font-extrabold text-card-foreground">{{ $post->title ?? 'Untitled' }}</h1>
          <div class="mt-2 text-sm text-secondary-foreground">
            By {{ $post->user->name ?? 'Unknown' }}
            @if($post->created_at)
              • {{ $post->created_at->format('M j, Y') }}
            @endif
          </div>
        </header>

        <div class="prose prose-invert text-card-foreground">
          {!! nl2br(e($post->content)) !!}
        </div>

        <footer class="mt-6 flex items-center justify-between">
          <a href="{{ route('posts.index') }}" class="inline-flex items-center px-3 py-2 rounded btn btn-outline">Back to posts</a>

          <div class="flex items-center gap-3">
            @can('update', $post)
              <a href="{{ route('posts.edit', $post->id) }}" class="inline-flex items-center px-3 py-2 rounded btn btn-primary">Edit</a>
            @endcan

            @can('update', $post)
              <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Delete this post?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center px-3 py-2 rounded text-destructive-foreground hover:underline">Delete</button>
              </form>
            @endcan
          </div>
        </footer>
      </article>

      {{-- Comments section --}}
      <section class="mt-8 max-w-3xl mx-auto">
        <h3 class="text-xl font-semibold text-card-foreground mb-4">Comments ({{ $post->comments->count() }})</h3>

        @if(session('success'))
          <div class="mb-4 rounded-md p-3 bg-primary text-primary-foreground">{{ session('success') }}</div>
        @endif

        @if($post->comments && $post->comments->count())
          <div class="space-y-4 mb-6">
            @foreach($post->comments()->latest()->get() as $comment)
              <div class="p-4 bg-card rounded-md shadow-sm">
                <div class="flex items-start justify-between">
                  <div>
                    <div class="text-sm font-semibold text-card-foreground">
                      {{ $comment->user ? $comment->user->name : ($comment->author_name ?? 'Guest') }}
                      <span class="text-xs text-secondary-foreground ml-2">• {{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="text-sm text-card-foreground mt-1 whitespace-pre-wrap">{!! nl2br(e($comment->content)) !!}</div>
                  </div>

                  <div class="ml-4">
                    @auth
                      @if(auth()->id() === $comment->user_id || auth()->id() === $post->user_id)
                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Delete this comment?');">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="text-destructive-foreground hover:underline">Delete</button>
                        </form>
                      @endif
                    @endauth
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        @else
          <div class="mb-6 text-secondary-foreground">No comments yet. Be the first to comment.</div>
        @endif

        {{-- Comment form (guests allowed) --}}
        <div class="bg-card rounded-lg shadow-sm p-6">
          <h4 class="text-lg font-semibold text-card-foreground mb-3">Add a comment</h4>

          <form action="{{ route('posts.comments.store', $post->id) }}" method="POST" class="space-y-4">
            @csrf

            @guest
              <div>
                <label for="author_name" class="block text-sm text-secondary-foreground mb-1">Your name (optional)</label>
                <input id="author_name" name="author_name" type="text" value="{{ old('author_name') }}" maxlength="100" class="w-full px-3 py-2 rounded border border-border bg-background text-card-foreground" />
              </div>
            @endguest

            <div>
              <label for="content" class="block text-sm text-secondary-foreground mb-1">Comment</label>
              <textarea id="content" name="content" rows="4" required class="w-full px-3 py-2 rounded border border-border bg-background text-card-foreground">{{ old('content') }}</textarea>
              @error('content')
                <p class="text-destructive-foreground text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <button type="submit" class="inline-flex items-center px-4 py-2 rounded btn btn-primary">Post comment</button>
            </div>
          </form>
        </div>
      </section>
    </div>
  </div>
@endsection