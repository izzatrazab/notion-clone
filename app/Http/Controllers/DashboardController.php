<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(User $id){
        // $projects = Project::all();
        $projects = Project::where('user_id',  auth()->id())->get();

        return Inertia::render('Dashboard', [
            'project' => $projects
        ]);
    }
}
