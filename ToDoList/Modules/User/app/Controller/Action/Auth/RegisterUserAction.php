<?php

namespace Modules\User\app\Controller\Action\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Modules\User\app\Models\User;

class RegisterUserAction
{
    public function execute(array $data): JsonResponse
    {
        $user = $this->createUser($data);
        $user->assignRole('user');
        $token = $user->createToken($data['name'])->plainTextToken;

        return response()->json(['user' => $user, 'token' => $token]);
    }

    protected function createUser(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
