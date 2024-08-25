<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     */
    public function __invoke(Request $request): JsonResponse
    {
        $this->authorize('viewAny', Task::class);
        $tasks = Task::where('user_id', $request->user()->id)->get();

        return response()->json($tasks);
    }
}
