<?php

namespace Modules\Task\app\Controllers\Task;

use App\Http\Controllers\Controller;
use Illuminate\Container\EntryNotFoundException;
use Illuminate\Http\JsonResponse;
use Modules\Task\app\Controllers\Action\Task\CompleteTaskAction;
use Modules\Task\app\Models\Task;
use SM\SMException;

class CompleteTaskStatusController extends Controller
{
    private CompleteTaskAction $completeTask;

    function __construct(CompleteTaskAction $completeTask)
    {
        $this->completeTask = $completeTask;
    }
    /**
     * @throws EntryNotFoundException
     * @throws SMException
     */
    public function __invoke(Task $task): JsonResponse
    {
        try
        {
            $result = $this->completeTask->handle($task);
        }
        catch(SmException $e){
            throw new SMException($e);
        }

        return response()->json($result);
    }
}
