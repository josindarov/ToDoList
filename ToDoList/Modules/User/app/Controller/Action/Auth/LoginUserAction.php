<?php

namespace Modules\User\app\Controller\Action\Auth;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Modules\User\app\Models\User;

class LoginUserAction
{
    /**
     * @throws Exception
     */
    public function execute(array $data): JsonResponse
    {
        $user = User::whereEmail($data['email'])->first();

        if (!$user){
            throw new Exception('User not found');
        }
        if (!Hash::check($data['password'], $user->password)){
            throw new Exception('Wrong password');
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json(['user' => $user,'token' => $token]);
    }
}
