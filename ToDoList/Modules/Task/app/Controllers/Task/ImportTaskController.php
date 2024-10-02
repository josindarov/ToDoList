<?php

namespace Modules\Task\app\Controllers\Task;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Task\app\Imports\TasksImport;
use Modules\Task\app\Models\Task;
use Modules\Task\app\Requests\ImportTaskRequest;
use Modules\Task\Controllers\Action\Task\ImportTaskAction;

class ImportTaskController extends Controller
{
    private ImportTaskAction $importTaskAction;

    function __construct(ImportTaskAction $importTaskAction)
    {
        $this->importTaskAction = $importTaskAction;
    }
    /**
     * @throws AuthorizationException
     */
    public function __invoke(ImportTaskRequest $request): JsonResponse
    {
        $this->authorize('create', Task::class);
        $task = $request->validated();

        try {
            $this->importTaskAction->execute($task);
            return response()->json(['message' => 'Tasks imported successfully']);
        }catch (\Exception $exception){
            return response()->json(['error' => $exception->getMessage()]);
        }
    }
}
