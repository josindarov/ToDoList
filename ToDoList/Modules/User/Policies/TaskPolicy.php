<?php

namespace Modules\User\Policies;

use Illuminate\Auth\Access\Response;
use Modules\Task\app\Models\Task;
use Modules\User\app\Models\User;

class TaskPolicy
{
    /**
     * Determine whether the user can view any tasks.
     */
    public function viewAny(User $user): Response
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can view the task.
     */
    public function view(User $user, Task $task): Response
    {
        return $user->id === $task->user_id
            ? Response::allow()
            : Response::deny("You don't own this task.");
    }

    /**
     * Determine whether the user can create tasks.
     */
    public function create(User $user): Response
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can update the task.
     */
    public function update(User $user, Task $task): Response
    {
        return $user->id === $task->user_id
            ? Response::allow()
            : Response::deny("You don't own this task.");
    }

    /**
     * Determine whether the user can delete the task.
     */
    public function delete(User $user, Task $task): Response
    {
        return $user->id === $task->user_id
            ? Response::allow()
            : Response::deny("You don't own this task.");
    }

    /**
     * Determine whether the user can restore the task.
     */
    public function restore(User $user, Task $task): Response
    {
        return $user->id === $task->user_id
            ? Response::allow()
            : Response::deny("You don't own this task.");
    }
}
