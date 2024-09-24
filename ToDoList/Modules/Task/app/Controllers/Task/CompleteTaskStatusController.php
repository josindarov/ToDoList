<?php

namespace Modules\Task\app\Controllers\Task;

use App\Http\Controllers\Controller;
use Illuminate\Container\EntryNotFoundException;
use Illuminate\Http\JsonResponse;
use Modules\Task\app\Models\Task;
use SM\SMException;

class CompleteTaskStatusController extends Controller
{
    /**
     * @throws EntryNotFoundException
     * @throws SMException
     */
    public function statusChangeToComplete(Task $task): JsonResponse
    {
        $message = "You can not change to this status";

        if($task->canApply(\Modules\Task\app\Models\ConstNames::COMPLETE))
        {
            $task->update(['status' => \Modules\Task\app\Models\ConstNames::COMPLETED]);
            $message = "Status is changed";
        }

        return response()->json($message);
    }
}
