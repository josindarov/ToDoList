<?php

namespace Modules\User\app\Controller\Action\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Modules\User\app\Models\User;

class RegisterUser
{
    public function execute(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = $this->createUser($request);
        $user->assignRole('user');
        $token = $user->createToken($request->name)->plainTextToken;

        return response()->json(['user' => $user, 'token' => $token]);
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
