<?php

namespace Modules\Task\Controllers\Action\Task;

use Maatwebsite\Excel\Facades\Excel;
use Modules\Task\app\Imports\TasksImport;

class ImportTaskAction
{
    public function execute(array $data): void
    {
        Excel::import(new TasksImport, $data['file']);
    }
}
