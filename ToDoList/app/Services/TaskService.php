<?php

namespace App\Services;

use App\Services\TaskServiceInterface;

class TaskService implements TaskServiceInterface
{
    private \App\Services\TaskServiceInterface $taskService;

    function __construct(TaskServiceInterface $taskService)
    {
        $this->taskService = $taskService;
    }
    public function GetAllTasks()
    {
        return $this->taskService->GetAllTasks();
    }

    public function GetTaskById($id)
    {
        return $this->taskService->GetTaskById($id);
    }

    public function AddTask(array $task)
    {
        return $this->taskService->AddTask($task);
    }

    public function DeleteTask($id)
    {
        return $this->taskService->DeleteTask($id);
    }

    public function UpdateTask($id, array $task)
    {
        return $this->taskService->UpdateTask($id, $task);
    }
}
