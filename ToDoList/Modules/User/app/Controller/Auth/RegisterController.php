<?php

namespace Modules\User\app\Controller\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\User\app\Controller\Action\Auth\RegisterUser;
use Modules\User\Requests\RegisterRequest;


class RegisterController extends Controller
{
    protected $registerUser;

    public function __construct(RegisterUser $registerUser)
    {
        $this->registerUser = $registerUser;
    }

    public function __invoke(RegisterRequest $registerRequest): JsonResponse
    {
        return $this->registerUser->execute($registerRequest);
    }
}
