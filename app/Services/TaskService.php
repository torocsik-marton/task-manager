<?php

namespace App\Services;


use App\Task;
use Auth;

class TaskService
{
    public $task;
    public $user;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function addTask($title, $description)
    {
        return $this->task->create([
            'title'       => $title,
            'description' => $description,
            'user_id'     => Auth::id()
        ]);
    }

    public function completeTask($id)
    {
        $task            = Task::find($id);
        $task->completed = 1;
        $task->save();
    }
}