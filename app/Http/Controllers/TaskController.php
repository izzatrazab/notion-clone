<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // fetch all 
    public function index(String $project_id)
    {
        $tasks = Task::select('id', 'name', 'start', 'end', 'progress', 'dependencies', 'priority')->where('project_id', $project_id)->get();
        return response()->json([
            'tasks' => $tasks
        ]);
    }
}
