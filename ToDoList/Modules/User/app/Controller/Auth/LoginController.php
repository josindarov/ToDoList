<?php

namespace Modules\User\app\Controller\Auth;

use App\Http\Controllers\Controller;
use Modules\User\app\Controller\Action\Auth\LoginUser;
use Modules\User\Requests\LoginRequest;

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
