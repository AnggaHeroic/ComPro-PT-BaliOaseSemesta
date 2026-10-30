<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')->name('home');
Route::view('/tentang-kami', 'pages.about')->name('about');
Route::view('/bidang-usaha', 'pages.activities')->name('activities');
Route::view('/kontak', 'pages.contact')->name('contact');
