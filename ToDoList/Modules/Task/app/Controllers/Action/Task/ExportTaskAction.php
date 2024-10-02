<?php

namespace Modules\Task\Controllers\Action\Task;

use Maatwebsite\Excel\Facades\Excel;
use Modules\Task\app\Exports\TaskExport;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportTaskAction
{
    public function execute(): BinaryFileResponse
    {
        return Excel::download(new TaskExport(), "tasks.xlsx");
    }
}
