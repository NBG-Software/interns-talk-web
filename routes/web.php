<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



Route::middleware('auth')->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show')->middleware('auth');
    Route::put('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/image/update/{id}', [ProfileController::class, 'update_img'])->name('image.update');
    Route::get('/intern/list', [App\Http\Controllers\InternController::class, 'index'])->name('intern.list');
    Route::get('/intern/talk/{id}', [App\Http\Controllers\InternController::class, 'talk'])->name('intern.talk');
});

