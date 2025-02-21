<?php

use App\Http\Controllers\Api\V1\ChangePasswordController;
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
use App\Http\Middleware\Api\V1\ApiRateLimiter;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->middleware(['guest',ApiRateLimiter::class])->group(function () {
    Route::post('login', LoginController::class)->name('login');
    Route::post('register', RegisterController::class);
    Route::post('password/forgot', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('password/reset', ResetPasswordController::class)->name('password.reset');

});

Route::prefix('v1')->middleware(['auth:sanctum',ApiRateLimiter::class])->group(function(){
    Route::post('logout', LogoutController::class);
    Route::get('user', [UserController::class,'index']);
    Route::get('chats/latest', [ChatController::class, 'latestChatList']);
    Route::post('chats', [ChatController::class, 'store']);
    Route::get('chats', [ChatController::class, 'show']);
    Route::patch('user',[UserController::class,'edit']);
    Route::post('user/profile',[ProfileUploadController::class, 'profileUpload']);
    Route::get('mentor', [MentorController::class,'index']);
    Route::post('message',[MessageController::class, 'index']);
    Route::get('message',[MessageController::class, 'show']);
    // Route::get('rate',[ChatController::class,'rate']);
    Route::post('password', ChangePasswordController::class);
});
