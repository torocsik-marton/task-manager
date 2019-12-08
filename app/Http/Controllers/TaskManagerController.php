<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddTask;
use App\Services\TaskService;
use App\Task;
use Illuminate\Http\Request;
use Auth;

class TaskManagerController extends Controller
{
    private $task_service;

    public function __construct(TaskService $task_service)
    {
        $this->task_service = $task_service;
    }

    public function taskManagerView()
    {
        $view_data = [
            'tasks' => Task::where('completed', 0)
                ->get()
        ];

        return view('task_manager', $view_data);
    }


    public function addTask(AddTask $request)
    {
        $this->task_service->addTask(
            $request->input('title'),
            $request->input('description')
        );

        return redirect()
            ->back()
            ->with('success', 'Task created.');
    }


    public function completeTask($id)
    {
        $task = Task::find($id);

        if (!empty($task)) {
            $user             = Auth::user();
            $user_permissions = $user
                ->permissions()
                ->get(['permission'])
                ->pluck('permission')
                ->toArray();

            if (in_array('complete_any_task', $user_permissions) || (in_array('complete_own_task', $user_permissions) && $user->id === $task->user_id)) {
                $this->task_service->completeTask($id);

                return redirect()
                    ->back()
                    ->with('success', 'Task completed.');
            }

            return redirect()
                ->back()
                ->with('error', 'You don\'t have permission to complete this task.');
        }

        return redirect()
            ->back()
            ->with('error', 'There is no task with the given ID.');
    }
}