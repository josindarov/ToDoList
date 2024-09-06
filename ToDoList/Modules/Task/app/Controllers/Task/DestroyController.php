<?php

namespace Modules\Task\app\Controllers\Task;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Modules\Task\app\Models\Task;

class DestroyController extends Controller
{
    /**
     * Handle the incoming request.
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function __invoke(Task $task): JsonResponse
    {
        $this->authorize('delete', $task);
        $task->delete();
        return response()->json("Task is deleted");
    }
}
