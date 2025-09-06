<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
// use Laravel\Socialite\Facades\Socialite; // Commented out until package is installed
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * تسجيل دخول المستخدم - API
     */
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'بيانات الدخول غير صحيحة'
            ], 401);
        }

        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'تم تسجيل الدخول بنجاح',
            'data' => [
                'user' => $user,
                'token' => $token,
                'token_type' => 'Bearer'
            ]
        ], 200);
    }

    /**
     * إنشاء حساب جديد - API
     */
    public function register(RegisterRequest $request)
    {  
        
        $user = User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'parent',
        ]);

        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'تم إنشاء الحساب بنجاح',
            'data' => [
                'user' => $user,
                'token' => $token,
                'token_type' => 'Bearer'
            ]
        ], 201);
    }

    /**
     * تسجيل خروج المستخدم - API
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'تم تسجيل الخروج بنجاح'
        ], 200);
    }

    /**
     * الحصول على بيانات المستخدم الحالي - API
     */
    public function user(Request $request)
    {
        return response()->json([
            'success' => true,
            'data' => [
                'user' => $request->user()
            ]
        ], 200);
    }

    /**
     * توجيه المستخدم إلى صفحة تسجيل الدخول بـ Google
     */
    public function redirectToGoogle()
    {
        $client_id = config('services.google.client_id');
        $redirect_uri = config('services.google.redirect');
        
        if (!$client_id || !$redirect_uri) {
            return response()->json([
                'success' => false,
                'message' => 'Google OAuth غير مُعد بشكل صحيح'
            ], 500);
        }

        $params = [
            'client_id' => $client_id,
            'redirect_uri' => $redirect_uri,
            'scope' => 'openid profile email',
            'response_type' => 'code',
            'access_type' => 'offline',
            'prompt' => 'consent'
        ];

        $auth_url = 'https://accounts.google.com/o/oauth2/auth?' . http_build_query($params);
        
        return redirect($auth_url);
    }

    /**
     * معالجة الاستجابة من Google والتسجيل/تسجيل الدخول
     */
    public function handleGoogleCallback(Request $request)
    {
        try {
            $code = $request->get('code');
            
            if (!$code) {
                return response()->json([
                    'success' => false,
                    'message' => 'لم يتم الحصول على رمز التفويض من Google'
                ], 400);
            }

            // تبديل الكود بـ access token
            $tokenData = $this->exchangeCodeForToken($code);
            
            if (!$tokenData || !isset($tokenData['access_token'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'فشل في الحصول على access token من Google'
                ], 400);
            }

            // الحصول على بيانات المستخدم من Google
            $googleUser = $this->getGoogleUserInfo($tokenData['access_token']);
            
            if (!$googleUser) {
                return response()->json([
                    'success' => false,
                    'message' => 'فشل في الحصول على بيانات المستخدم من Google'
                ], 400);
            }
            
            // البحث عن المستخدم بالإيميل
            $user = User::where('email', $googleUser['email'])->first();
            
            if ($user) {
                // المستخدم موجود، تحديث بياناته
                $user->update([
                    'google_id' => $googleUser['id'],
                    'avatar' => $googleUser['picture'] ?? null,
                ]);
            } else {
                // إنشاء مستخدم جديد
                $user = User::create([
                    'name' => $googleUser['name'],
                    'email' => $googleUser['email'],
                    'google_id' => $googleUser['id'],
                    'avatar' => $googleUser['picture'] ?? null,
                    'password' => Hash::make(Str::random(24)), // كلمة مرور عشوائية
                    'role' => 'parent', // النوع الافتراضي
                    'email_verified_at' => now(), // تأكيد الإيميل تلقائياً
                ]);
            }

            // إنشاء التوكن
            $token = $user->createToken('auth-token')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'تم تسجيل الدخول بـ Google بنجاح',
                'data' => [
                    'user' => $user,
                    'token' => $token,
                    'token_type' => 'Bearer'
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ في تسجيل الدخول بـ Google',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * تسجيل الدخول بـ Google للـ API (للتطبيقات المحمولة)
     */
    public function loginWithGoogle(Request $request)
    {
        $request->validate([
            'google_token' => 'required|string',
        ]);

        try {
            // التحقق من صحة التوكن مع Google
            $client = new \Google_Client(['client_id' => config('services.google.client_id')]);
            $payload = $client->verifyIdToken($request->google_token);
            
            if (!$payload) {
                return response()->json([
                    'success' => false,
                    'message' => 'توكن Google غير صحيح'
                ], 401);
            }

            // البحث عن المستخدم أو إنشاؤه
            $user = User::where('email', $payload['email'])->first();
            
            if ($user) {
                // تحديث بيانات المستخدم
                $user->update([
                    'google_id' => $payload['sub'],
                    'avatar' => $payload['picture'] ?? null,
                ]);
            } else {
                // إنشاء مستخدم جديد
                $user = User::create([
                    'name' => $payload['name'],
                    'email' => $payload['email'],
                    'google_id' => $payload['sub'],
                    'avatar' => $payload['picture'] ?? null,
                    'password' => Hash::make(Str::random(24)),
                    'role' => 'parent',
                    'email_verified_at' => now(),
                ]);
            }

            // إنشاء التوكن
            $token = $user->createToken('auth-token')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'تم تسجيل الدخول بـ Google بنجاح',
                'data' => [
                    'user' => $user,
                    'token' => $token,
                    'token_type' => 'Bearer'
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ في تسجيل الدخول بـ Google',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * تبديل authorization code بـ access token
     */
    private function exchangeCodeForToken($code)
    {
        try {
            $client = new \GuzzleHttp\Client();
            
            $response = $client->post('https://oauth2.googleapis.com/token', [
                'form_params' => [
                    'client_id' => config('services.google.client_id'),
                    'client_secret' => config('services.google.client_secret'),
                    'redirect_uri' => config('services.google.redirect'),
                    'grant_type' => 'authorization_code',
                    'code' => $code,
                ],
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * الحصول على بيانات المستخدم من Google
     */
    private function getGoogleUserInfo($accessToken)
    {
        try {
            $client = new \GuzzleHttp\Client();
            
            $response = $client->get('https://www.googleapis.com/oauth2/v2/userinfo', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return null;
        }
    }
}
