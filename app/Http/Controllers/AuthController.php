<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AuthRequest;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function login(AuthRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Credential(s) are incorrect!'
            ], 403);
        }

        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'token' => $token
        ]);
    }

    public function me(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'me' => $user
        ]);
    }

    public function refresh(Request $request)
    {
        $token = $request->bearerToken();

        $accessToken = PersonalAccessToken::findToken($token);

        if(!$accessToken) {
            return response()->json([
                'message' => 'Invalid or expired token'
            ], 401);
        }

        $user = $accessToken->tokenable;

        if(!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }

        $accessToken->delete();

        $newToken = $user->createToken('API Token')->plainTextToken;

        return response()->json([
            'token' => $newToken
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logout successful!'
        ]);
    }
}
