<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Livewire\CartCounter;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/category/{category:slug}', [ProductController::class, 'category'])->name('category');
Route::get('/product/{product:slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/search', [ProductController::class, 'search'])->name('product.search');

// Тестовый маршрут для проверки аутентификации
Route::get('/test-login', function () {
    $user = \App\Models\User::first();
    if ($user) {
        auth()->login($user);

        $response = response('Logged in as: ' . $user->email .
               '<br>Session ID: ' . session()->getId() .
               '<br>Auth check: ' . (auth()->check() ? 'true' : 'false') .
               '<br>Cookie name: ' . config('session.cookie') .
               '<br><a href="/test-check">Check Session</a> | <a href="/admin">Go to Admin</a>');

        return $response;
    }
    return 'No users found. <a href="/admin">Go to Admin Login</a>';
});

Route::get('/test-check', function () {
    $cookieName = config('session.cookie');
    $cookieValue = request()->cookie($cookieName);

    return 'Session ID: ' . session()->getId() .
           '<br>Cookie name: ' . $cookieName .
           '<br>Cookie value from request: ' . ($cookieValue ?? 'NULL') .
           '<br>Auth check: ' . (auth()->check() ? 'true' : 'false') .
           '<br>Auth user: ' . (auth()->user()?->email ?? 'null') .
           '<br><a href="/admin">Go to Admin</a>';
});

Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::post('/update/{product}', [CartController::class, 'update'])->name('cart.update');
});
