<?php

namespace App\Http\Controllers;

use App\Weapon;
use App\Antagonist;
use App\WeaponCollect;
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

class WeaponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $weapons = weapon::orderBy('id', 'DESC')->get();
        $antagonists = antagonist::orderBy('id', 'DESC')->get();
        return view('multiauth::admin.weapon.index', compact('weapons','antagonists'));
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
        ]);

        $weapon = new weapon;
        $weapon->title = $request->title;
        $weapon->amount = $request->amount;
        $weapon->antagonist_id = $request->antagonist_id;
        if($request->file('image')){
            $image = $request->file('image');
            $imagetitle = time().'weapon.'.$image->getClientOriginalExtension();
            $image->move('img/', $imagetitle);
            $weapon->image = $imagetitle;
        }
        $weapon->save();

        alert()->success('Created Successfully');
        return redirect(route('admin.weapon.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\weapon  $weapon
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\weapon  $weapon
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\weapon  $weapon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'amount' => ['required','numeric'],
        ]);

        $weapon = weapon::find($id);
        $weapon->title = $request->title;
        $weapon->amount = $request->amount;
        $weapon->antagonist_id = $request->antagonist_id;
        if($request->file('image')){
            $image = $request->file('image');
            $imagetitle = time().'weapon.'.$image->getClientOriginalExtension();
            $image->move('img/', $imagetitle);
            $weapon->image = $imagetitle;
        }
        $weapon->status = $request->status;
        $weapon->save();

        alert()->success('Updated Successfully');
        return redirect(route('admin.weapon.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\weapon  $weapon
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $weapon = weapon::find($id);
        $weapon->delete();

        alert()->success('Deleted Successfully');
        return redirect(route('admin.weapon.index'));
    }
}
