<?php

namespace Modules\Task\app\Controllers\Action\Task;

use Illuminate\Container\EntryNotFoundException;
use Modules\Task\app\Models\Task;
use SM\SMException;

class StartTaskAction
{

    /**
     * @throws EntryNotFoundException
     * @throws SMException
     */
    public function handle(Task $task): Task
    {
        if($task->canApply(\Modules\Task\app\Models\ConstNames::START))
        {
            $task->apply(\Modules\Task\app\Models\ConstNames::START);
            $task->save();
            return $task;
        }
        else
        {
            throw new SMException("You cannot change to this status");
        }
    }
}
