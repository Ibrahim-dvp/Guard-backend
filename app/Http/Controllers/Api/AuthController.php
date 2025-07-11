<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Helpers\Helper;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Handle user registration.
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);
        $validated['uuid'] = Str::uuid()->toString(); // Generate UUID

        $user = User::create($validated);

        return Helper::jsonResponse(true, 'User registered successfully.', 201, [
            'user' => $user,
            'token' => $user->createToken('auth_token')->plainTextToken,
        ]);
    }

    /**
     * Handle user login.
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            return Helper::jsonErrorResponse('Invalid credentials.', 401);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return Helper::jsonResponse(true, 'Logged in successfully.', 200, [
            'user' => $user,
            'token' => $token,
        ]);
    }

    /**
     * Handle user logout.
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        return Helper::jsonResponse(true, 'Logged out successfully.', 200);
    }

    /**
     * Get the authenticated User.
     */
    public function user(Request $request): JsonResponse
    {
        return Helper::jsonResponse(true, 'User data retrieved successfully.', 200, $request->user());
    }
}
