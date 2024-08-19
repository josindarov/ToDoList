<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Action\Auth\RegisterUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class RegisterController extends Controller
{
    protected $registerUser;

    public function __construct(RegisterUser $registerUser)
    {
        $this->registerUser = $registerUser;
    }

    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        return $this->registerUser->execute($request);
    }
}
