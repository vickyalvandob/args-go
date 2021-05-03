<?php

namespace App\Http\Controllers;

use App\Reward;
use App\RewardCollect;
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

class RewardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rewards = reward::orderBy('id', 'DESC')->get();
        return view('multiauth::admin.reward.index', compact('rewards'));
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
        $request->validate([
            'amount' => ['required','numeric'],
            'energy' => ['required','numeric'],
        ]);

        $reward = new reward;
        $reward->title = $request->title;
        $reward->amount = $request->amount;
        $reward->energy = $request->energy;
        if($request->file('image')){
            $image = $request->file('image');
            $imagetitle = time().'reward.'.$image->getClientOriginalExtension();
            $image->move('img/', $imagetitle);
            $reward->image = $imagetitle;
        }
        $reward->save();

        alert()->success('Created Successfully');
        return redirect(route('admin.reward.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\reward  $reward
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\reward  $reward
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\reward  $reward
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'amount' => ['required','numeric'],
            'energy' => ['required','numeric'],
        ]);

        $reward = reward::find($id);
        $reward->title = $request->title;
        $reward->amount = $request->amount;
        $reward->energy = $request->energy;
        if($request->file('image')){
            $image = $request->file('image');
            $imagetitle = time().'reward.'.$image->getClientOriginalExtension();
            $image->move('img/', $imagetitle);
            $reward->image = $imagetitle;
        }
        $reward->status = $request->status;
        $reward->save();

        alert()->success('Updated Successfully');
        return redirect(route('admin.reward.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\reward  $reward
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reward = reward::find($id);
        $reward->delete();

        alert()->success('Deleted Successfully');
        return redirect(route('admin.reward.index'));
    }
}
