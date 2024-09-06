<?php

namespace Modules\Task\app\Controllers\Task;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Modules\Task\app\Models\Task;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Task $task
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function __invoke(Task $task): JsonResponse
    {
        $this->authorize('view', $task);
        return response()->json($task);
    }
}
