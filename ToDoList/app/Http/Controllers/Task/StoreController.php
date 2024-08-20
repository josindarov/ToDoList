<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Action\Task\StoreTask;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
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
        // Use the StoreTask action to create a new task
        $task = $this->storeTask->handle($request);
        $task->save();

        // Return the created task as a JSON response
        return response()->json($task);
    }
}
