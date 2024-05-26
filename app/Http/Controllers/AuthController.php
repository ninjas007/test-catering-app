<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        // Validate email is role user
        $user = User::where('email', $request->email)->first();
        if ($user && $user->role !== 'customer') {
            return response()->json([
                'message' => 'Invalid email or password. only customer here'
            ], 401);
        }

        // Validate credentials
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid email or password'
            ], 401);
        }

        $user = Auth::user();
        return response()->json([
            'message' => 'Login successful',
        ], 200);
    }
}
