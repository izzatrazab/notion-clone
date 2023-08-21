<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\User;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(User $id){
        // $projects = Project::all();
        $blocks = Block::where('user_id',  auth()->id())->get();

        return Inertia::render('Dashboard', [
            'blocks' => $blocks
        ]);
    }
}
