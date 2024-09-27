<?php

namespace Modules\Task\app\Controllers\Task;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Task\app\Exports\TaskExport;
use Modules\Task\app\Models\Task;
use Modules\Task\app\Requests\ExportTaskRequest;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportTaskController extends Controller
{

    /**
     * @throws AuthorizationException
     */
    public function __invoke(ExportTaskRequest $request): BinaryFileResponse
    {
        $this->authorize('export', Task::class);
        return Excel::download(new TaskExport(), "tasks.xlsx");
    }
}
