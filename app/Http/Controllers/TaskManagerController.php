<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddTask;
use App\Services\PermissionService;
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
        $user = Auth::user();
        $permission_service = new PermissionService($user);

        if ($permission_service->userHasPermission('complete_any_task')) {
            $view_data['tasks'] = Task::where('completed', 0)
                ->get();
        } else {
            $view_data['tasks'] = $user->uncompletedTasks;
        }

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
            $permission_service = new PermissionService($user);

            if ($permission_service->userHasPermission('complete_any_task') || ($permission_service->userHasPermission('complete_own_task') && $user->id === $task->user_id)) {
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