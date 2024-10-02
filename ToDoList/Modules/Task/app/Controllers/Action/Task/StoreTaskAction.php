<?php

namespace Modules\Task\app\Controllers\Action\Task;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Task\app\Models\Task;

class StoreTaskAction
{
    public function handle(array $data): void
    {
        $task = Task::create([
            'user_id' => $user_id = Auth::id(),
            'category_id' => $data['category_id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'deadline' => $data['deadline'],
            'status' => $data['status'],
        ]);

        $task->save();
    }
}
