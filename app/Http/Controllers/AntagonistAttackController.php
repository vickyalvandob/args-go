<?php

namespace App\Http\Controllers;

use App\AntagonistAttack;
use Illuminate\Http\Request;

class AntagonistAttackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $antagonistAttacks = antagonistAttack::orderBy('id', 'DESC')->paginate(5);
        return view('multiauth::admin.antagonistAttack.index', compact('antagonistAttacks'));
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
     * @param  \App\AntagonistAttack  $antagonistAttack
     * @return \Illuminate\Http\Response
     */
    public function show(AntagonistAttack $antagonistAttack)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AntagonistAttack  $antagonistAttack
     * @return \Illuminate\Http\Response
     */
    public function edit(AntagonistAttack $antagonistAttack)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AntagonistAttack  $antagonistAttack
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AntagonistAttack $antagonistAttack)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AntagonistAttack  $antagonistAttack
     * @return \Illuminate\Http\Response
     */
    public function destroy(AntagonistAttack $antagonistAttack)
    {
        //
    }
}
