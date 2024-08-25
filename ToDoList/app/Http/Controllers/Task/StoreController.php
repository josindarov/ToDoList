<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Action\Task\StoreTask;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    protected $storeTask;

    public function __construct(StoreTask $storeTask)
    {
        $this->storeTask = $storeTask;
    }

    /**
     * Handle the incoming request.
     *
     * @param StoreTaskRequest $request
     * @return JsonResponse
     */
    public function __invoke(StoreTaskRequest $request): JsonResponse
    {
        $this->authorize('create', Task::class);
        $task = $this->storeTask->handle($request);
        $task->save();

        return response()->json($task);
    }
}
