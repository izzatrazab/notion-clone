<?php

namespace App\Http\Controllers;

use App\Models\Memo;
use Inertia\Inertia;
use Illuminate\Http\Request;

class MemoController extends Controller
{
    // show (fetch list of memo name)
    public function show()
    {
        $memos = Memo::select('name', 'id')->where('user_id', auth()->id())->get();
        return response()->json([
            'memos' => $memos
        ]);
    }

    public function index(String $memo_id){
        $memo = Memo::select('json_memo')->where('user_id', auth()->id())->where('id', $memo_id)->get();
        return Inertia::render('Dashboard',['memo' => $memo]);
    }
}
