<?php

namespace App\Http\Controllers\Action\Task;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreTask
{
    /**
     * Handle task creation.
     *
     * @param Request $request
     * @return Task
     */
    public function handle(Request $request): Task
    {
        // Create a new task using the validated request data
        return Task::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'user_id' => $user_id = Auth::id()
        ]);
    }
}
