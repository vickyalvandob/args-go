<?php

namespace App\Http\Controllers;

use App\Antagonist;
use App\AntagonistAttack;
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

class AntagonistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $antagonists = antagonist::orderBy('id', 'DESC')->get();
        return view('multiauth::admin.antagonist.index', compact('antagonists'));
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

        $antagonist = new antagonist;
        $antagonist->title = $request->title;
        $antagonist->amount = $request->amount;
        $antagonist->energy = $request->energy;
        if($request->file('image')){
            $image = $request->file('image');
            $imagetitle = time().'antagonist.'.$image->getClientOriginalExtension();
            $image->move('img/', $imagetitle);
            $antagonist->image = $imagetitle;
        }
        $antagonist->save();

        alert()->success('Created Successfully');
        return redirect(route('admin.antagonist.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\antagonist  $antagonist
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\antagonist  $antagonist
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\antagonist  $antagonist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'amount' => ['required','numeric'],
            'energy' => ['required','numeric'],
        ]);

        $antagonist = antagonist::find($id);
        $antagonist->title = $request->title;
        $antagonist->amount = $request->amount;
        $antagonist->energy = $request->energy;
        if($request->file('image')){
            $image = $request->file('image');
            $imagetitle = time().'antagonist.'.$image->getClientOriginalExtension();
            $image->move('img/', $imagetitle);
            $antagonist->image = $imagetitle;
        }
        $antagonist->status = $request->status;
        $antagonist->save();

        alert()->success('Updated Successfully');
        return redirect(route('admin.antagonist.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\antagonist  $antagonist
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $antagonist = antagonist::find($id);
        $antagonist->delete();

        alert()->success('Deleted Successfully');
        return redirect(route('admin.antagonist.index'));
    }
}
