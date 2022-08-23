<?php

use App\Http\Controllers\ShopAdmin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ShopAdmin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\ShopAdmin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\ShopAdmin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\ShopAdmin\Auth\NewPasswordController;
use App\Http\Controllers\ShopAdmin\Auth\PasswordResetLinkController;
use App\Http\Controllers\ShopAdmin\Auth\RegisteredUserController;
use App\Http\Controllers\ShopAdmin\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->middleware('guest:shopadmin')
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store'])
                ->middleware('guest:shopadmin');

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest:shopadmin')
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest:shopadmin');

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->middleware('guest:shopadmin')
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->middleware('guest:shopadmin')
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->middleware('guest:shopadmin')
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest:shopadmin')
                ->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->middleware('auth:shopadmin')
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['auth:shopadmin', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('auth:shopadmin', 'throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->middleware('auth:shopadmin')
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store'])
                ->middleware('auth:shopadmin');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth:shopadmin')
                ->name('logout');
});
