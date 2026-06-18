<?php
 
namespace App\Policies;
 
use App\Models\Comment;
use App\Models\Task;
use App\Models\User;
 
class CommentPolicy
{
    public function create(User $user, Task $task): bool
    {
        return $user->hasRole('admin')
            || ($user->can('comentar') && $task->project->isMember($user));
    }
 
    public function delete(User $user, Comment $comment): bool
    {
        return $user->hasRole('admin') || $comment->user_id === $user->id;
    }
}
