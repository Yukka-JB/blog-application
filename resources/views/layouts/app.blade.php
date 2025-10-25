<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>@yield('title', config('app.name', 'Laravel'))</title>

  <meta name="csrf-token" content="{{ csrf_token() }}">

  @if (app()->environment('local'))
    @vite('resources/css/app.css')
  @else
    <link rel="stylesheet" href="{{ mix('resources/css/app.css') }}">
  @endif
</head>
<body class="min-h-screen bg-background antialiased">
  @yield('body')
</body>
</html>