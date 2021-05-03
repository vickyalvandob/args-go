<?php

namespace App\Http\Controllers;

use App\WeaponAttack;
use Illuminate\Http\Request;

class WeaponAttackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $weaponAttacks = weaponAttack::orderBy('id', 'DESC')->paginate(5);
        return view('multiauth::admin.weaponAttack.index', compact('weaponAttacks'));
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
     * @param  \App\WeaponAttack  $weaponAttack
     * @return \Illuminate\Http\Response
     */
    public function show(WeaponAttack $weaponAttack)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WeaponAttack  $weaponAttack
     * @return \Illuminate\Http\Response
     */
    public function edit(WeaponAttack $weaponAttack)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WeaponAttack  $weaponAttack
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WeaponAttack $weaponAttack)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WeaponAttack  $weaponAttack
     * @return \Illuminate\Http\Response
     */
    public function destroy(WeaponAttack $weaponAttack)
    {
        //
    }
}
