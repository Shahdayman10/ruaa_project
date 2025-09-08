<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public Authentication Routes
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);

// Google OAuth Routes
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);
Route::post('/auth/google/login', [AuthController::class, 'loginWithGoogle']);

// إرسال رابط إعادة التعيين
Route::post('/auth/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail']);

// تعيين كلمة مرور جديدة

Route::post('/auth/reset-password', [ResetPasswordController::class, 'reset']);

// Protected Routes (require authentication)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);
});

// إرسال رابط إعادة التعيين
Route::post('/auth/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail
']);

// تعيين كلمة مرور جديدة
Route::post('/auth/reset-password', [ResetPasswordController::class, 'reset']);
Route::post('/auth/reset-password', [ResetPasswordController::class, 'reset']);