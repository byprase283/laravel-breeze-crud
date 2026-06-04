<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\GempaController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\ChatController;


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('products', ProductController::class);

    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/data', [UserController::class, 'getUsersData'])->name('users.data');
    Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{id}', [UserController::class, 'update'])->name('users.update');

    Route::resource('posts', BlogController::class);

    Route::get('/gempa', [GempaController::class, 'index'])->name('gempa.index');
    Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');

    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/stream', [ChatController::class, 'stream'])->name('chat.stream');
});

require __DIR__ . '/auth.php';
