<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/about', function () {
    return view('about');
})->name("about");
Route::get('/contact', function () {
    return view('contact');
})->name("contact");
Route::get('/services', function () {
    return view('services');
})->name('services');
Route::get('/privacy', function () {
    return view('privacy');
})->name("privacy");

Route::get('/blog', [PostController::class, 'index'])->name('blog');
Route::post('/blog', [PostController::class, 'store'])->name('blog.store');

Route::get('/post/{post:slug}', [PostController::class, 'post'])->name('post');
