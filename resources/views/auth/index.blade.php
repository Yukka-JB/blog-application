@extends('layouts.app')

@section('title', 'Account')

@section('body')
  <div id="react-auth" class="min-h-screen"></div>

  {{-- If you want server-side flash messages to be accessible to React, inject them --}}
  <script>
    window.__FLASH = {
      success: {!! json_encode(session('success')) !!},
      errors: {!! json_encode($errors->all()) !!}
    };
  </script>
@endsection