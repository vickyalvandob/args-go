<?php

namespace App\Http\Controllers;

use App\Transfer;
use App\User;
use Auth;
use App\General;
use Illuminate\Http\Request;

class TransferController extends Controller
{

    protected $general;

    public function __construct()
    {
        $this->general = general::first();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $transfers_user = transfer::whereNull('admin_id')->get();
        $transfers_admin = transfer::whereNotNull('admin_id')->get();

        return view('multiauth::admin.transfer.index', compact('transfers_user', 'transfers_admin'));
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

        $this->validate($request, [
            'amount' => 'required|numeric'
        ]);



        $user = User::where('username', $request->username)->first();
        if ($user) {

            if ($request->transfer_tax) {
                $tax = $request->amount * ($this->general->transfer_tax / 100);
            }else{
                $tax = 0;
            }
            $energy = $request->amount * $this->general->energy_exchange;

            if ($request->type == 'ARGS') {
                $user->balance = $user->balance + $request->amount;
                $user->energy = $user->energy + $energy;
                $user->energy_quota = $user->energy_quota + $energy;
            } elseif ($request->type == 'GAST') {
                $user->coin_gast = $user->coin_gast + $request->amount;
            } elseif ($request->type == 'TTG') {
                $user->coin_ttg = $user->coin_ttg + $request->amount;
            }

            $user->save();

            $transfer = new transfer;
            $transfer->admin_id = Auth::guard('admin')->user()->id;
            $transfer->recipient_id = $user->id;
            $transfer->type = $request->type;
            $transfer->amount = $request->amount - $tax;
            $transfer->tax = $tax;
            $transfer->energy = $energy;
            $transfer->note = $request->note;
            $transfer->save();

            alert()->success('Transfer Successfully!');
        } else {
            alert()->info('Username not exist!');
        }

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transfer  $transfer
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
     * @param  \App\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
