<?php

namespace Modules\User\app\Controller\Action\Auth;

class LogoutUser
{
    public function execute($user): \Illuminate\Http\JsonResponse
    {
        $this->revokeTokens($user);
        return $this->successResponse();
    }

    protected function revokeTokens($user): void
    {
        $user->tokens()->delete();
    }

    protected function successResponse(): \Illuminate\Http\JsonResponse
    {
        return response()->json(['message' => 'Logged out successfully']);
    }
}
