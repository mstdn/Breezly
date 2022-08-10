<?php

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use Faker\Provider\ar_EG\Internet;

Route::get('/', function () {
    return Inertia::render('Auth/Register');
});

Route::get('@{user:username}', [UserController::class, 'show'])->name('user-profile');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/home', [PostController::class, 'home'])->name('home');
    Route::post('/home', [PostController::class, 'store']);
    Route::get('/public', [PostController::class, 'public'])->name('public');
    Route::post('/{user:username}/follow', [UserController::class, 'follow'])->name('follow');
    Route::get('/users', [UserController::class, 'index'])->name('users');
});
