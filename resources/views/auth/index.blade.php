@extends('layouts.app')

@section('title', 'Account')

@section('body')
  <div id="react-auth" class="min-h-screen"></div>

  {{-- Inject server-side flash and CSRF token for React --}}
  <script>
    window.__FLASH = {
      success: {!! json_encode(session('success')) !!},
      errors: {!! json_encode($errors->all()) !!}
    };

    window.__CSRF = {!! json_encode(csrf_token()) !!};
  </script>
@endsection