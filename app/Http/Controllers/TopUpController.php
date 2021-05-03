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
use App\TopUp;
use App\General;

class TopUpController extends Controller
{
    protected $general;

	public function __construct(){
        $this->general = general::first();
    }

    public function index(Request $request)
    {
        $topUps_pending = topUp::with('user')->orderBy('id', 'asc')
            ->where('status', 'pending')
            ->whereHas('user', function ($query) use ($request) {
                $query->where('username', 'LIKE', "%{$request->q}%");
            })->orWhere(function ($query) use ($request) {
                if ($request->q) {
                    $query->where('created_at', 'LIKE', "%{$request->q}%");
                }
            })->paginate(5);
        $topUps = topUp::with('user')->orderBy('id', 'asc')->where('status', '!=', 'pending')
            ->whereHas('user', function ($query) use ($request) {
                $query->where('username', 'LIKE', "%{$request->qc}%");
            })->orWhere(function ($query) use ($request) {
                if ($request->qc) {
                    $query->where('created_at', 'LIKE', "%{$request->qc}%");
                }
            })->paginate(5);
        $topUps_pending->appends($request->only('q'));
        $topUps->appends($request->only('qc'));
        if ($request->ajax()) {
            return view('admin.topUps.pending', ['topUps_pending' => $topUps_pending])->render();
            return view('admin.topUps.history', ['topUps' => $topUps])->render();
        }
        return view('multiauth::admin.topUp.index', compact('topUps', 'topUps_pending'));

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
     * @param  \App\topUp  $topUp
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\topUp  $topUp
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
     * @param  \App\topUp  $topUp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $topUp = topUp::find($id);
        $user = user::find($topUp->user_id);

        if($user){

            if($request->status == "approved"){
                $user->balance = $user->balance + $topUp->amount;
                $user->energy = $user->energy + $topUp->energy;
                $user->energy_quota = $user->energy_quota + $topUp->energy;
                $user->save();
            }

            $topUp->status = $request->status;
            $topUp->note = $request->note;
            $topUp->save();
            alert()->success('Successfully');

        }else{
            alert()->error('user not exist');
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\topUp  $topUp
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
