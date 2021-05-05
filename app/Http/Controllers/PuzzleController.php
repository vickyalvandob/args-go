<?php

namespace App\Http\Controllers;

use App\Puzzle;
use App\PuzzleCollect;
use App\PuzzlePiece;
use App\PuzzlePieceCollect;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Session;
use Carbon\Carbon;
use Auth;
use Alert;
use App\User;
use App\General;

class PuzzleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $puzzles = puzzle::orderBy('id', 'ASC')->get();
        return view('multiauth::admin.puzzle.index', compact('puzzles'));
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
        // $request->validate([
        //     'amount' => ['required','numeric'],
        //     'energy' => ['required','numeric'],
        // ]);

        // $puzzle = new puzzle;
        // $puzzle->title = $request->title;
        // $puzzle->amount = $request->amount;
        // $puzzle->energy = $request->energy;
        // $puzzle->pieces = 16;
        // if($request->file('image')){
        //     $image = $request->file('image');
        //     $imagetitle = time().'puzzle.'.$image->getClientOriginalExtension();
        //     $image->move('img/', $imagetitle);
        //     $puzzle->image = $imagetitle;
        // }
        // $puzzle->save();

        // for ($x = 1; $x <= $puzzle->pieces; $x++) {
        //     $puzzlePiece = new puzzlePiece;
        //     $puzzlePiece->title = $puzzle->title." Piece #".$x;
        //     $puzzlePiece->puzzle_id = $puzzle->id;
        //     $puzzlePiece->amount = $puzzle->amount;
        //     $puzzlePiece->energy = $puzzle->energy;
        //     $puzzlePiece->save();
        // }

        // alert()->success('Created Successfully');
        // return redirect(route('admin.puzzle.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\puzzle  $puzzle
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $puzzle = puzzle::find($id);
        $puzzlePieces = puzzlePiece::orderBy('id', 'DESC')->where('puzzle_id', $puzzle->id)->get();
        $puzzlePieceCollects = puzzlePieceCollect::orderBy('id', 'DESC')->where('puzzle_id', $puzzle->id)->get();
        return view('multiauth::admin.puzzle.show', compact('puzzle', 'puzzlePieces','puzzlePieceCollects'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\puzzle  $puzzle
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\puzzle  $puzzle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'amount' => ['required','numeric'],
        ]);

        $puzzle = puzzle::find($id);
        $puzzle->title = $request->title;
        $puzzle->amount = $request->amount;
        $puzzle->amount_combine = $request->amount_combine;
        if($request->file('image')){
            $image = $request->file('image');
            $imagetitle = time().'puzzle.'.$image->getClientOriginalExtension();
            $image->move('img/', $imagetitle);
            $puzzle->image = $imagetitle;
        }
        $puzzle->status = $request->status;
        $puzzle->save();

        alert()->success('Updated Successfully');
        return redirect(route('admin.puzzle.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\puzzle  $puzzle
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $puzzle = puzzle::find($id);
        $puzzle->delete();

        alert()->success('Deleted Successfully');
        return redirect(route('admin.puzzle.index'));
    }
}
