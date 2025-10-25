@extends('layouts.app')

@section('title', 'Account')

@section('body')
  <div class="min-h-screen flex items-center justify-center px-6">
    <div class="w-full max-w-4xl bg-card/80 backdrop-blur-md rounded-xl shadow-lg overflow-hidden grid grid-cols-1 md:grid-cols-2">
      {{-- Left: Register --}}
      <div class="p-8">
        <h2 class="text-2xl font-semibold text-card-foreground mb-4">Create an account</h2>

        @if(session('success'))
          <div class="mb-4 p-3 bg-green-600 text-white rounded">{{ session('success') }}</div>
        @endif

        <form action="{{ url('/register') }}" method="POST" class="space-y-4">
          @csrf

          <div>
            <label class="block text-sm text-card-foreground/80 mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                   class="w-full px-3 py-2 rounded bg-background border border-border text-card-foreground placeholder:text-card-foreground/60" />
            @error('name') <div class="text-red-400 text-sm mt-1">{{ $message }}</div> @enderror
          </div>

          <div>
            <label class="block text-sm text-card-foreground/80 mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                   class="w-full px-3 py-2 rounded bg-background border border-border text-card-foreground placeholder:text-card-foreground/60" />
            @error('email') <div class="text-red-400 text-sm mt-1">{{ $message }}</div> @enderror
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <div>
              <label class="block text-sm text-card-foreground/80 mb-1">Password</label>
              <input type="password" name="password" required
                     class="w-full px-3 py-2 rounded bg-background border border-border text-card-foreground placeholder:text-card-foreground/60" />
              @error('password') <div class="text-red-400 text-sm mt-1">{{ $message }}</div> @enderror
            </div>
            <div>
              <label class="block text-sm text-card-foreground/80 mb-1">Confirm</label>
              <input type="password" name="password_confirmation" required
                     class="w-full px-3 py-2 rounded bg-background border border-border text-card-foreground placeholder:text-card-foreground/60" />
            </div>
          </div>

          <div class="pt-2">
            <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 rounded bg-primary text-primary-foreground hover:opacity-95">
              Create account
            </button>
          </div>
        </form>
      </div>

      {{-- Right: Login --}}
      <div class="p-8 border-l border-border/50">
        <h2 class="text-2xl font-semibold text-card-foreground mb-4">Sign in</h2>

        <form action="{{ url('/login') }}" method="POST" class="space-y-4">
          @csrf

          <div>
            <label class="block text-sm text-card-foreground/80 mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                   class="w-full px-3 py-2 rounded bg-background border border-border text-card-foreground placeholder:text-card-foreground/60" />
            @error('email') <div class="text-red-400 text-sm mt-1">{{ $message }}</div> @enderror
          </div>

          <div>
            <label class="block text-sm text-card-foreground/80 mb-1">Password</label>
            <input type="password" name="password" required
                   class="w-full px-3 py-2 rounded bg-background border border-border text-card-foreground placeholder:text-card-foreground/60" />
          </div>

          <div class="flex items-center justify-between text-sm">
            <label class="flex items-center gap-2">
              <input type="checkbox" name="remember" class="h-4 w-4 rounded border-border bg-background" />
              <span class="text-card-foreground/80">Remember me</span>
            </label>
            <a href="#" class="text-primary-foreground text-sm">Forgot?</a>
          </div>

          <div class="pt-2">
            <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 rounded bg-primary text-primary-foreground hover:opacity-95">
              Sign in
            </button>
          </div>

          @if($errors->any())
            <div class="mt-4 text-red-400 text-sm">
              {!! implode('<br>', $errors->all()) !!}
            </div>
          @endif
        </form>

        <div class="mt-6 text-sm text-card-foreground/80">
          Or sign in with:
        </div>

        <div class="mt-3 flex gap-2">
          <a class="flex-1 inline-flex items-center justify-center gap-2 px-3 py-2 rounded bg-background border border-border text-card-foreground" href="#">
            GitHub
          </a>
          <a class="flex-1 inline-flex items-center justify-center gap-2 px-3 py-2 rounded bg-background border border-border text-card-foreground" href="#">
            Google
          </a>
        </div>
      </div>
    </div>
  </div>
@endsection