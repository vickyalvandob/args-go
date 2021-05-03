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
use App\Payout;
use App\General;

class PayoutController extends Controller
{
    protected $general;

	public function __construct(){
        $this->general = general::first();
    }

    public function index(Request $request)
    {
        $payouts_pending = payout::with('user')->orderBy('id', 'asc')
            ->where('status', 'pending')
            ->whereHas('user', function ($query) use ($request) {
                $query->where('username', 'LIKE', "%{$request->q}%");
            })->orWhere(function ($query) use ($request) {
                if ($request->q) {
                    $query->where('created_at', 'LIKE', "%{$request->q}%");
                }
            })->paginate(5);
        $payouts = payout::with('user')->orderBy('id', 'asc')->where('status', '!=', 'pending')
            ->whereHas('user', function ($query) use ($request) {
                $query->where('username', 'LIKE', "%{$request->qc}%");
            })->orWhere(function ($query) use ($request) {
                if ($request->qc) {
                    $query->where('created_at', 'LIKE', "%{$request->qc}%");
                }
            })->paginate(5);
        $payouts_pending->appends($request->only('q'));
        $payouts->appends($request->only('qc'));
        if ($request->ajax()) {
            return view('admin.payouts.pending', ['payouts_pending' => $payouts_pending])->render();
            return view('admin.payouts.history', ['payouts' => $payouts])->render();
        }
        return view('multiauth::admin.payout.index', compact('payouts', 'payouts_pending'));

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
     * @param  \App\payout  $payout
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\payout  $payout
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
     * @param  \App\payout  $payout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $payout = payout::find($id);
        $user = user::find($payout->user_id);

        if($user){

            if($request->status == "declined"){
                $user->balance = $user->balance + ($payout->amount + $payout->tax);
                $user->energy = $user->energy + $payout->energy;
                $user->save();
            }
            if($request->file('proof_image')){
                $file = $request->file('proof_image');
                $proof_imagetitle = time().'proof_image.'.$file->getClientOriginalExtension();
                $file->move('img/', $proof_imagetitle);
                $payout->proof_image = $proof_imagetitle;
            }
            $payout->status = $request->status;
            $payout->note = $request->note;
            $payout->save();
            alert()->success('Successfully');

        }else{
            alert()->error('user not exist');
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\payout  $payout
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
