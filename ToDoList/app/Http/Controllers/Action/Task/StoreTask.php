<?php

namespace App\Http\Controllers\Action\Task;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Cast\Array_;

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
            'user_id' => $user_id = Auth::id(),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'deadline' => $request->input('deadline')
        ]);
    }
}
