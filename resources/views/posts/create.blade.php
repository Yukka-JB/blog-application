@extends('layouts.app')

@section('title', 'Create Post')

@section('body')
  <div class="min-h-screen py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="mb-6">
        <h1 class="text-2xl font-bold text-card-foreground">Create Post</h1>
        <p class="text-sm text-secondary-foreground mt-1">Write something great and publish it to your posts.</p>
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

        <form action="{{ route('posts.store') }}" method="POST" class="space-y-5">
          @csrf

          <div>
            <label for="title" class="block text-sm font-semibold text-secondary-foreground mb-1">Title</label>
            <input id="title" name="title" type="text" required maxlength="255"
                   value="{{ old('title') }}"
                   class="w-full px-3 py-2 rounded border border-border bg-background text-card-foreground" />
          </div>

          <div>
            <label for="content" class="block text-sm font-semibold text-secondary-foreground mb-1">Content</label>
            <textarea id="content" name="content" rows="8" required
                      class="w-full px-3 py-2 rounded border border-border bg-background text-card-foreground">{{ old('content') }}</textarea>
          </div>

          <div class="flex items-center gap-3">
            <button type="submit" class="inline-flex items-center px-4 py-2 rounded btn btn-primary">Publish</button>
            <a href="{{ route('posts.index') }}" class="inline-flex items-center px-4 py-2 rounded btn btn-outline">Cancel</a>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection