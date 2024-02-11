<?php

use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\DoctorController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\lab_empController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\Ray_employeeController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');

    Route::post('login/user', [AuthenticatedSessionController::class, 'store'])->name('login.user');

    Route::post('login/admin', [AdminController::class, 'store'])->name('login.admin');

    Route::post('login/doctor', [DoctorController::class, 'store'])->name('login.doctor');

    Route::post('login/ray_employee', [Ray_employeeController::class, 'store'])->name('login.ray_employee');

    Route::post('login/lab_emp', [lab_empController::class, 'store'])->name('login.lab_emp');


    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout.user');


});
    Route::post('logout/admin', [AdminController::class, 'destroy'])->middleware('auth:admin')->name('logout.admin');
    Route::post('logout/doctor', [DoctorController::class, 'destroy'])->middleware('auth:doctor')->name('logout.doctor');
    Route::post('logout/ray_employee', [Ray_employeeController::class, 'destroy'])->middleware('auth:ray_employee')->name('logout.ray_employee');
    Route::post('logout/lab_emp', [lab_empController::class, 'destroy'])->middleware('auth:lab_emp')->name('logout.lab_emp');

