# API Documentation

## Base URL
```
http://localhost:8000/api
```

## Authentication Endpoints

### 1. Register (إنشاء حساب جديد)
**POST** `/auth/register`

**Request Body:**
```json
{
    "name": "اسم المستخدم",
    "email": "user@example.com",
    "password": "123456",
    "password_confirmation": "123456",
    "user_type": "parent"
}
```

**Response (Success - 201):**
```json
{
    "success": true,
    "message": "تم إنشاء الحساب بنجاح",
    "data": {
        "user": {
            "id": 1,
            "name": "اسم المستخدم",
            "email": "user@example.com",
            "user_type": "parent",
            "created_at": "2024-01-01T00:00:00.000000Z",
            "updated_at": "2024-01-01T00:00:00.000000Z"
        },
        "token": "1|abc123...",
        "token_type": "Bearer"
    }
}
```

### 2. Login (تسجيل الدخول)
**POST** `/auth/login`

**Request Body:**
```json
{
    "email": "user@example.com",
    "password": "123456"
}
```

**Response (Success - 200):**
```json
{
    "success": true,
    "message": "تم تسجيل الدخول بنجاح",
    "data": {
        "user": {
            "id": 1,
            "name": "اسم المستخدم",
            "email": "user@example.com",
            "user_type": "parent"
        },
        "token": "2|def456...",
        "token_type": "Bearer"
    }
}
```

**Response (Error - 401):**
```json
{
    "success": false,
    "message": "بيانات الدخول غير صحيحة"
}
```

### 3. Get User Info (بيانات المستخدم)
**GET** `/user`

**Headers:**
```
Authorization: Bearer {token}
```

**Response (Success - 200):**
```json
{
    "success": true,
    "data": {
        "user": {
            "id": 1,
            "name": "اسم المستخدم",
            "email": "user@example.com",
            "user_type": "parent"
        }
    }
}
```

### 4. Logout (تسجيل الخروج)
**POST** `/auth/logout`

**Headers:**
```
Authorization: Bearer {token}
```

**Response (Success - 200):**
```json
{
    "success": true,
    "message": "تم تسجيل الخروج بنجاح"
}
```

## User Types (أنواع المستخدمين)
- `parent` - ولي أمر
- `supervisor` - مشرف
- `school_manager` - مدير مدرسة

## Error Responses

### Validation Error (422)
```json
{
    "message": "The given data was invalid.",
    "errors": {
        "email": ["The email field is required."],
        "password": ["The password field is required."]
    }
}
```

### Unauthorized (401)
```json
{
    "message": "Unauthenticated."
}
```

## Testing with cURL

### Register:
```bash
curl -X POST http://localhost:8000/api/auth/register \
  -H "Content-Type: application/json" \
  -d '{
    "name": "اسم المستخدم",
    "email": "user@example.com", 
    "password": "123456",
    "password_confirmation": "123456",
    "user_type": "parent"
  }'
```

### Login:
```bash
curl -X POST http://localhost:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "user@example.com",
    "password": "123456"
  }'
```

### Get User (replace TOKEN with actual token):
```bash
curl -X GET http://localhost:8000/api/user \
  -H "Authorization: Bearer TOKEN"
```

### Logout (replace TOKEN with actual token):
```bash
curl -X POST http://localhost:8000/api/auth/logout \
  -H "Authorization: Bearer TOKEN"
```
