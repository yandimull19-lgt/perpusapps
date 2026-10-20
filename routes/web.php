<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'index']);
Route::get('/tentang', [HomeController::class, 'tentang']);
Route::get('/kontak', [HomeController::class, 'kontak']);

// Seluruh route di dalam blok ini hanya bisa diakses setelah login
Route::middleware(['auth'])->group(function () {
    // Menambahkan route dashboard agar tidak muncul error Route [dashboard] not defined
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // Route resource untuk modul CRUD buku
    Route::resource('books', BookController::class);
});

require __DIR__.'/auth.php';