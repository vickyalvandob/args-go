<?php

namespace App\Http\Controllers;

use App\General;
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

class GeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $general = general::first();
        return view('multiauth::admin.general.index',compact('general'));
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
        $general = general::first();
        $general->title = $request->title;
        $general->description = $request->description;
        $general->payout_tax = $request->payout_tax;
        $general->transfer_tax = $request->transfer_tax;
        $general->transfer_ttg = $request->transfer_ttg;
        $general->topUp_tax = $request->topUp_tax;
        $general->energy_exchange = $request->energy_exchange;
        $general->boost_percentage = $request->boost_percentage;
        $general->collection_hour = $request->collection_hour;
        if($request->file('logo_light')){
            $logo_light = $request->file('logo_light');
            $logo_lighttitle = time().'logo_light.'.$logo_light->getClientOriginalExtension();
            $logo_light->move('img/', $logo_lighttitle);
            $general->logo_light = $logo_lighttitle;
        }
        if($request->file('logo_sm')){
            $logo_sm = $request->file('logo_sm');
            $logo_smtitle = time().'logo_sm.'.$logo_sm->getClientOriginalExtension();
            $logo_sm->move('img/', $logo_smtitle);
            $general->logo_sm = $logo_smtitle;
        }
        if($request->file('logo_dark')){
            $logo_dark = $request->file('logo_dark');
            $logo_darktitle = time().'logo_dark.'.$logo_dark->getClientOriginalExtension();
            $logo_dark->move('img/', $logo_darktitle);
            $general->logo_dark = $logo_darktitle;
        }
        if($request->file('coin_gast')){
            $coin_gast = $request->file('coin_gast');
            $coin_gasttitle = time().'coin_gast.'.$coin_gast->getClientOriginalExtension();
            $coin_gast->move('img/', $coin_gasttitle);
            $general->coin_gast = $coin_gasttitle;
        }
        if($request->file('coin_ttg')){
            $coin_ttg = $request->file('coin_ttg');
            $coin_ttgtitle = time().'coin_ttg.'.$coin_ttg->getClientOriginalExtension();
            $coin_ttg->move('img/', $coin_ttgtitle);
            $general->coin_ttg = $coin_ttgtitle;
        }
        if($request->file('coin_args')){
            $coin_args = $request->file('coin_args');
            $coin_argstitle = time().'coin_args.'.$coin_args->getClientOriginalExtension();
            $coin_args->move('img/', $coin_argstitle);
            $general->coin_args = $coin_argstitle;
        }
        $general->save();
        alert()->success('Successfully!');
        return redirect(route('admin.general.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\General  $general
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\General  $general
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
     * @param  \App\General  $general
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\General  $general
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
