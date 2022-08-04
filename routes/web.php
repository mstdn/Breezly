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
    Route::get('/home', [PostController::class, 'index'])->name('home');
    Route::post('/home', [PostController::class, 'store']);
    Route::get('/users', function () {
        return Inertia::render('Users/Index', [
            'users' => User::query()

            ->when(Request::input('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            
            ->paginate(50)
            ->withQueryString()
            ->through(fn($user) => [
                'id'    =>  $user->id,
                'name'  =>  $user->name,
                'photo' =>  $user->profile_photo_path
            ]),

            'filters' => Request::only(['search'])
        ]);
    })->name('users');
});
