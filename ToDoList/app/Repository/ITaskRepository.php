<?php

namespace App\Repository;

interface ITaskRepository
{
    public function GetAllTasks();
    public function GetTaskById($id);
    public function AddTask($task);
    public function DeleteTask($id);
    public function UpdateTask($id, $task);

}
