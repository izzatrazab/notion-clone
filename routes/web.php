<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\MemoController;
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
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

    // fetch block
    Route::get('api/block', [BlockController::class,'show']);

    // store block
    Route::post('api/block', [BlockController::class,'store']);


    // memo
    Route::get('api/memo', [MemoController::class, 'indexName']);
    Route::put('api/memo', [MemoController::class,'store']);
    Route::post('api/memo', [MemoController::class,'create']);
    Route::delete('api/memo', [MemoController::class,'delete']);
    Route::get('/memo', [MemoController::class, 'index']);
    Route::get('/memo/{memo_id}', [MemoController::class, 'show']);
});
