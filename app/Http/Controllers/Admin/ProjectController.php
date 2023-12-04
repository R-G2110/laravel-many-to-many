<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use App\Functions\Helper;
use App\Http\Requests\ProjectRequest;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::orderBy('delivery_date', 'desc')->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    public function typeProject() {
        $projects = Project::orderBy('delivery_date', 'desc')->paginate(10);
        return view('admin.projects.type-project', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Inserimento nuovo progetto';
        $method = 'POST';
        $route = route('admin.projects.store');
        $project = null;
        $technologies = Technology::all();
        $types = Type::all();
        return view('admin.projects.create-edit', compact('title','method', 'route','project', 'technologies', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $form_data = $request->all();
        $new_project = new Project();
        $new_project->fill($form_data);
        $new_project["slug"] = Project::generateSlug($form_data["name"]);
        $new_project["status"] = 'in process';
        $new_project->save();

        if (array_key_exists('technologies', $form_data)){
            $new_project->technologies()->attach($form_data['technologies']);
        }
        return redirect()->route('admin.projects.show', $new_project->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $title = 'Modifica progetto';
        $method = 'PUT';
        $route = route('admin.projects.update', $project);
        $technologies = Technology::all();
        $types = Type::all();


        return view('admin.projects.create-edit', compact('project','title','method', 'route','technologies', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $form_data = $request->all();
        $project->update($form_data);

        if (array_key_exists('technologies', $form_data)) {
            $project->technologies()->sync($form_data['technologies']);
        }else{
            $project->technologies()->detach();
        }
        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('deleted', "Il progetto '$project->name' è stato eliminato correttamente!");
    }
}
