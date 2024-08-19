<?php

namespace App\Http\Controllers\Action\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterUser
{
    public function execute(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validateRequest($request);

        $user = $this->createUser($request);

        $token = $user->createToken($request->name)->plainTextToken;

        return response()->json(['user' => $user, 'token' => $token]);
    }

    protected function validateRequest(Request $request): void
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
    }

    protected function createUser(Request $request)
    {
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    }
}
