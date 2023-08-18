<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(User $id){
        $projects = Project::all();

        return Inertia::render('Dashboard', [
            'project' => $projects
        ]);
    }
}
