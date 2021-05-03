<?php

namespace App\Http\Controllers;

use App\PuzzlePieceSell;
use App\PuzzlePieceBuy;
use Illuminate\Http\Request;

class PuzzlePieceSellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $puzzlePieceBuys = puzzlePieceBuy::orderby('id', 'desc')->paginate(5);
        $puzzlePieceSells = puzzlePieceSell::orderby('id', 'desc')->paginate(5);
        $pieces = puzzlePieceSell::orderby('id', 'desc')->where('qty', '>', 0)->paginate(5);
        return view('multiauth::admin.puzzlePieceSell.index', compact('puzzlePieceBuys','pieces','puzzlePieceSells'));
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
     * @param  \App\PuzzlePieceSell  $puzzlePieceSell
     * @return \Illuminate\Http\Response
     */
    public function show(PuzzlePieceSell $puzzlePieceSell)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PuzzlePieceSell  $puzzlePieceSell
     * @return \Illuminate\Http\Response
     */
    public function edit(PuzzlePieceSell $puzzlePieceSell)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PuzzlePieceSell  $puzzlePieceSell
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PuzzlePieceSell $puzzlePieceSell)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PuzzlePieceSell  $puzzlePieceSell
     * @return \Illuminate\Http\Response
     */
    public function destroy(PuzzlePieceSell $puzzlePieceSell)
    {
        //
    }
}
