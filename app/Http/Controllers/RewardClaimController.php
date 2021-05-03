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
use App\RewardClaim;
use App\RewardCollect;
use App\General;

class RewardClaimController extends Controller
{
    protected $general;

	public function __construct(){
        $this->general = general::first();
    }

    public function index(Request $request)
    {
        $rewardClaims_pending = rewardClaim::with('user')->orderBy('id', 'asc')
            ->where('status', 'pending')
            ->whereHas('user', function ($query) use ($request) {
                $query->where('username', 'LIKE', "%{$request->q}%");
            })->orWhere(function ($query) use ($request) {
                if ($request->q) {
                    $query->where('created_at', 'LIKE', "%{$request->q}%");
                }
            })->paginate(5);
        $rewardClaims = rewardClaim::with('user')->orderBy('id', 'asc')->where('status', '!=', 'pending')
            ->whereHas('user', function ($query) use ($request) {
                $query->where('username', 'LIKE', "%{$request->qc}%");
            })->orWhere(function ($query) use ($request) {
                if ($request->qc) {
                    $query->where('created_at', 'LIKE', "%{$request->qc}%");
                }
            })->paginate(5);
        $rewardClaims_pending->appends($request->only('q'));
        $rewardClaims->appends($request->only('qc'));
        if ($request->ajax()) {
            return view('admin.rewardClaims.pending', ['rewardClaims_pending' => $rewardClaims_pending])->render();
            return view('admin.rewardClaims.history', ['rewardClaims' => $rewardClaims])->render();
        }
        return view('multiauth::admin.rewardClaim.index', compact('rewardClaims', 'rewardClaims_pending'));

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
     * @param  \App\rewardClaim  $rewardClaim
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\rewardClaim  $rewardClaim
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
     * @param  \App\rewardClaim  $rewardClaim
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rewardClaim = rewardClaim::find($id);
        $rewardCollect = rewardCollect::find($rewardClaim->reward_collect_id);

        if($rewardCollect){

            if($request->status == "declined"){
                $rewardCollect->qty = $rewardCollect->qty + $rewardClaim->qty;
                $rewardCollect->save();
            }
            if($request->file('proof_image')){
                $file = $request->file('proof_image');
                $proof_imagetitle = time().'proof_image.'.$file->getClientOriginalExtension();
                $file->move('img/', $proof_imagetitle);
                $rewardClaim->proof_image = $proof_imagetitle;
            }
            $rewardClaim->note = $request->note;
            $rewardClaim->status = $request->status;
            $rewardClaim->save();
            alert()->success('Successfully');

        }else{
            alert()->error('reward not exist');
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\rewardClaim  $rewardClaim
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
