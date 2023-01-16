<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $typeOfproject = Type::all();
        return view('admin.projects.create', compact('typeOfproject'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $addProject = $request->validated();

        $addProject['slug'] = Str::slug($addProject['title']);
        // add image if existe to the column through the request
        if ($request->hasFile('new_image')) {
            $addProject['new_image'] = Storage::put('images', $request->new_image);
        };
        $addProject['user_id'] = Auth::id();
        $project = Project::create($addProject);
        return redirect()->route('admin.projects.index')->with('projectAddedSuccessfully', 'Progetto aggiunto con successo');
    }

    /**
     * Display the specified resource.
     *--------------------------------------------------------------------------------------------------------------
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $type = new Type();
        return view('admin.projects.edit', compact('project', 'type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $projectToChange = $request->validated();
        $projectToChange['slug'] = Str::slug($projectToChange['title']);
        if ($request->hasFile('new_image')) {
            if ($project->new_image) {
                Storage::delete($project->new_image);
                $projectToChange['new_image'] = Storage::put('images', $request->new_image);
            }
        }

        $project->update($projectToChange);

        return redirect()->route('admin.projects.index')->with('projectUpdatedSuccessfully', "$project->title è stato aggiornato con successo");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if ($project->new_image) {
            Storage::delete($project->new_image);
        }
        $project->delete();
        return redirect()->route('admin.projects.index')->with('projectDeleted', "$project->title è stato cancellato");
    }
}
