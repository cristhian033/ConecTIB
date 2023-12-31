<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('users', [UsersController::class, 'show'])->middleware('can:register-users')
        ->name('user.show');

    Route::get('getUsers', [UsersController::class, 'getUsers'])->middleware('can:register-users')
        ->name('user.showall');

    Route::get('editUser/{id?}', [UsersController::class, 'editUser'])->middleware('can:register-users')
        ->name('user.editUser');

    Route::put('editUser/{id?}', [UsersController::class, 'saveEditUser'])->middleware('can:register-users')
        ->name('user.editUser');

    Route::get('deleteUser/{id?}', [UsersController::class, 'deleteUser'])->middleware('can:register-users')
        ->name('user.deleteUser');

    Route::get('register', [RegisteredUserController::class, 'create'])->middleware('can:register-users')
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
