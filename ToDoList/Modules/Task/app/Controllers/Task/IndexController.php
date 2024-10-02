<?php

namespace Modules\Task\app\Controllers\Task;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Modules\Task\app\Models\Task;
use Modules\Task\app\Requests\IndexTaskRequest;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     * @throws AuthorizationException
     */
    public function __invoke(IndexTaskRequest $request): JsonResponse
    {
        $this->authorize('viewAny', Task::class);

        if ($request->user()->hasRole('admin')) {
            $tasks = Task::all();
        } else {
            $tasks = Task::where('user_id', $request->user()->id)->get();
        }

        return response()->json($tasks);
    }
}

