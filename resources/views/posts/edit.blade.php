@extends('layouts.app')

@section('title', 'Edit Post')

@section('body')
  <div class="min-h-screen py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="mb-6">
        <h1 class="text-2xl font-bold text-card-foreground">Edit Post</h1>
        <p class="text-sm text-secondary-foreground mt-1">Update the title or content of your post.</p>
      </div>

      <div class="bg-card rounded-lg shadow-sm p-6">
        @if ($errors->any())
          <div class="mb-4">
            <div class="rounded-md p-3 bg-destructive text-destructive-foreground">
              <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          </div>
        @endif

        {{-- Main edit form: contains only inputs --}}
        <form id="post-edit-form" action="{{ route('posts.update', $post->id) }}" method="POST" class="space-y-5">
          @csrf
          @method('PUT')

          <div>
            <label for="title" class="block text-sm font-semibold text-secondary-foreground mb-1">Title</label>
            <input id="title" name="title" type="text" required maxlength="255"
                   value="{{ old('title', $post->title) }}"
                   class="w-full px-3 py-2 rounded border border-border bg-background text-card-foreground" />
          </div>

          <div>
            <label for="content" class="block text-sm font-semibold text-secondary-foreground mb-1">Content</label>
            <textarea id="content" name="content" rows="10" required
                      class="w-full px-3 py-2 rounded border border-border bg-background text-card-foreground">{{ old('content', $post->content) }}</textarea>
          </div>
        </form>

        {{-- Actions row: Save (submits the edit form via form="post-edit-form"), Cancel, Delete (separate form) --}}
        <div class="mt-4">
          <div class="flex flex-wrap items-center gap-3">

            <button type="submit" form="post-edit-form" class="inline-flex items-center px-4 py-2 rounded btn btn-primary">
              Save changes
            </button>

            <a href="{{ route('posts.show', $post->id) }}" class="inline-flex items-center px-4 py-2 rounded btn btn-outline">
              Cancel
            </a>

            @can('update', $post)
              <form id="post-delete-form" action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post? This cannot be undone.');" class="inline-block m-0 p-0">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center px-4 py-2 rounded btn btn-outline text-destructive-foreground hover:bg-destructive/5">
                  Delete post
                </button>
              </form>
            @endcan
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection