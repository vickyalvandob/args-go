<?php

namespace App\Http\Controllers;

use App\CoinCollect;
use Illuminate\Http\Request;

class CoinCollectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coinCollects = coinCollect::orderby('id', 'desc')->get();
        return view('multiauth::admin.coinCollect.index', compact('coinCollects'));
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
     * @param  \App\CoinCollect  $coinCollect
     * @return \Illuminate\Http\Response
     */
    public function show(CoinCollect $coinCollect)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CoinCollect  $coinCollect
     * @return \Illuminate\Http\Response
     */
    public function edit(CoinCollect $coinCollect)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CoinCollect  $coinCollect
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CoinCollect $coinCollect)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CoinCollect  $coinCollect
     * @return \Illuminate\Http\Response
     */
    public function destroy(CoinCollect $coinCollect)
    {
        //
    }
}
