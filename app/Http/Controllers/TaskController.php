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
        $tasks = Task::select('id', 'name', 'start', 'end', 'progress', 'dependencies', 'priority', 'order')->where('project_id', $project_id)->orderBy('order')->get();
        return response()->json([
            'tasks' => $tasks
        ]);
    }

    public function create(Request $request){
        
        date_default_timezone_set('Asia/Kuala_Lumpur');
        try{
            $new_task = Task::create([
                'project_id' => $request->input('project_id'),
                'name' => 'task ' . strval($request->input('order')),
                'start' => date('Y-m-d'),
                'end' => date('Y-m-d'),
                'progress' => 0,
                'dependencies' => '',
                'priority' => 'low',
                'order' => $request->input('order')
            ]);
            return response()->json(['new_task' => $new_task]);

        } catch (\Throwable $th) {
            return response()->json(['status' => $th]);
            dd("TaskController, create function", $th);
        }
    }

    public function reorder(Request $request){
        $idArray = $request->input('tasks_ids');
        $orderArray = $request->input('order');

        try {
            for ($i=0; $i < sizeof($idArray) ; $i++) {
                Task::updateOrCreate(
                    ['id' => $idArray[$i]],
                    ['order' => $orderArray[$i]]
                );
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => $th]);
            dd("TaskController, create function", $th);
        }
    }

    public function updateProgress(Request $request){
        try {
            Task::updateOrCreate(
                ['id' => $request->get('task_id')],
                ['progress' => $request->get('progress')]
            );
            
            return response()->json(['status' => true]);
        } catch (\Throwable $th) {
            return response()->json(['status' => $th]);
            // dd("TaskController, create function", $th);
        }
    }

    public function updateStartDate(Request $request){
        try {
            Task::updateOrCreate(
                ['id' => $request->get('task_id')],
                ['start' => $request->get('new_date')]
            );
            
            return response()->json(['status' => true]);
        } catch (\Throwable $th) {
            
            return response()->json(['status' => $th]);
            // dd("TaskController, create function", $th);
        }
    }
    public function updateEndDate(Request $request){
        try {
            Task::updateOrCreate(
                ['id' => $request->get('task_id')],
                ['end' => $request->get('new_date')]
            );
            
            return response()->json(['status' => true]);
        } catch (\Throwable $th) {
            
            return response()->json(['status' => $th]);
            // dd("TaskController, create function", $th);
        }
    }
}
