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
    public function __invoke(Task $task): JsonResponse
    {
        $this->authorize('show', $task);
        return response()->json($task);
    }
}
