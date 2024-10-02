<?php

namespace Modules\Task\app\Controllers\Task;

use App\Http\Controllers\Controller;
use Illuminate\Container\EntryNotFoundException;
use Illuminate\Http\JsonResponse;
use Modules\Task\app\Controllers\Action\Task\StartTaskAction;
use Modules\Task\app\Models\Task;
use SM\SMException;

class StartTaskStatusController extends Controller
{
    private StartTaskAction $startTask;

    function __construct(StartTaskAction $startTask)
    {
        $this->startTask = $startTask;
    }

    /**
     * @throws SMException
     * @throws EntryNotFoundException
     */
    public function __invoke(Task $task): JsonResponse
    {
        try
        {
            $result = $this->startTask->handle($task);
        }
        catch(SmException $e){
            throw new SMException($e);
        }

        return response()->json($result);
    }
}
