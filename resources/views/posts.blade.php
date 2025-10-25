@extends('layouts.app')

@section('title', 'Posts')

@section('body')
  <div class="min-h-screen py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-extrabold text-card-foreground">Posts</h1>

        @auth
          <a href="{{ route('posts.create') }}" class="inline-flex items-center px-4 py-2 rounded btn btn-primary">Create Post</a>
        @endauth
      </div>

      @if(session('success'))
        <div class="mb-4 rounded-md p-3 bg-primary text-primary-foreground">
          {{ session('success') }}
        </div>
      @endif

      @if($posts && $posts->count())
        <div class="space-y-6">
          @foreach($posts as $post)
            <article class="p-6 bg-card rounded-lg shadow-sm">
              <h2 class="text-xl font-semibold text-card-foreground">
                <a href="{{ route('posts.show', $post->id) }}" class="hover:underline">{{ $post->title ?? 'Untitled' }}</a>
              </h2>
              <p class="text-sm text-secondary-foreground mt-2">
                {{ \Illuminate\Support\Str::limit($post->content ?? '', 200) }}
              </p>
              <div class="mt-3 flex items-center justify-between">
                <div class="text-sm text-secondary-foreground">By {{ $post->user->name ?? 'Unknown' }}</div>

                <div class="flex items-center gap-3 text-sm">
                  <span class="text-secondary-foreground mr-3">{{ $post->created_at ? $post->created_at->format('M j, Y') : '' }}</span>

                  @can('update', $post)
                    <a href="{{ route('posts.edit', $post->id) }}"
                       class="inline-flex items-center px-3 py-1.5 rounded btn btn-primary hover:opacity-95"
                       aria-label="Edit post {{ $post->id }}">
                      Edit
                    </a>

                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this post?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="inline-flex items-center px-3 py-1.5 rounded btn btn-outline text-destructive-foreground hover:bg-destructive/5">
                        Delete
                      </button>
                    </form>
                  @endcan
                </div>
              </div>
            </article>
          @endforeach
        </div>
      @else
        <div class="p-6 bg-card rounded-lg shadow-sm">
          <p class="text-card-foreground">No posts yet. @auth <a href="{{ route('posts.create') }}" class="text-primary hover:underline">Create your first post</a>@endauth</p>
        </div>
      @endif
    </div>
  </div>
@endsection