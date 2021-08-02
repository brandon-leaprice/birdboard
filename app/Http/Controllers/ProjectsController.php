<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{

    protected function validateRequest()
    {
        return request()->validate([
            'title' => 'sometimes|required',
            'description' => 'sometimes|required',
            'notes' => 'nullable'
        ]);
    }

    public function index()
    {
        $projects = \auth()->user()->allProjects();

        return view('projects.index', compact('projects'));
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Project $project)
    {
        $this->authorize('update', $project);


        $project->update($this->validateRequest());

        return redirect($project->path());
    }

    public function show(Project $project)
    {
        $this->authorize('update', $project);

        return view('projects.show', compact('project'));
    }



    public function create()
    {
        return view('projects.create');
    }

    public function store()
    {
       $projects = \auth()->user()->projects()->create($this->validateRequest());

        return redirect($projects->path());
    }

    public function destroy(Project $project) {
        $this->authorize('manage', $project);

        $project->delete();

        return redirect('/projects');
    }


}
