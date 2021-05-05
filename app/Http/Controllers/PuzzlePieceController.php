<?php

namespace App\Http\Controllers;

use App\PuzzlePiece;
use Illuminate\Http\Request;

class PuzzlePieceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PuzzlePiece  $puzzlePiece
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PuzzlePiece  $puzzlePiece
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PuzzlePiece  $puzzlePiece
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'energy' => ['required','numeric'],
        ]);

        $puzzlePiece = puzzlePiece::find($id);
        $puzzlePiece->title = $request->title;
        $puzzlePiece->qty = $request->qty;
        $puzzlePiece->energy = $request->energy;
        if($request->file('image')){
            $image = $request->file('image');
            $imagetitle = time().'puzzlePiece.'.$image->getClientOriginalExtension();
            $image->move('img/', $imagetitle);
            $puzzlePiece->image = $imagetitle;
        }
        $puzzlePiece->status = $request->status;
        $puzzlePiece->save();

        alert()->success('Updated Successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PuzzlePiece  $puzzlePiece
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
