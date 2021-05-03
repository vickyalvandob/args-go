<?php

namespace App\Http\Controllers;

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
use App\CoinClaim;
use App\CoinCollect;
use App\General;

class CoinClaimController extends Controller
{
    protected $general;

	public function __construct(){
        $this->general = general::first();
    }

    public function index(Request $request)
    {
        $coinClaims_pending = coinClaim::with('user')->orderBy('id', 'asc')
            ->where('status', 'pending')
            ->whereHas('user', function ($query) use ($request) {
                $query->where('username', 'LIKE', "%{$request->q}%");
            })->orWhere(function ($query) use ($request) {
                if ($request->q) {
                    $query->where('created_at', 'LIKE', "%{$request->q}%");
                }
            })->paginate(5);
        $coinClaims = coinClaim::with('user')->orderBy('id', 'asc')->where('status', '!=', 'pending')
            ->whereHas('user', function ($query) use ($request) {
                $query->where('username', 'LIKE', "%{$request->qc}%");
            })->orWhere(function ($query) use ($request) {
                if ($request->qc) {
                    $query->where('created_at', 'LIKE', "%{$request->qc}%");
                }
            })->paginate(5);
        $coinClaims_pending->appends($request->only('q'));
        $coinClaims->appends($request->only('qc'));
        if ($request->ajax()) {
            return view('admin.coinClaims.pending', ['coinClaims_pending' => $coinClaims_pending])->render();
            return view('admin.coinClaims.history', ['coinClaims' => $coinClaims])->render();
        }
        return view('multiauth::admin.coinClaim.index', compact('coinClaims', 'coinClaims_pending'));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\coinClaim  $coinClaim
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\coinClaim  $coinClaim
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
     * @param  \App\coinClaim  $coinClaim
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $coinClaim = coinClaim::find($id);
        $user = user::find($coinClaim->user_id);

        if($coinClaim){

            if($request->status == "declined"){
                $user->coin_gast = $user->coin_gast + $coinClaim->amount;
                $user->save();
            }
            if($request->file('proof_image')){
                $file = $request->file('proof_image');
                $proof_imagetitle = time().'proof_image.'.$file->getClientOriginalExtension();
                $file->move('img/', $proof_imagetitle);
                $coinClaim->proof_image = $proof_imagetitle;
            }
            $coinClaim->note = $request->note;
            $coinClaim->status = $request->status;
            $coinClaim->save();
            alert()->success('Successfully');

        }else{
            alert()->error('user not exist');
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\coinClaim  $coinClaim
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
