<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class ProjectTasksController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function store(Project $project): Redirector|Application|RedirectResponse
    {
        $this->authorize('update', $project);

        request()->validate(['body' => 'required']);

        $project->addTask(request('body'));

        return redirect($project->path());
    }

    /**
     * @throws AuthorizationException
     */
    public function update(Project $project, Task $task): Redirector|Application|RedirectResponse
    {
        $this->authorize('update', $project);



        $task->update(\request()->validate(['body' => 'required']));

         request('completed') ? $task->complete() : $task->incomplete();


        return redirect($project->path());
    }
}
