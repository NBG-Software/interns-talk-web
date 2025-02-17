<?php

use App\Http\Controllers\Api\V1\ChatController;
use App\Http\Controllers\Api\V1\ForgotPasswordController;
use App\Http\Controllers\Api\V1\LoginController;
use App\Http\Controllers\Api\V1\LogoutController;
use App\Http\Controllers\Api\V1\MentorController;
use App\Http\Controllers\Api\V1\MessageController;
use App\Http\Controllers\Api\V1\ProfileUploadController;
use App\Http\Controllers\Api\V1\RegisterController;
use App\Http\Controllers\Api\V1\ResetPasswordController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('v1')->middleware('guest')->group(function () {
    Route::post('login', LoginController::class)->name('login');
    Route::post('register', RegisterController::class);
    Route::post('password/forgot', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('password/reset', ResetPasswordController::class)->name('password.reset');
    Route::post('message',[MessageController::class, 'index']);
});

Route::prefix('v1')->middleware('auth:sanctum')->group(function(){
    Route::post('logout', LogoutController::class);
    Route::get('user', [UserController::class,'index']);
    Route::get('chats/latest', [ChatController::class, 'latestChatList']);
    Route::patch('user',[UserController::class,'edit']);
    Route::post('user/profile',[ProfileUploadController::class, 'profileUpload']);
    Route::get('mentor', [MentorController::class,'index']);
    // Route::post('message',[MessageController::class, 'index']);
});
