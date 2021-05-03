<?php

namespace App\Http\Controllers;

use App\RewardCollect;
use App\rewardCollectHistory;
use Illuminate\Http\Request;

class RewardCollectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


            $rewardCollects = rewardCollect::orderby('id', 'desc')->get();
            $rewardCollectHistorys = rewardCollectHistory::orderby('id', 'desc')->get();
            return view('multiauth::admin.rewardCollect.index', compact('rewardCollects','rewardCollectHistorys'));

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
     * @param  \App\RewardCollect  $rewardCollect
     * @return \Illuminate\Http\Response
     */
    public function show(RewardCollect $rewardCollect)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RewardCollect  $rewardCollect
     * @return \Illuminate\Http\Response
     */
    public function edit(RewardCollect $rewardCollect)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RewardCollect  $rewardCollect
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RewardCollect $rewardCollect)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RewardCollect  $rewardCollect
     * @return \Illuminate\Http\Response
     */
    public function destroy(RewardCollect $rewardCollect)
    {
        //
    }
}
