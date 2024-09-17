<?php

namespace Modules\Task\app\Controllers\Action\Task;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Task\app\Models\Task;

class StoreTask
{
    public function handle(Request $request): Task
    {
        // Create a new task using the validated request data
        return Task::create([
            'user_id' => $user_id = Auth::id(),
            'category_id' => $request->input('category_id'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'deadline' => $request->input('deadline'),
            'status' => $request->input('status'),
        ]);
    }
}
