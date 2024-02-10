<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

// 　ログイン前
Route::middleware('guest')->group(function () {
    // 新規登録
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');
    // 登録処理
    Route::post('register', [RegisteredUserController::class, 'store']);
    // ログイン
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');
    // ログイン処理
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    // パスワードリセット
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');
    // 　パスワードリセットリンク送信
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');
    // 　パスワードリセット
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');
    // 　パスワードリセット処理
    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});
// 　ログイン後
Route::middleware('auth')->group(function () {
    // ログアウト
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');
    // 　メールアドレス確認
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
    //  メールアドレス確認メール再送信
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');
    //  パスワード確認
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');
    // 　パスワード確認処理
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
    // 　パスワード変更
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');
    // 　ログアウト
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
