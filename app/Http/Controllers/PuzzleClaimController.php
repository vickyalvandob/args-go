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
use App\PuzzleClaim;
use App\PuzzleCollect;
use App\General;

class PuzzleClaimController extends Controller
{
    protected $general;

	public function __construct(){
        $this->general = general::first();
    }

    public function index(Request $request)
    {
        $puzzleClaims_pending = puzzleClaim::with('user')->orderBy('id', 'asc')
            ->where('status', 'pending')
            ->whereHas('user', function ($query) use ($request) {
                $query->where('username', 'LIKE', "%{$request->q}%");
            })->orWhere(function ($query) use ($request) {
                if ($request->q) {
                    $query->where('created_at', 'LIKE', "%{$request->q}%");
                }
            })->paginate(5);
        $puzzleClaims = puzzleClaim::with('user')->orderBy('id', 'asc')->where('status', '!=', 'pending')
            ->whereHas('user', function ($query) use ($request) {
                $query->where('username', 'LIKE', "%{$request->qc}%");
            })->orWhere(function ($query) use ($request) {
                if ($request->qc) {
                    $query->where('created_at', 'LIKE', "%{$request->qc}%");
                }
            })->paginate(5);
        $puzzleClaims_pending->appends($request->only('q'));
        $puzzleClaims->appends($request->only('qc'));
        if ($request->ajax()) {
            return view('admin.puzzleClaims.pending', ['puzzleClaims_pending' => $puzzleClaims_pending])->render();
            return view('admin.puzzleClaims.history', ['puzzleClaims' => $puzzleClaims])->render();
        }
        return view('multiauth::admin.puzzleClaim.index', compact('puzzleClaims', 'puzzleClaims_pending'));

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
     * @param  \App\puzzleClaim  $puzzleClaim
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\puzzleClaim  $puzzleClaim
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
     * @param  \App\puzzleClaim  $puzzleClaim
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $puzzleClaim = puzzleClaim::find($id);
        $puzzleCollect = puzzleCollect::find($puzzleClaim->puzzle_collect_id);

        if($puzzleCollect){

            if($request->status == "declined"){
                $puzzleCollect->qty = $puzzleCollect->qty + $puzzleClaim->qty;
                $puzzleCollect->save();
            }
            if($request->file('proof_image')){
                $file = $request->file('proof_image');
                $proof_imagetitle = time().'proof_image.'.$file->getClientOriginalExtension();
                $file->move('img/', $proof_imagetitle);
                $puzzleClaim->proof_image = $proof_imagetitle;
            }
            $puzzleClaim->note = $request->note;
            $puzzleClaim->status = $request->status;
            $puzzleClaim->save();
            alert()->success('Successfully');

        }else{
            alert()->error('puzzle not exist');
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\puzzleClaim  $puzzleClaim
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
