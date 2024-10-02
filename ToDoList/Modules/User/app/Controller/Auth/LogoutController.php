<?php

namespace Modules\User\app\Controller\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\User\app\Controller\Action\Auth\LogoutUserAction;

class LogoutController extends Controller
{
    protected LogoutUserAction $logoutUser;

    public function __construct(LogoutUserAction $logoutUser)
    {
        $this->logoutUser = $logoutUser;
    }

    public function __invoke(Request $request): JsonResponse
    {
        return $this->logoutUser->execute($request->user());
    }
}
