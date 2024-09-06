<?php

namespace Modules\User\app\Controller\Action\Auth;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Modules\User\app\Models\User;

class LoginUser
{
    public function execute(Request $request): JsonResponse
    {
        $user = $this->getUserByEmail($request->email);
        if(!$user){
            throw new Exception("Auth not found");
        }

        if (!$this->checkPassword($request->password, $user->password)) {
            return $this->invalidPasswordResponse();
        }

        $token = $this->createUserToken($user);

        return $this->successResponse($user, $token);
    }


    protected function getUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    protected function checkPassword($inputPassword, $storedPassword): bool
    {
        return Hash::check($inputPassword, $storedPassword);
    }

    protected function createUserToken(User $user): string
    {
        return $user->createToken($user->name)->plainTextToken;
    }

    protected function invalidPasswordResponse(): JsonResponse
    {
        return response()->json([
            'errors' => [
                'password' => ['The provided password is incorrect.']
            ]
        ]);
    }

    protected function successResponse(User $user, $token): JsonResponse
    {
        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }
}
