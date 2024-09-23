<?php

namespace Modules\Task\app\Controllers\Action\Task;

use Modules\Task\app\Models\Task;

class UpdateTask
{
    public function handle(array $data, Task $task): void
    {
        $task->update([
            'category_id' => $data['category_id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'deadline' => $data['deadline']
        ]);
    }
}
