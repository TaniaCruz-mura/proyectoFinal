<?php
 
namespace App\Policies;
 
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
 
class TaskPolicy
{
    public function view(User $user, Task $task): bool
    {
        return $user->hasRole('admin') || $task->project->isMember($user);
    }
 
    public function create(User $user, Project $project): bool
    {
        return $user->hasRole('admin')
            || ($user->can('crear tarea') && $project->isMember($user));
    }
 
    public function update(User $user, Task $task): bool
    {
        if ($user->hasRole('admin') || $task->project->owner_id === $user->id) {
            return true;
        }
 
        return $user->can('crear tarea') && $task->assignee_id === $user->id;
    }
 
    public function delete(User $user, Task $task): bool
    {
        return $user->hasRole('admin') || $task->project->owner_id === $user->id;
    }
 
    public function assign(User $user, Task $task): bool
    {
        return $user->hasRole('admin')
            || ($user->can('asignar tarea') && $task->project->owner_id === $user->id);
    }
 
    public function changeStatus(User $user, Task $task): bool
    {
        return $user->hasRole('admin')
            || $task->project->owner_id === $user->id
            || $task->assignee_id === $user->id;
    }
}
