<?php

namespace App\Http\Controllers;

use App\RewardSell;
use App\RewardBuy;
use Illuminate\Http\Request;

class RewardSellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rewardBuys = rewardBuy::orderby('id', 'desc')->paginate(5);
        $rewardSells = rewardSell::orderby('id', 'desc')->paginate(5);
        return view('multiauth::admin.rewardSell.index', compact('rewardBuys','rewardSells'));
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
     * @param  \App\RewardSell  $rewardSell
     * @return \Illuminate\Http\Response
     */
    public function show(RewardSell $rewardSell)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RewardSell  $rewardSell
     * @return \Illuminate\Http\Response
     */
    public function edit(RewardSell $rewardSell)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RewardSell  $rewardSell
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RewardSell $rewardSell)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RewardSell  $rewardSell
     * @return \Illuminate\Http\Response
     */
    public function destroy(RewardSell $rewardSell)
    {
        //
    }
}
