<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Action\Auth\LogoutUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    protected $logoutUser;

    public function __construct(LogoutUser $logoutUser)
    {
        $this->logoutUser = $logoutUser;
    }

    public function __invoke(Request $request)
    {
        return $this->logoutUser->execute($request->user());
    }
}
