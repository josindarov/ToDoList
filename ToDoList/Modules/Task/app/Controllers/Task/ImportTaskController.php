<?php

namespace Modules\Task\app\Controllers\Task;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Task\app\Imports\TasksImport;
use Modules\Task\app\Models\Task;
use Modules\Task\app\Requests\ImportTaskRequest;

class ImportTaskController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function __invoke(ImportTaskRequest $request): JsonResponse
    {
        $this->authorize('create', Task::class);

        Excel::import(new TasksImport, $request->file('file'));

        return response()->json(['message' => 'Tasks imported successfully']);
    }
}
