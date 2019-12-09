<?php

namespace App\Policies;

use App\Task;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;


    public function __construct()
    {
        //
    }


    public function seeAll(User $user) {
        return (in_array('complete_any_task', $user->permission_list));
    }


    public function complete(User $user, Task $task) {
        return (in_array('complete_any_task', $user->permission_list) || (in_array('complete_own_task', $user->permission_list) && $user->id === $task->user_id));
    }
}
