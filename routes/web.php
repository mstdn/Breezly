<?php

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PublicController;
use Faker\Provider\ar_EG\Internet;

Route::get('/', [PublicController::class, 'public'])->middleware('guest');
Route::get('@{user:username}', [UserController::class, 'show'])->name('user-profile');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/home', [PostController::class, 'home'])->name('home');
    Route::get('/public', [PostController::class, 'public'])->name('public');
    Route::post('/home', [PostController::class, 'store']);
    Route::post('/{user:username}/follow', [UserController::class, 'follow'])->name('follow');
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::post('/posts/{post}/like', [PostController::class, 'like'])->name('like');
});
