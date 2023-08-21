<?php

namespace App\Http\Controllers;

use App\Models\Block;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    // 
    public function index()
    {
        $projects = Block::where('user_id', '=', '2');
        return $projects;
    }

    public function store(Request $request, Block $blocks)
    {
        dd($request->json());
        // Block::create($request->validate([
        //     'json'=>'required',
        // ]));
        $product = Block::firstOrCreate(

            [ 'name' => 'Platinum' ],

            [ 'slug' => 'platinum', 'detail' => 'test platinum' ]

        );
    }
}
