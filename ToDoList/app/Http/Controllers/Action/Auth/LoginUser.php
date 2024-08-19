<?php

namespace App\Http\Controllers\Action\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginUser
{
    public function execute(Request $request)
    {
        $this->validateRequest($request);

        $user = $this->getUserByEmail($request->email);

        if (!$this->checkPassword($request->password, $user->password)) {
            return $this->invalidPasswordResponse();
        }

        $token = $this->createUserToken($user);

        return $this->successResponse($user, $token);
    }

    protected function validateRequest(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ]);
    }

    protected function getUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    protected function checkPassword($inputPassword, $storedPassword)
    {
        return Hash::check($inputPassword, $storedPassword);
    }

    protected function createUserToken(User $user): string
    {
        return $user->createToken($user->name)->plainTextToken;
    }

    protected function invalidPasswordResponse()
    {
        return response()->json([
            'errors' => [
                'password' => ['The provided password is incorrect.']
            ]
        ]);
    }

    protected function successResponse(User $user, $token): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }
}
