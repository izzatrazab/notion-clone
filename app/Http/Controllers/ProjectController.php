<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function index()
    {
        return Inertia::render('Project/index');
    }

    public function indexName()
    {
        $projects = Project::select('name', 'id')->where('user_id', auth()->id())->get();
        return response()->json([
            'projects' => $projects
        ]);
    }

    public function show(String $project_id)
    {
        $project = Project::select('id', 'name', 'start', 'end')->where('user_id', auth()->id())->where('id', $project_id)->first();
        return Inertia::render('Project/show', ['project' => $project]);
    }

    // create a project
    public function create()
    {
        date_default_timezone_set('Asia/Kuala_Lumpur');
        try {
            $new_project = Project::create(
                [
                    'user_id'   => auth()->id(),
                    'name' => 'new project',
                    'start' => date('Y-m-d'),
                    'end' => date('Y-m-d')
                ]
            );
            return response()->json([
                'project_id' => $new_project->id
            ]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false]);
            dd("ProjectController, create function", $th);
        }
    }

    // update a project
    public function store(Request $request)
    {
        Project::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'id' => $request->get('project_id')
            ],
            [
                'name' => $request->get('name'),
                'start' => $request->get('start'),
                'end' => $request->get('end')
            ]
        );
    }
}
