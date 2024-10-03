<?php

namespace Modules\Task\app\Controllers\Action\Task;

use Illuminate\Container\EntryNotFoundException;
use Modules\Task\app\Models\ConstNames;
use Modules\Task\app\Models\Task;
use SM\SMException;

class CompleteTaskAction
{
    /**
     * @throws EntryNotFoundException
     * @throws SMException
     */
    public function handle(Task $task): Task
    {
        if($task->canApply(ConstNames::COMPLETE))
        {
            $task->apply(ConstNames::COMPLETE);
            $task->save();
        }

        return $task;
    }
}
