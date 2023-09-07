<?php

namespace App\Http\Controllers;

use App\Models\Memo;
use Inertia\Inertia;
use Illuminate\Http\Request;

class MemoController extends Controller
{
    // show (fetch list of memo name)
    public function index()
    {
        $memos = Memo::select('name', 'id', 'updated_at')->where('user_id', auth()->id())->orderBy('updated_at','DESC')->get();
        return Inertia::render('Memo',['memos' => $memos]);
    }
    
    public function indexName()
    {
        $memos = Memo::select('name', 'id')->where('user_id', auth()->id())->get();
        return response()->json([
            'memos' => $memos
        ]);
    }

    public function show(String $memo_id)
    {
        $memo = Memo::select('name', 'id', 'json_memo')->where('user_id', auth()->id())->where('id', $memo_id)->get();
        return Inertia::render('Memo', ['memo' => $memo]);
    }
    
    // create a memo
    public function create()
    {
        try {
            $new_memo = Memo::create(
                [
                    'user_id'   => auth()->id(),
                    'name' => 'new memo',
                    'json_memo' => '[]'
                ]
            );
            return response()->json([
                'memo_id' => $new_memo->id
            ]);
            
        } catch (\Throwable $th) {
            return response()->json(['status' => false]);
            dd("MemoController, create function", $th);
        }
    }

    public function store(Request $request)
    {
        Memo::updateOrCreate(
            ['user_id'   => auth()->id(), 'id' => $request->get('memo_id')],
            [
                'type' => 'table',
                'json_memo' => $request->input('blocks')
            ]
        );
    }


    public function delete(Request $request){
        try {
            Memo::destroy($request->get('memo_id'));
            return response()->json([
                'status' => true,
                'memo_id' => $request->get('memo_id')
            ]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false]);
            dd("MemoController, delete function", $th);
        }
    }
}
