<?php

namespace App\Http\Controllers;

use App\Models\Borrowedbooks;
use Exception;
use Illuminate\Http\Request;

class BorrowedbooksController extends Controller
{
    public function show(Borrowedbooks $borrowedbook) {
        return response()->json($borrowedbook,200);
    }

    public function search(Request $request) {
        $request->validate(['key'=>'string|required']);

        $borrowedbook = Borrowedbooks::where('Books','like',"%$request->key%")
            ->orWhere('Author','like',"%$request->key%")->get();

        return response()->json($borrowedbook
        , 200);
    }

    public function store(Request $request) {
        $request->validate([
            'Books' => 'string|required',
            'Genre' => 'string|required',
            'Author' => 'string|required',
        ]);

        try {
            $borrowedbook = Borrowedbooks::create($request->all());
            return response()->json($borrowedbook, 202);
        }catch(Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ],500);
        }

    }

    public function update(Request $request, Borrowedbooks $borrowedbook) {
        try {
            $borrowedbook->update($request->all());
            return response()->json($borrowedbook, 202);
        }catch(Exception $ex) {
            return response()->json(['message'=>$ex->getMessage()], 500);
        }
    }

    public function destroy(Borrowedbooks $borrowedbook) {
        $borrowedbook->delete();
        return response()->json(['message'=>'Book deleted.'],202);
    }

    public function index() {
        $borrowedbooks = Borrowedbooks::orderBy('Books')->get();
        return response()->json($borrowedbooks, 200);
    }
}
