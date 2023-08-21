<?php

namespace App\Http\Controllers;

use App\Models\Block;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    // fetch one block
    public function index()
    {
        $projects = Block::where('user_id', '=', '2');
        return $projects;
    }

    // create or update
    public function store(Request $request)
    {
        Block::updateOrCreate(
            ['user_id'   => auth()->id()],
            [
                'type' => 'table',
                'json' => $request->input('blocks')
            ]
        );
    }
}
