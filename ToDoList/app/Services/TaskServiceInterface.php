<?php

namespace App\Services;

interface TaskServiceInterface
{
    public function GetAllTasks();
    public function GetTaskById($id);
    public function AddTask(array $task);
    public function DeleteTask($id);
    public function UpdateTask($id, array $task);
}
