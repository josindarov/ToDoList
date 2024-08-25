<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Action\Auth\RegisterUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


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
