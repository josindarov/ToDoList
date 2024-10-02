<?php

namespace Modules\User\app\Controller\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\User\app\Controller\Action\Auth\LoginUserAction;
use Modules\User\Requests\LoginRequest;

class LoginController extends Controller
{
    protected LoginUserAction $loginUser;

    public function __construct(LoginUserAction $loginUser)
    {
        $this->loginUser = $loginUser;
    }

    /**
     * @throws \Exception
     */
    public function __invoke(LoginRequest $loginRequest): JsonResponse
    {
        $user = $loginRequest->validated();
        return $this->loginUser->execute($user);
    }
}
