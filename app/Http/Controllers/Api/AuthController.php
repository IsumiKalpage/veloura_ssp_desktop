<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    // 🔑 Register API
    public function register(Request $request)
    {
        $data = $request->validate([
            'name'     => ['required','string','max:255'],
            'email'    => ['required','email','max:255','unique:users,email'],
            'password' => ['required','confirmed', Password::defaults()],
        ]);

        // Split full name into first_name and last_name
        $fullName   = $data['name'];
        $parts      = explode(' ', $fullName, 2);
        $firstName  = $parts[0];
        $lastName   = $parts[1] ?? null;

        $user = User::create([
            'first_name' => $firstName,
            'last_name'  => $lastName,
            'name'       => $fullName, // keep original full name if your table has it
            'email'      => $data['email'],
            'password'   => Hash::make($data['password']),
            'role'       => 'customer',
        ]);

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json(['user' => $user, 'token' => $token], 201);
    }

    // 🔑 Login API
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid login details'], 401);
        }

        $user = Auth::user();

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }

    // 👤 Current user (requires auth:sanctum)
    public function me(Request $request)
    {
        return response()->json($request->user());
    }

    // 🔐 Logout API
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out']);
    }
}
