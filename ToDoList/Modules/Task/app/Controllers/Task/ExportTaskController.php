<?php

namespace Modules\Task\app\Controllers\Task;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Task\app\Exports\TaskExport;
use Modules\Task\app\Models\Task;
use Modules\Task\app\Requests\ExportTaskRequest;

class ExportTaskController extends Controller
{

    /**
     * @throws AuthorizationException
     */
    public function __invoke(ExportTaskRequest $request)
    {
        $this->authorize('viewAny', Task::class);
        $format = $request->get('format', 'xlsx');
        return Excel::download(new TaskExport(), "tasks.{$format}");
    }
}
