<?php

use App\Http\Controllers\Web\ActivityController;
use App\Http\Controllers\Web\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/tentang-kami', [PageController::class, 'about'])->name('about');
Route::get('/layanan-jasa', [ActivityController::class, 'index'])->name('activities');
Route::get('/layanan-jasa/aktivitas/{activity}', [ActivityController::class, 'detail'])->name('activities.show');
Route::get('/layanan-jasa/{category}', [ActivityController::class, 'category'])->name('activities.category');
Route::get('/kontak', [PageController::class, 'contact'])->name('contact');

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
