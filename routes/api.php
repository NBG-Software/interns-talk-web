<?php

use App\Http\Controllers\Api\V1\ForgotPasswordController;
use App\Http\Controllers\Api\V1\LoginController;
use App\Http\Controllers\Api\V1\LogoutController;
use App\Http\Controllers\Api\V1\RegisterController;
use App\Http\Controllers\Api\V1\ResetPasswordController;
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
});

Route::prefix('v1')->middleware('auth:sanctum')->group(function(){
    Route::post('v1/logout', LogoutController::class);

});
