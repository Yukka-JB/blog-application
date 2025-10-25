<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="antialiased">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>@yield('title', config('app.name', 'Laravel'))</title>
  <meta name="description" content="@yield('description', 'A neat Laravel + React + Tailwind app')" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  @if (app()->environment('local'))
    @vite(['resources/js/app.tsx', 'resources/css/app.css'])
  @else
    <link rel="stylesheet" href="{{ mix('resources/css/app.css') }}">
    <script src="{{ mix('resources/js/app.js') }}" defer></script>
  @endif

  <script>
    (function () {
      try {
        const saved = localStorage.getItem('theme');
        if (saved === 'dark') {
          document.documentElement.classList.add('dark');
        } else if (saved === 'light') {
          document.documentElement.classList.remove('dark');
        } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
          document.documentElement.classList.add('dark');
        }
      } catch (e) { /* ignore */ }
    })();
  </script>
</head>
<body class="min-h-screen bg-background selection:bg-primary selection:text-primary-foreground">
  <a href="#main" class="sr-only focus:not-sr-only focus:absolute top-4 left-4 z-50 px-3 py-2 rounded bg-primary text-primary-foreground">Skip to content</a>

  <header class="w-full border-b border-border bg-card/80 backdrop-blur-sm">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        {{-- Left: intentionally left empty (brand removed) --}}
        <div class="flex-1"></div>

        {{-- Center navigation --}}
        <nav class="hidden md:flex items-center gap-6">
          <a href="{{ url('/') }}" class="text-sm text-card-foreground hover:text-primary">{{ __('Home') }}</a>
          <a href="#" class="text-sm text-secondary-foreground hover:text-primary">{{ __('Docs') }}</a>
          <a href="#" class="text-sm text-secondary-foreground hover:text-primary">{{ __('About') }}</a>
        </nav>

        {{-- Right: auth / theme --}}
        <div class="flex items-center gap-3">
          @auth
            <span class="text-sm text-secondary-foreground hidden sm:inline">Hi, {{ Auth::user()->name }}</span>
            <form action="{{ url('/logout') }}" method="POST" class="inline">
              @csrf
              <button type="submit" class="inline-flex items-center gap-2 px-3 py-1.5 rounded btn btn-outline">
                {{ __('Log Out') }}
              </button>
            </form>
          @else
            <a href="{{ url('/') }}" class="inline-flex items-center gap-2 px-3 py-1.5 rounded btn btn-outline text-sm">Sign in / Register</a>
          @endauth

          <button id="theme-toggle" class="p-2 rounded hover:bg-background/60" aria-label="Toggle theme">
            <svg id="theme-icon" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-card-foreground" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m8.66-9H21M3 12H2.34M17.657 6.343l-.707.707M7.05 16.95l-.707.707M17.657 17.657l-.707-.707M7.05 7.05l-.707-.707M12 5a7 7 0 100 14 7 7 0 000-14z" />
            </svg>
          </button>
        </div>
      </div>
    </div>
  </header>

  <main id="main" class="py-10">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
      {{-- Flash messages --}}
      @if(session('success'))
        <div class="mb-6">
          <div class="rounded-md p-4 bg-primary text-primary-foreground">
            {{ session('success') }}
          </div>
        </div>
      @endif

      @if($errors->any())
        <div class="mb-6">
          <div class="rounded-md p-4 bg-destructive text-destructive-foreground">
            {!! implode('<br>', $errors->all()) !!}
          </div>
        </div>
      @endif

      {{-- Page content --}}
      <div class="prose prose-invert max-w-none">
        @yield('body')
      </div>
    </div>
  </main>

  {{-- Footer removed as requested --}}

  <script>
    (function () {
      const btn = document.getElementById('theme-toggle');
      if (!btn) return;

      function isDark() { return document.documentElement.classList.contains('dark'); }
      function setTheme(dark) {
        if (dark) document.documentElement.classList.add('dark');
        else document.documentElement.classList.remove('dark');
        try { localStorage.setItem('theme', dark ? 'dark' : 'light'); } catch (e) {}
      }

      btn.addEventListener('click', function () {
        setTheme(!isDark());
      });
    })();
  </script>
</body>
</html>