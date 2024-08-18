<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Task $task
     * @return JsonResponse
     */
    public function __invoke(int $id): \Illuminate\Http\JsonResponse
    {
        $task = Task::findOrFail($id);
        return response()->json($task);
    }
}
