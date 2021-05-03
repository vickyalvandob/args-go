<?php

namespace App\Http\Controllers;

use App\Puzzle;
use App\PuzzleCollect;
use App\PuzzleCollectHistory;
use App\PuzzlePieceCollectHistory;
use Illuminate\Http\Request;

class PuzzleCollectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $puzzles = puzzle::all();
        $puzzleCollects = puzzleCollect::orderby('id', 'desc')->get();
        $puzzleCollectHistorys = puzzleCollectHistory::orderby('id', 'desc')->get();
        $puzzlePieceCollectHistorys = puzzlePieceCollectHistory::orderby('id', 'desc')->get();
        return view('multiauth::admin.puzzleCollect.index', compact('puzzles','puzzleCollects','puzzleCollectHistorys','puzzlePieceCollectHistorys'));
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
     * @param  \App\PuzzleCollect  $puzzleCollect
     * @return \Illuminate\Http\Response
     */
    public function show(PuzzleCollect $puzzleCollect)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PuzzleCollect  $puzzleCollect
     * @return \Illuminate\Http\Response
     */
    public function edit(PuzzleCollect $puzzleCollect)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PuzzleCollect  $puzzleCollect
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PuzzleCollect $puzzleCollect)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PuzzleCollect  $puzzleCollect
     * @return \Illuminate\Http\Response
     */
    public function destroy(PuzzleCollect $puzzleCollect)
    {
        //
    }
}
