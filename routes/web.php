<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemoController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

    // memo
    Route::get('api/memo', [MemoController::class, 'indexName']);
    Route::post('api/memo', [MemoController::class,'create']);
    Route::put('api/memo', [MemoController::class,'store']);
    Route::delete('api/memo', [MemoController::class,'delete']);
    Route::get('/memo', [MemoController::class, 'index']);
    Route::get('/memo/{memo_id}', [MemoController::class, 'show']);
    
    Route::get('/project', [ProjectController::class, 'index'])->name('project');
    Route::post('/project', [ProjectController::class,'create']);
    Route::put('/project', [ProjectController::class,'store']);
    Route::get('/project/name', [ProjectController::class, 'indexName']);
    Route::get('/project/{project_id}', [ProjectController::class, 'show']);

    Route::get('tasks/{project_id}', [TaskController::class, 'index']);
    Route::post('/task', [TaskController::class, 'create']);
    Route::put('/task/progress', [TaskController::class, 'updateProgress']);
    Route::put('/task/startdate', [TaskController::class, 'updateStartDate']);
    Route::put('/task/enddate', [TaskController::class, 'updateEndDate']);
    Route::put('tasks/reorder', [TaskController::class, 'reorder']);
});
