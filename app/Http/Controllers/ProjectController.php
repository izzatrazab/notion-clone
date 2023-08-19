<?php

namespace App\Http\Controllers;

use App\Models\Project;

class ProjectController extends Controller
{
    // 
    public function index(){
        $projects = Project::where('user_id','=', '2');
        return $projects;
    }
}
