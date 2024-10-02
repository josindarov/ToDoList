<?php

namespace Modules\Task\app\Controllers\Task;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Modules\Task\app\Controllers\Action\Task\UpdateTaskAction;
use Modules\Task\app\Models\Task;
use Modules\Task\app\Requests\UpdateTaskRequest;

class UpdateController extends Controller
{
    private UpdateTaskAction $updateTask;

    function __construct(UpdateTaskAction $updateTask)
    {
        $this->updateTask = $updateTask;
    }
    /**
     * Handle the incoming request.
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function __invoke(UpdateTaskRequest $request, Task $task): JsonResponse
    {
        $this->authorize('update', $task);
        $validated = $request->validated();
        $this->updateTask->handle($validated, $task);

        return response()->json("Task updated successfully");
    }
}
