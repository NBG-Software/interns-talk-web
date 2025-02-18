<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;




Auth::routes();


Route::middleware(['guest'])->group(function(){
    Route::get('/', function () {
        return view('welcome');
    });

});


Route::middleware(['auth','no-cache'])->group(function(){
    Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show')->middleware('auth');
    Route::put('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/image/update/{id}', [ProfileController::class, 'update_img'])->name('image.update');
    Route::get('/intern/list', [App\Http\Controllers\InternController::class, 'chat_interns'])->name('intern.list');
    Route::get('/intern/talk/{id}', [App\Http\Controllers\ChatController::class, 'talk'])->name('intern.talk');
    Route::post('/chat/{id}/message', [App\Http\Controllers\ChatController::class, 'store_message'])->name('message.store');
    Route::post('/chat/{id}/media', [App\Http\Controllers\ChatController::class, 'store_media'])->name('media.store');
    Route::get('/chat/{id}/allmessages', [App\Http\Controllers\ChatController::class, 'messages'])->name('message.all');
});



