<?php

namespace Modules\Task\app\Controllers\Task;


use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Modules\Task\app\Controllers\Action\Task\StoreTask;
use Modules\Task\app\Models\Task;
use Modules\Task\app\Requests\StoreTaskRequest;

class StoreController extends Controller
{
    protected StoreTask $storeTask;

    public function __construct(StoreTask $storeTask)
    {
        $this->storeTask = $storeTask;
    }

    /**
     * Handle the incoming request.
     *
     * @param StoreTaskRequest $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function __invoke(StoreTaskRequest $request): JsonResponse
    {
        $this->authorize('create', Task::class);
        $validated = $request->validated();
        $this->storeTask->handle($validated);

        return response()->json("Task Created Successfully");
    }
}
