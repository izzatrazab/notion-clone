<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\User;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(){
        return Inertia::render('Dashboard');
    }
}
