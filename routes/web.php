<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return response()->json([
        'message' => 'مرحباً بك في API المشروع',
        'version' => '1.0.0',
        'endpoints' => [
            'POST /api/auth/login' => 'تسجيل الدخول',
            'POST /api/auth/register' => 'إنشاء حساب جديد',
            'GET /api/user' => 'بيانات المستخدم (يتطلب token)',
            'POST /api/auth/logout' => 'تسجيل الخروج (يتطلب token)'
        ]
    ]);
});


