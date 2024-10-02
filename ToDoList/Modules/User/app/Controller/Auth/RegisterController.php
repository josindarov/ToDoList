<?php

namespace Modules\User\app\Controller\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\User\app\Controller\Action\Auth\RegisterUserAction;
use Modules\User\Requests\RegisterRequest;


class RegisterController extends Controller
{
    protected RegisterUserAction $registerUser;

    public function __construct(RegisterUserAction $registerUser)
    {
        $this->registerUser = $registerUser;
    }

    public function __invoke(RegisterRequest $registerRequest): JsonResponse
    {
        $user = $registerRequest->validated();
        return $this->registerUser->execute($user);
    }
}
