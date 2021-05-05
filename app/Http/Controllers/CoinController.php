<?php

namespace App\Http\Controllers;

use App\Coin;
use App\CoinCollect;
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

class CoinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $coins = coin::orderBy('id', 'ASC')->where(function ($query) use ($request) {
            if ($request->q) {
                $query->where('coinname', 'LIKE', "%{$request->q}%")->where('name', 'LIKE', "%{$request->q}%")->orWhere('email', 'LIKE', "%{$request->q}%")->orWhere('created_at', 'LIKE', "%{$request->q}%");
            }
        })->paginate(5);
        $coins->appends($request->only('q'));
        if ($request->ajax()) {
            return view('multiauth::admin.coin.table_coin', ['coins' => $coins])->render();
        }
        return view('multiauth::admin.coin.index', compact('coins'));
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

        $coin = new coin;
        $coin->amount = $request->amount;
        $coin->qty = $request->qty;
        $coin->energy = $request->energy;
        if($request->file('image')){
            $image = $request->file('image');
            $imagetitle = time().'image.'.$image->getClientOriginalExtension();
            $image->move('img/', $imagetitle);
            $coin->image = $imagetitle;
        }
        $coin->save();

        alert()->success('Created Successfully');
        return redirect(route('admin.coin.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\coin  $coin
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\coin  $coin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\coin  $coin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'amount' => ['required','numeric'],
            'energy' => ['required','numeric'],
        ]);

        $coin = coin::find($id);
        $coin->qty = $request->qty;
        $coin->amount = $request->amount;
        $coin->energy = $request->energy;
        if($request->file('image')){
            $image = $request->file('image');
            $imagetitle = time().'image.'.$image->getClientOriginalExtension();
            $image->move('img/', $imagetitle);
            $coin->image = $imagetitle;
        }
        $coin->status = $request->status;
        $coin->save();

        alert()->success('Updated Successfully');
        return redirect(route('admin.coin.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\coin  $coin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coin = coin::find($id);
        $coin->delete();

        alert()->success('Deleted Successfully');
        return redirect(route('admin.coin.index'));
    }
}
