<?php

namespace Modules\Task\app\Controllers\Task;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Task\app\Exports\TaskExport;
use Modules\Task\app\Models\Task;
use Modules\Task\app\Requests\ExportTaskRequest;
use Modules\Task\Controllers\Action\Task\ExportTaskAction;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportTaskController extends Controller
{
    private ExportTaskAction $exportTaskAction;

    function __construct(ExportTaskAction $exportTaskAction)
    {
        $this->exportTaskAction = $exportTaskAction;
    }

    /**
     * @throws AuthorizationException
     */
    public function __invoke(): BinaryFileResponse
    {
        $this->authorize('export', Task::class);
        return $this->exportTaskAction->execute();
    }
}
