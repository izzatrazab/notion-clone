<?php

namespace App\Http\Controllers;

use App\Models\Block;
use Illuminate\Http\Request;
use Inertia\Inertia;


class BlockController extends Controller
{
    // fetch one block
    public function index()
    {
        $projects = Block::where('user_id', '=', '2');
        return $projects;
    }

    // show
    public function show(Request $request)
    {
        $blocks = Block::select('json')->where('user_id', auth()->id())->get();
        return Inertia::render('Dashboard',[
            'blocks' => $blocks
        ]);
        // return $blocks;
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
