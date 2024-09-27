<?php

namespace Modules\User\Policies;

use Illuminate\Auth\Access\Response;
use Modules\Task\app\Models\Task;
use Modules\User\app\Models\User;

class TaskPolicy
{
    public function viewAny(User $user): Response
    {
        return $user->can('view tasks') ? Response::allow() : Response::deny("You don't have permission to view tasks.");
    }

    public function view(User $user, Task $task): Response
    {
        return $user->id === $task->user_id && $user->can('view tasks')
            ? Response::allow()
            : Response::deny("You don't own this task.");
    }

    public function create(User $user): Response
    {
        return $user->can('create tasks') ? Response::allow() : Response::deny("You don't have permission to create tasks.");
    }

    public function update(User $user, Task $task): Response
    {
        return $user->id === $task->user_id && $user->can('edit tasks')
            ? Response::allow()
            : Response::deny("You don't have permission to update this task.");
    }

    public function delete(User $user, Task $task): Response
    {
        return $user->id === $task->user_id && $user->can('delete tasks')
            ? Response::allow()
            : Response::deny("You don't have permission to delete this task.");
    }

    public function export(User $user): Response
    {
        return $user->can('export tasks')
            ? Response::allow()
            : Response::deny("You don't have permission to export tasks.");
    }
}
