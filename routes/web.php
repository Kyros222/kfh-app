<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/services', function () {
    return view('services');
})->name('services');
Route::post('/services/order', [ContactController::class, 'storeFromServices'])->name('services.order');
Route::get('/privacy', function () {
    return view('privacy');
})->name('privacy');

Route::get('/blog', [PostController::class, 'index'])->name('blog');
Route::get('/post/{post:slug}', [PostController::class, 'post'])->name('post');
