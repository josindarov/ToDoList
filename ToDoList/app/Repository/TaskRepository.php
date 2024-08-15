<?php

namespace App\Repository;

use App\Models\Task;
use App\Repository\ITaskRepository;

class TaskRepository implements ITaskRepository
{
    private Task $task;
    function __construct(Task $task)
    {
        $this->$task = $task;
    }
    public function GetAllTasks()
    {
        return $this->task->all();
    }

    public function GetTaskById($id)
    {
        return $this->task->findOrFail($id);
    }

    public function AddTask(array $task)
    {
        return $this->task->create($task);
    }

    public function DeleteTask($id)
    {
        return $this->task->findOrFail($id)->delete();
    }

    public function UpdateTask($id, array $task)
    {
        $updatedTask = $this->GetTaskById($id);
        $updatedTask->update($task);
        return $updatedTask;
    }
}
