<?php

namespace Modules\Task\app\Controllers\Task;

use App\Http\Controllers\Controller;
use Illuminate\Container\EntryNotFoundException;
use Illuminate\Http\JsonResponse;
use Modules\Task\app\Models\Task;
use SM\SMException;


class StartTaskStatusController extends Controller
{
    /**
     * @throws EntryNotFoundException
     * @throws SMException
     */
    public function statusChangeToStart(Task $task): JsonResponse
    {
        $message = "You can not change to this status";
        if($task->canApply(\Modules\Task\app\Models\ConstNames::START))
        {
            $task->update(['status' => \Modules\Task\app\Models\ConstNames::IN_PROGRESS]);
            $message = "Status is changed";
        }

        return response()->json($message);
    }
}
