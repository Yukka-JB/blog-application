@extends('layouts.app')

@section('content')
<div class="card max-w-md mx-auto mt-10 p-6 shadow-lg">
    <h2 class="text-2xl font-bold mb-6 text-primary">Register</h2>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium mb-1">Name</label>
            <input type="text" name="name" id="name" required
                   class="w-full border border-border rounded-md p-2 bg-background text-foreground focus:ring-2 focus:ring-primary">
        </div>

        <div>
            <label for="email" class="block text-sm font-medium mb-1">Email</label>
            <input type="email" name="email" id="email" required
                   class="w-full border border-border rounded-md p-2 bg-background text-foreground focus:ring-2 focus:ring-primary">
        </div>

        <div>
            <label for="password" class="block text-sm font-medium mb-1">Password</label>
            <input type="password" name="password" id="password" required
                   class="w-full border border-border rounded-md p-2 bg-background text-foreground focus:ring-2 focus:ring-primary">
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium mb-1">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required
                   class="w-full border border-border rounded-md p-2 bg-background text-foreground focus:ring-2 focus:ring-primary">
        </div>

        <button type="submit" class="btn-primary w-full mt-4">Register</button>
    </form>
</div>
@endsection
