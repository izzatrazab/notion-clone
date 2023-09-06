<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
// use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function index()
    {
        return Inertia::render('Project/index');
    }

    public function show(String $project_id)
    {
        // $memo = Project::select('name', 'id', 'json_memo')->where('user_id', auth()->id())->where('id', $memo_id)->get();
        return Inertia::render('Project/show', ['project_id' => $project_id]);
    }
}
