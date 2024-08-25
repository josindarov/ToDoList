<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Action\Auth\LoginUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected $loginUser;

    public function __construct(LoginUser $loginUser)
    {
        $this->loginUser = $loginUser;
    }

    public function __invoke(LoginRequest $loginRequest)
    {
        return $this->loginUser->execute($loginRequest);
    }
}
