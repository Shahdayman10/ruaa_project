# Laravel API with Google OAuth

Laravel backend API with Google OAuth authentication support.

## Features

- User authentication (login, register, logout)
- Google OAuth integration
- JWT token-based authentication
- RESTful API endpoints
- MySQL database support

## Installation

1. Clone the repository
2. Install dependencies:
   ```bash
   composer install
   ```

3. Configure environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Configure database in `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. Configure Google OAuth in `.env`:
   ```env
   GOOGLE_CLIENT_ID=your_google_client_id
   GOOGLE_CLIENT_SECRET=your_google_client_secret
   GOOGLE_REDIRECT_URI=http://localhost:8000/api/auth/google/callback
   ```

6. Run migrations:
   ```bash
   php artisan migrate
   ```

7. Start the server:
   ```bash
   php artisan serve
   ```

## API Endpoints

### Authentication
- `POST /api/auth/login` - User login
- `POST /api/auth/register` - User registration
- `POST /api/auth/logout` - User logout (requires token)

### Google OAuth
- `GET /api/auth/google` - Redirect to Google OAuth
- `GET /api/auth/google/callback` - Handle Google OAuth callback
- `POST /api/auth/google/login` - Mobile/SPA Google login

### User
- `GET /api/user` - Get authenticated user data (requires token)

## Google OAuth Setup

1. Go to [Google Cloud Console](https://console.cloud.google.com/)
2. Create a new project or select existing one
3. Enable Google+ API or People API
4. Create OAuth 2.0 credentials
5. Add authorized redirect URI: `http://localhost:8000/api/auth/google/callback`
6. Copy Client ID and Client Secret to `.env` file

## Usage

The API returns JWT tokens for authentication. Include the token in requests:

```
Authorization: Bearer your_jwt_token_here
