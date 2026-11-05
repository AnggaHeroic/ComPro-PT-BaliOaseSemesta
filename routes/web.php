<?php

use App\Http\Controllers\ActivityController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')->name('home');
Route::view('/tentang-kami', 'pages.about')->name('about');
Route::get('/layanan-jasa', [ActivityController::class, 'index'])->name('activities');
Route::get('/layanan-jasa/aktivitas/{activity}', [ActivityController::class, 'detail'])->name('activities.show');
Route::get('/layanan-jasa/{category}',[ActivityController::class, 'category'])->name('activities.category');
Route::view('/kontak', 'pages.contact')->name('contact');
