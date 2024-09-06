<?php

namespace Modules\Task\app\Controllers\Task;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Task\app\Models\Task;


class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @throws AuthorizationException
     */
    public function __invoke(Request $request): JsonResponse
    {
        $this->authorize('viewAny', Task::class);
        $tasks = Task::where('user_id', $request->user()->id)->get();

        return response()->json($tasks);
    }
}
