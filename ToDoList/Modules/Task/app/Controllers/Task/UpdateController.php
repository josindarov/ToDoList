<?php

namespace Modules\Task\app\Controllers\Task;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Modules\Task\app\Models\Task;
use Modules\Task\app\Requests\UpdateTaskRequest;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function __invoke(UpdateTaskRequest $request, Task $task): JsonResponse
    {
        $this->authorize('update', $task);

        if(!$task)
        {
            return response()->json('Task is not found');
        }
        else
        {
            $task->update($request->only('title', 'description', 'deadline', 'completed'));

            return response()->json($task);
        }
    }
}
