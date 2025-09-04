<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;

echo "=== جميع المستخدمين في قاعدة البيانات ===\n\n";

$users = User::all();

foreach ($users as $user) {
    echo "ID: " . $user->id . "\n";
    echo "الاسم: " . $user->name . "\n";
    echo "البريد الإلكتروني: " . $user->email . "\n";
    echo "نوع المستخدم: " . $user->user_type . "\n";
    echo "تاريخ التسجيل: " . $user->created_at . "\n";
    echo "-------------------\n";
}

echo "\nإجمالي المستخدمين: " . $users->count() . "\n";
