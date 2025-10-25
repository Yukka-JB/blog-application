<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class AuthController extends Controller
{
    public function show()
    {
        return view('auth.index');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($user);

        return redirect()->intended(route('posts.index'))->with('success', 'Welcome — your account has been created.');
    }

    public function login(Request $request)
    {
        $creds = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $remember = $request->boolean('remember');

        Log::info('Login attempt', ['email' => $creds['email'], 'ip' => $request->ip()]);

        $user = User::where('email', $creds['email'])->first();
        if (! $user) {
            Log::warning('Login failed: user not found', ['email' => $creds['email']]);
            return redirect()->route('home')
                ->withErrors(['email' => 'No account found for that email.'])
                ->withInput($request->only('email'));
        }

        $passwordMatches = Hash::check($creds['password'], $user->password);
        Log::debug('Password check result', ['email' => $creds['email'], 'matches' => $passwordMatches]);

        if (Auth::attempt(['email' => $creds['email'], 'password' => $creds['password']], $remember)) {
            $request->session()->regenerate();

            Log::info('Login successful', ['email' => $creds['email'], 'user_id' => Auth::id()]);
            return redirect()->intended(route('posts.index'))->with('success', 'Welcome back.');
        }

        Log::warning('Login failed: attempt returned false', ['email' => $creds['email']]);

        return redirect()->route('home')
            ->withErrors(['email' => 'The provided credentials do not match our records.'])
            ->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You have been logged out.');
    }
}