<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DestroyController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(int $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
