<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;

Route::get('/', [AuthController::class, 'show'])->name('home');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Route::view('/', 'welcome')->name('welcome');
// Route::view('/register', 'auth.register')->name('register');


// Route::get('/', function () {
//     return Inertia::render('welcome', [
//         'canRegister' => Features::enabled(Features::registration()),
//     ]);
// })->name('home');

// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::get('dashboard', function () {
//         return Inertia::render('dashboard');
//     })->name('dashboard');
// });

// Route::resource('posts', PostController::class);
// Route::post('/posts/{id}/comments', [CommentController::class, 'store']);
// Route::delete('/comments/{id}', [CommentController::class, 'destroy']);


require __DIR__.'/settings.php';
