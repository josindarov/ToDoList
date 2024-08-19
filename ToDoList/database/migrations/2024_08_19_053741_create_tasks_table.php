<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        // Validate the incoming request
        $validated = $request->validate([
            'user_id' => Auth::id(),
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => false
        ]);

        // Create the task
        $task = Task::create($validated);

        // Return a JSON response with the created task
        return response()->json(['task' => $task], 201);
    }
}
