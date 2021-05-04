<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\PasswordRequest;
use Session;
use Carbon\Carbon;
use Auth;
use Alert;
use App\User;
use App\TopUp;
use App\Payout;
use App\Reward;
use App\RewardBuy;
use App\RewardSell;
use App\RewardClaim;
use App\RewardCollect;
use App\RewardCollectHistory;
use App\Coin;
use App\CoinCollect;
use App\CoinClaim;
use App\Puzzle;
use App\PuzzleClaim;
use App\PuzzleCollect;
use App\PuzzleCollectHistory;
use App\PuzzlePiece;
use App\PuzzlePieceSell;
use App\PuzzlePieceBuy;
use App\PuzzlePieceCollect;
use App\PuzzlePieceCollectHistory;
use App\Transfer;
use App\EnergyBoost;
use App\WeaponBuy;
use App\WeaponCollect;
use App\Weapon;
use App\WeaponAttack;
use App\Antagonist;
use App\AntagonistAttack;
use App\General;

class HomeController extends Controller
{
    protected $general;

    public function __construct()
    {
        $this->general = general::first();
    }

    public function getUser(Request $request)
    {
        $id = User::where('username', $request->username)->first();
        if ($id == '') {
            return "<span class='w3-text-red'>Username not exist</span>";
        } else {
            return "<span class='text-success'><i class='mdi mdi-check-circle'> </i> <strong> $id->name</strong></span>";
        }
    }

    public function getRecipient(Request $request)
    {
        $id = User::where('id','!=',Auth::user()->id)->where('username', $request->username)->first();
        if ($id == '') {
            return "<span class='w3-text-red'>Username not exist</span>";
        } else {
            return "<span class='text-success'><i class='mdi mdi-check-circle'> </i> <strong> $id->name</strong></span>";
        }
    }


    public function home()
    {
        return view('welcome');
    }

    public function dashboard()
    {
        return Carbon::now()->subHours(1)->toDateTimeString();

        $coinCollectCount = coinCollect::where('user_id',Auth::user()->id)->where('created_at', '>',Carbon::now()->subHours(1)->toDateTimeString())->count();
        if($this->general->coin_hours >= $coinCollectCount){
            $coin = coin::where('status','show')->inRandomOrder()->first();
        }else{
            $coin = null;
        }


        $puzzlePieceCollectCount = puzzlePieceCollect::where('created_at', '>',Carbon::now()->subHours(1)->toDateTimeString())->count();
        if($this->general->puzzlePiece_hours >= $puzzlePieceCollectCount){
            $puzzlePiece = puzzlePiece::where('status','show')->inRandomOrder()->first();
        }else{
            $puzzlePiece = null;
        }

        $puzzlePiece = puzzlePiece::where('status','show')->inRandomOrder()->first();
        $reward = reward::where('status','show')->inRandomOrder()->first();
        $antagonist = antagonist::where('status','show')->inRandomOrder()->first();
        $weaponCollects = weaponCollect::where('user_id',Auth::user()->id)->where('qty','>',0)->get();
        $rewardCollect = rewardCollect::where('user_id',Auth::user()->id)->sum('qty');
        $puzzleCollect = puzzleCollect::where('user_id',Auth::user()->id)->sum('qty');
        $puzzlePieceCollect = puzzlePieceCollect::where('user_id',Auth::user()->id)->sum('qty');

        return view('user.dashboard', compact('rewardCollect','puzzleCollect','puzzlePieceCollect','coin','puzzlePiece','reward','antagonist','weaponCollects'));
    }

    public function profile_index()
    {
        return view('user.profile');
    }


    public function profile_update(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->city = $request->city;
        $user->zipcode = $request->zipcode;
        $user->phone = $request->phone;
        $user->birth = $request->birth;
        if($request->file('image')){
            $file = $request->file('image');
            $imagetitle = time().'image.'.$file->getClientOriginalExtension();
            $file->move('img/', $imagetitle);
            $user->image = $imagetitle;
        }
        $user->save();
        alert()->success('Successfully!');
        return redirect()->back();
    }

    public function password_index()
    {
        return view('user.password');
    }

    public function password_update(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        alert()->success('Successfully');
        return redirect()->back();
    }

    public function login($id)
    {
        Auth::loginUsingId($id);
        return redirect(route('user.dashboard'));
    }


    public function topUp_index()
    {
        $topUps = topUp::orderby('id', 'desc')->where('user_id',Auth::user()->id)->get();
        return view('user.topUp.index', compact('topUps'));
    }

    public function topUp_store(Request $request)
    {

        $request->validate([
            'amount' => ['required','numeric'],
            'proof_image' => 'required',
        ]);

        $tax = $request->amount * ($this->general->topUp_tax / 100);

        $topUp = new topUp;
        $topUp->user_id = Auth::user()->id;
        $topUp->energy = $request->amount * $this->general->energy_exchange;
        $topUp->amount = $request->amount - $tax;
        $topUp->tax = $tax;
        $topUp->note = $request->note;
        if($request->file('proof_image')){
            $file = $request->file('proof_image');
            $proof_imagetitle = time().'proof_image.'.$file->getClientOriginalExtension();
            $file->move('img/', $proof_imagetitle);
            $topUp->proof_image = $proof_imagetitle;
        }
        $topUp->save();

        alert()->success('Wait for top up processing day', 'Successfully');

        return redirect()->back();
    }

    public function payout_index()
    {
        $payouts = payout::orderby('id', 'desc')->where('user_id',Auth::user()->id)->get();
        return view('user.payout.index', compact('payouts'));
    }


    public function payout_store(Request $request)
    {
        $request->validate([
            'amount' => ['required','numeric'],
        ]);

        if (Auth::user()->balance >= $request->amount) {
            $energy = $request->amount * $this->general->energy_exchange;
            if (Auth::user()->energy >= $energy) {

                $tax = $request->amount * ($this->general->payout_tax / 100);

                Auth::user()->balance = Auth::user()->balance - $request->amount;
                Auth::user()->energy = Auth::user()->energy - $energy;
                Auth::user()->save();

                $payout = new payout;
                $payout->user_id = Auth::user()->id;
                $payout->amount = $request->amount - $tax;
                $payout->tax = $tax;
                $payout->energy = $energy;
                $payout->note = $request->note;
                $payout->save();

                alert()->success('Successfully');
            }else{
                alert()->info('Energy not enough!');
            }
        }else{
            alert()->info('Balance not enough!');
        }


        return redirect()->back();
    }


    public function transfer_index()
    {
        $transfers = transfer::orderby('id', 'desc')->where('user_id',Auth::user()->id)->paginate(5);
        return view('user.transfer.index', compact('transfers'));
    }

    public function transfer_store(Request $request)
    {
        $request->validate([
            'type' => ['required'],
            'amount' => ['required','numeric'],
        ]);
        $recipient = User::where('username', $request->username)->first();
        if ($recipient) {

           if($request->type == 'ARGS'){
                if (Auth::user()->balance >= $request->amount) {

                    $energy = $request->amount * $this->general->energy_exchange;
                    if (Auth::user()->energy >= $energy) {

                        if(Auth::user()->coin_ttg >= $this->general->transfer_ttg){

                            $tax = $request->amount * ($this->general->transfer_tax / 100);
                            // ttg
                            Auth::user()->balance = Auth::user()->balance - $request->amount;
                            Auth::user()->energy = Auth::user()->energy - $energy;
                            Auth::user()->coin_ttg = Auth::user()->coin_ttg - $this->general->transfer_ttg;
                            Auth::user()->save();

                            $recipient->balance = $recipient->balance + $request->amount;
                            $recipient->energy = $recipient->energy + $energy;
                            $recipient->energy_quota = $recipient->energy_quota + $energy;
                            $recipient->save();

                            $transfer = new transfer;
                            $transfer->user_id = Auth::user()->id;
                            $transfer->recipient_id = $recipient->id;
                            $transfer->type = $request->type;
                            $transfer->amount = $request->amount - $tax;
                            $transfer->tax = $tax;
                            $transfer->ttg = $this->general->transfer_ttg;
                            $transfer->energy = $energy;
                            $transfer->note = $request->note;
                            $transfer->save();

                            alert()->success('Successfully');

                        }else{
                            alert()->info('TTG balance not enough!');
                        }

                    }else{
                        alert()->info('Energy not enough!');
                    }
                }else{
                    alert()->info('ARGS Balance not enough!');
                }
           }elseif($request->type == 'GAST'){
                if (Auth::user()->coin_gast >= $request->amount) {

                    $energy = $request->amount * $this->general->energy_exchange;
                    if (Auth::user()->energy >= $energy) {

                        if(Auth::user()->coin_ttg >= $this->general->transfer_ttg){

                            $tax = $request->amount * ($this->general->transfer_tax / 100);
                            // ttg
                            Auth::user()->coin_gast = Auth::user()->coin_gast - $request->amount;
                            Auth::user()->energy = Auth::user()->energy - $energy;
                            Auth::user()->coin_ttg = Auth::user()->coin_ttg - $this->general->transfer_ttg;
                            Auth::user()->save();

                            $recipient->coin_gast = $recipient->coin_gast + $request->amount;
                            $recipient->energy = $recipient->energy + $energy;
                            $recipient->save();

                            $transfer = new transfer;
                            $transfer->user_id = Auth::user()->id;
                            $transfer->recipient_id = $recipient->id;
                            $transfer->type = $request->type;
                            $transfer->amount = $request->amount - $tax;
                            $transfer->tax = $tax;
                            $transfer->ttg = $this->general->transfer_ttg;
                            $transfer->energy = $energy;
                            $transfer->note = $request->note;
                            $transfer->save();

                            alert()->success('Successfully');

                        }else{
                            alert()->info('TTG balance not enough!');
                        }

                    }else{
                        alert()->info('Energy not enough!');
                    }
                }else{
                    alert()->info('GAST Balance not enough!');
                }
            }elseif($request->type == 'TTG'){
                if (Auth::user()->coin_ttg >= $request->amount) {

                    $energy = $request->amount * $this->general->energy_exchange;
                    if (Auth::user()->energy >= $energy) {

                        if(Auth::user()->coin_ttg >= $this->general->transfer_ttg){

                            $tax = $request->amount * ($this->general->transfer_tax / 100);
                            // ttg
                            Auth::user()->energy = Auth::user()->energy - $energy;
                            Auth::user()->coin_ttg = Auth::user()->coin_ttg - ($this->general->transfer_ttg + $request->amount);
                            Auth::user()->save();

                            $recipient->coin_ttg = $recipient->coin_ttg + $request->amount;
                            $recipient->energy = $recipient->energy + $energy;
                            $recipient->save();

                            $transfer = new transfer;
                            $transfer->user_id = Auth::user()->id;
                            $transfer->recipient_id = $recipient->id;
                            $transfer->type = $request->type;
                            $transfer->amount = $request->amount - $tax;
                            $transfer->tax = $tax;
                            $transfer->ttg = $this->general->transfer_ttg;
                            $transfer->energy = $energy;
                            $transfer->note = $request->note;
                            $transfer->save();

                            alert()->success('Successfully');

                        }else{
                            alert()->info('TTG balance not enough!');
                        }

                    }else{
                        alert()->info('TTG Energy not enough!');
                    }
                }else{
                    alert()->info('Balance not enough!');
                }
           }
        }else{
            alert()->info('Username not exist!');
        }


        return redirect()->back();
    }


    public function collection_index()
    {
        $coin = coin::where('status','show')->inRandomOrder()->first();
        $puzzle = puzzle::where('status','show')->inRandomOrder()->first();
        $puzzlePiece = puzzlePiece::where('status','show')->inRandomOrder()->first();
        $reward = reward::where('status','show')->inRandomOrder()->first();

        return view('user.collection.index', compact('coin','puzzle','puzzlePiece','reward'));
    }



    public function coinCollect_index()
    {
        $coinCollects = coinCollect::orderby('id', 'desc')->where('user_id',Auth::user()->id)->get();
        return view('user.coinCollect.index', compact('coinCollects'));
    }

    public function coinCollect_store(Request $request)
    {
        $coin = coin::find($request->coin_id);
        if($coin){
            if(Auth::user()->energy >= $coin->energy){

                Auth::user()->coin_gast = Auth::user()->coin_gast + $coin->amount;
                Auth::user()->energy = Auth::user()->energy - $coin->energy;
                Auth::user()->save();

                $coinCollect = new coinCollect;
                $coinCollect->user_id = Auth::user()->id;
                $coinCollect->coin_id = $coin->id;
                $coinCollect->amount = $coin->amount;
                $coinCollect->energy = $coin->energy;
                $coinCollect->save();

                alert()->success('Charge '.$coin->energy.' Energy  ','Get '.$coin->amount.' GAST!');

            }else{
                alert()->info('Energy not enough!');
            }
        }

        return redirect()->back();
    }

    public function coinClaim_index()
    {
        $coinClaims = coinClaim::orderby('id', 'desc')->where('user_id',Auth::user()->id)->get();
        return view('user.coinClaim.index', compact('coinClaims'));
    }

    public function coinClaim_store(Request $request)
    {

        $request->validate([
            'amount' => ['required','numeric','min:1'],
        ]);

        if(Auth::user()->coin_gast >= $request->amount){
            $amount_ttg = $request->amount / 100;
            if(Auth::user()->coin_ttg >= $amount_ttg){

                Auth::user()->coin_gast = Auth::user()->coin_gast - $request->amount;
                Auth::user()->coin_ttg = Auth::user()->coin_ttg - $amount_ttg;
                Auth::user()->save();

                $coinClaim = new coinClaim;
                $coinClaim->user_id = Auth::user()->id;
                $coinClaim->amount = $request->amount;
                $coinClaim->note = $request->note;
                $coinClaim->save();

                alert()->success('Successfully');
            }else{
                alert()->info('TTG Balance not enough');
            }
        }else{
        alert()->info('GAST Balance not enough');
        }

        return redirect()->back();
    }

    public function rewardCollect_index()
    {
        $rewardCollects = rewardCollect::orderby('id', 'desc')->where('user_id',Auth::user()->id)->get();
        $rewardCollectHistorys = rewardCollectHistory::orderby('id', 'desc')->where('user_id',Auth::user()->id)->get();
        return view('user.rewardCollect.index', compact('rewardCollects','rewardCollectHistorys'));
    }

    public function rewardCollect_store(Request $request)
    {

        $reward = reward::find($request->reward_id);
        if($reward){
            if(Auth::user()->energy >= $reward->energy){

                Auth::user()->energy = Auth::user()->energy - $reward->energy;
                Auth::user()->save();

                $rewardCollect = rewardCollect::where('user_id', Auth::user()->id)->where('reward_id', $reward->id)->first();
                if($rewardCollect){
                    $rewardCollect->qty = $rewardCollect->qty + 1;
                    $rewardCollect->save();
                }else{
                    $rewardCollect = new rewardCollect;
                    $rewardCollect->user_id = Auth::user()->id;
                    $rewardCollect->reward_id = $reward->id;
                    $rewardCollect->qty = 1;
                    $rewardCollect->save();
                }

                $rewardCollectHistory = new rewardCollectHistory;
                $rewardCollectHistory->reward_id = $reward->id;
                $rewardCollectHistory->reward_collect_id = $rewardCollect->id;
                $rewardCollectHistory->user_id = Auth::user()->id;
                $rewardCollectHistory->amount = $reward->amount;
                $rewardCollectHistory->energy = $reward->energy;
                $rewardCollectHistory->save();

                alert()->success('Successfully');

            }else{
                alert()->info('Energy not enough!');
            }
        }

        return redirect()->back();
    }

    public function mall_index()
    {
        $rewardBuys = rewardBuy::orderby('id', 'desc')->where('user_id', Auth::user()->id)->paginate(5);
        $rewardSells = rewardBuy::orderby('id', 'desc')->where('seller_id', Auth::user()->id)->paginate(5);
        $rewards = rewardSell::orderby('id', 'desc')->where('qty', '>', 0)->paginate(5);
        return view('user.rewardSell.index', compact('rewardBuys','rewards','rewardSells'));
    }

    public function rewardSell_index()
    {
        $rewardBuys = rewardBuy::orderby('id', 'desc')->where('user_id', Auth::user()->id)->paginate(5);
        $rewardSells = rewardBuy::orderby('id', 'desc')->where('seller_id', Auth::user()->id)->paginate(5);
        $rewards = rewardSell::orderby('id', 'desc')->where('qty', '>', 0)->paginate(5);
        return view('user.rewardSell.index', compact('rewardBuys','rewards','rewardSells'));
    }


     public function rewardSell_store(Request $request)
    {
        $request->validate([
            'amount' => ['required','numeric'],
        ]);

        $rewardCollect = rewardCollect::find($request->reward_collect_id);
        if($rewardCollect){
            if($rewardCollect->qty >= $request->qty){

                $rewardCollect->qty = $rewardCollect->qty - $request->qty;
                $rewardCollect->save();

                $rewardSell = new rewardSell;
                $rewardSell->reward_id = $rewardCollect->reward_id;
                $rewardSell->reward_collect_id = $rewardCollect->id;
                $rewardSell->user_id = Auth::user()->id;
                $rewardSell->qty = $request->qty;
                $rewardSell->amount = $request->amount;
                $rewardSell->save();

                alert()->success('Successfully');

            }else{
                alert()->info('Out of stock!');
            }
        }

        return redirect()->back();
    }

    public function rewardBuy_store(Request $request)
    {
        $rewardSell = rewardSell::find($request->reward_sell_id);
        if($rewardSell){
            if($rewardSell->qty >= $request->qty){
                $amount = $rewardSell->amount * $request->qty;
               if(Auth::user()->coin_ttg >= $amount){

                Auth::user()->coin_ttg = Auth::user()->coin_ttg - $amount;
                Auth::user()->save();

                $rewardCollect = rewardCollect::where('user_id', Auth::user()->id)->where('reward_id', $rewardSell->reward_id)->first();
                if($rewardCollect){
                    $rewardCollect->qty = $rewardCollect->qty + $request->qty;
                    $rewardCollect->save();
                }else{
                    $rewardCollect = new rewardCollect;
                    $rewardCollect->user_id = Auth::user()->id;
                    $rewardCollect->reward_id = $rewardSell->reward_id;
                    $rewardCollect->qty = $request->qty;
                    $rewardCollect->save();
                }



                $seller = user::find($rewardSell->user_id);
                if($seller){
                    $seller->coin_ttg = $seller->coin_ttg + $amount;
                    $seller->save();
                }

                $rewardSell->qty = $rewardSell->qty - $request->qty;
                $rewardSell->save();

                $rewardBuy = new rewardBuy;
                $rewardBuy->reward_id = $rewardSell->reward_id;
                $rewardBuy->reward_collect_id = $rewardSell->reward_collect_id;
                $rewardBuy->user_id = Auth::user()->id;
                $rewardBuy->seller_id = $seller->id;
                $rewardBuy->reward_sell_id = $rewardSell->id;
                $rewardBuy->qty = $request->qty;
                $rewardBuy->amount = $rewardSell->amount;
                $rewardBuy->save();

                alert()->success('Successfully');

                alert()->success('Successfully');
               }else{
                alert()->info('TTG Balance not enough');
                }

            }else{
                alert()->info('Out of stock!');
            }
        }

        return redirect()->back();
    }

    public function rewardClaim_index()
    {
        $rewardClaims = rewardClaim::orderby('id', 'desc')->where('user_id',Auth::user()->id)->paginate(5);
        return view('user.rewardClaim.index', compact('rewardClaims'));
    }


    public function rewardClaim_store(Request $request)
    {
        $rewardCollect = rewardCollect::find($request->reward_collect_id);

        if($rewardCollect){
            $reward = reward::find($rewardCollect->reward_id);
            if($rewardCollect->qty >= $request->qty){
                  $amount = $reward->amount * $request->qty;
               if(Auth::user()->coin_ttg >= $amount){

                Auth::user()->coin_ttg = Auth::user()->coin_ttg - $amount;
                Auth::user()->save();

                $rewardCollect->qty = $rewardCollect->qty - $request->qty;
                $rewardCollect->save();

                $rewardClaim = new rewardClaim;
                $rewardClaim->user_id = Auth::user()->id;
                $rewardClaim->reward_id = $reward->id;
                $rewardClaim->reward_collect_id = $rewardCollect->id;
                if($request->file('proof_image')){
                    $file = $request->file('proof_image');
                    $proof_imagetitle = time().'proof_image.'.$file->getClientOriginalExtension();
                    $file->move('img/', $proof_imagetitle);
                    $user->proof_image = $proof_imagetitle;
                }
                $rewardClaim->recipient_name = $request->recipient_name;
                $rewardClaim->recipient_phone = $request->recipient_phone;
                $rewardClaim->recipient_address = $request->recipient_address;
                $rewardClaim->qty = $request->qty;
                $rewardClaim->amount = $amount;
                $rewardClaim->save();

                alert()->success('Successfully');
               }else{
                alert()->info('TTG Balance not enough');
                }

            }else{
                alert()->info('Out of stock!');
            }
        }

        return redirect()->back();
    }

    public function puzzleCollect_index()
    {
        $puzzles = puzzle::all();
        $puzzleCollects = puzzleCollect::orderby('id', 'desc')->where('user_id',Auth::user()->id)->get();
        $puzzleCollectHistorys = puzzleCollectHistory::orderby('id', 'desc')->where('user_id',Auth::user()->id)->paginate();
        $puzzlePieceCollectHistorys = puzzlePieceCollectHistory::orderby('id', 'desc')->where('user_id',Auth::user()->id)->paginate();
        return view('user.puzzleCollect.index', compact('puzzlePieceCollectHistorys','puzzleCollects','puzzleCollectHistorys','puzzles'));
    }


    public function puzzleCollect_store(Request $request)
    {
        $puzzle = puzzle::find($request->puzzle_id);
        if($puzzle){
            $puzzlePieceCollects = puzzlePieceCollect::where('puzzle_id',$puzzle->id)->where('user_id',Auth::user()->id)->where('qty','>=',$request->qty)->get();

            if(count($puzzlePieceCollects) >= $puzzle->pieces){

                if(Auth::user()->coin_ttg >= $puzzle->amount){


                    foreach($puzzlePieceCollects as $puzzlePieceCollect){
                        $puzzlePieceCollect->qty = $puzzlePieceCollect->qty - $request->qty;
                        $puzzlePieceCollect->save();
                    }

                    $amount = $puzzle->amount * $request->qty;

                    Auth::user()->coin_ttg = Auth::user()->coin_ttg - $amount;
                    Auth::user()->save();

                    $puzzleCollect = puzzleCollect::where('user_id', Auth::user()->id)->where('puzzle_id', $puzzle->id)->first();
                    if($puzzleCollect){
                        $puzzleCollect->qty = $puzzleCollect->qty + $request->qty;
                        $puzzleCollect->save();
                    }else{
                        $puzzleCollect = new puzzleCollect;
                        $puzzleCollect->user_id = Auth::user()->id;
                        $puzzleCollect->puzzle_id = $puzzle->id;
                        $puzzleCollect->qty = $request->qty;
                        $puzzleCollect->save();
                    }

                    $puzzleCollectHistory = new puzzleCollectHistory;
                    $puzzleCollectHistory->puzzle_id = $puzzle->id;
                    $puzzleCollectHistory->puzzle_collect_id = $puzzleCollect->id;
                    $puzzleCollectHistory->user_id = Auth::user()->id;
                    $puzzleCollectHistory->amount = $amount;
                    $puzzleCollectHistory->qty = $request->qty;
                    $puzzleCollectHistory->save();

                    alert()->success('Successfully');

                }else{
                    alert()->info('TTG Balance not enough!');
                }


            }else{
                alert()->info('Puzzle Not Completed!');
            }
        }

       return redirect()->back();
    }

    public function puzzlePieceCollect_store(Request $request)
    {

        $puzzlePiece = puzzlePiece::find($request->puzzle_piece_id);
        if($puzzlePiece){
            if(Auth::user()->energy >= $puzzlePiece->energy){

                Auth::user()->energy = Auth::user()->energy - $puzzlePiece->energy;
                Auth::user()->save();

                $puzzlePieceCollect = puzzlePieceCollect::where('user_id', Auth::user()->id)->where('puzzle_piece_id', $puzzlePiece->id)->first();
                if($puzzlePieceCollect){
                    $puzzlePieceCollect->qty = $puzzlePieceCollect->qty + 1;
                    $puzzlePieceCollect->save();
                }else{
                    $puzzlePieceCollect = new puzzlePieceCollect;
                    $puzzlePieceCollect->user_id = Auth::user()->id;
                    $puzzlePieceCollect->puzzle_id = $puzzlePiece->puzzle_id;
                    $puzzlePieceCollect->puzzle_piece_id = $puzzlePiece->id;
                    $puzzlePieceCollect->qty = 1;
                    $puzzlePieceCollect->save();
                }

                $puzzlePieceCollectHistory = new puzzlePieceCollectHistory;
                $puzzlePieceCollectHistory->puzzle_piece_id = $puzzlePiece->id;
                $puzzlePieceCollectHistory->puzzle_piece_collect_id = $puzzlePieceCollect->id;
                $puzzlePieceCollectHistory->user_id = Auth::user()->id;
                $puzzlePieceCollectHistory->amount = $puzzlePiece->amount;
                $puzzlePieceCollectHistory->energy = $puzzlePiece->energy;
                $puzzlePieceCollectHistory->save();

                alert()->success('Successfully');

            }else{
                alert()->info('Energy not enough!');
            }
        }

        return redirect()->back();
    }



    public function puzzlePieceSell_index()
    {
        $puzzlePieceBuys = puzzlePieceBuy::orderby('id', 'desc')->where('user_id', Auth::user()->id)->paginate(5);
        $puzzlePieceSells = puzzlePieceBuy::orderby('id', 'desc')->where('seller_id', Auth::user()->id)->paginate(5);
        $pieces = puzzlePieceSell::orderby('id', 'desc')->where('qty', '>', 0)->paginate(5);
        return view('user.puzzlePieceSell.index', compact('puzzlePieceBuys','pieces','puzzlePieceSells'));
    }


    public function puzzlePieceSell_store(Request $request)
    {
        $request->validate([
            'amount' => ['required','numeric','min:1'],
            'qty' => ['required','numeric','min:1'],
        ]);

        $puzzlePieceCollect = puzzlePieceCollect::find($request->puzzle_piece_collect_id);
        if($puzzlePieceCollect){
            if($puzzlePieceCollect->qty >= $request->qty){

                $puzzlePieceCollect->qty = $puzzlePieceCollect->qty - $request->qty;
                $puzzlePieceCollect->save();

                $puzzlePieceSell = new puzzlePieceSell;
                $puzzlePieceSell->puzzle_piece_id = $puzzlePieceCollect->puzzle_piece_id;
                $puzzlePieceSell->puzzle_piece_collect_id = $puzzlePieceCollect->id;
                $puzzlePieceSell->user_id = Auth::user()->id;
                $puzzlePieceSell->qty = $request->qty;
                $puzzlePieceSell->amount = $request->amount;
                $puzzlePieceSell->save();

                alert()->success('Successfully');

            }else{
                alert()->info('Out of stock!');
            }
        }else{
            alert()->info('Puzzle piece not  found');
        }

        return redirect()->back();
    }

    public function puzzlePieceBuy_store(Request $request)
    {
        $request->validate([
            'qty' => ['required','numeric','min:1'],
        ]);

        $puzzlePieceSell = puzzlePieceSell::where('id', $request->puzzle_piece_sell_id)->where('user_id','!=', Auth::user()->id)->first();

        if($puzzlePieceSell){
            if($puzzlePieceSell->qty >= $request->qty){
                $amount = $puzzlePieceSell->amount * $request->qty;
                if(Auth::user()->coin_ttg >= $amount){

                    Auth::user()->coin_ttg = Auth::user()->coin_ttg - $amount;
                    Auth::user()->save();

                    $puzzlePieceCollect = puzzlePieceCollect::where('user_id', Auth::user()->id)->where('puzzle_piece_id', $puzzlePieceSell->puzzle_piece_id)->first();
                    if($puzzlePieceCollect){
                        $puzzlePieceCollect->qty = $puzzlePieceCollect->qty + $request->qty;
                        $puzzlePieceCollect->save();
                    }else{
                        $puzzlePieceCollect = new puzzlePieceCollect;
                        $puzzlePieceCollect->user_id = Auth::user()->id;
                        $puzzlePieceCollect->puzzle_piece_id = $puzzlePieceSell->puzzle_piece_id;
                        $puzzlePieceCollect->qty = $request->qty;
                        $puzzlePieceCollect->save();
                    }



                    $seller = user::find($puzzlePieceSell->user_id);
                    if($seller){
                        $seller->coin_ttg = $seller->coin_ttg + $amount;
                        $seller->save();
                    }

                    $puzzlePieceSell->qty = $puzzlePieceSell->qty - $request->qty;
                    $puzzlePieceSell->save();

                    $puzzlePieceBuy = new puzzlePieceBuy;
                    $puzzlePieceBuy->puzzle_piece_id = $puzzlePieceSell->puzzle_piece_id;
                    $puzzlePieceBuy->puzzle_piece_collect_id = $puzzlePieceSell->id;
                    $puzzlePieceBuy->user_id = Auth::user()->id;
                    $puzzlePieceBuy->seller_id = $seller->id;
                    $puzzlePieceBuy->puzzle_piece_sell_id = $puzzlePieceSell->id;
                    $puzzlePieceBuy->qty = $request->qty;
                    $puzzlePieceBuy->amount = $puzzlePieceSell->amount;
                    $puzzlePieceBuy->save();

                    alert()->success('Successfully');

                }else{
                    alert()->info('TTG balance not enough!');
                }

            }else{
                alert()->info('Out of stock!');
            }
        }else{
            alert()->info('Puzzle not found!');
        }


        return redirect()->back();
    }

    public function puzzleClaim_index()
    {
        $puzzleClaims = puzzleClaim::orderby('id', 'desc')->where('user_id',Auth::user()->id)->paginate(5);
        return view('user.puzzleClaim.index', compact('puzzleClaims'));
    }

    public function puzzleClaim_store(Request $request)
    {
        $puzzleCollect = puzzleCollect::find($request->puzzle_collect_id);

        if($puzzleCollect){
            $puzzle = puzzle::find($puzzleCollect->puzzle_id);
            if($puzzleCollect->qty >= $request->qty){
                  $amount = $puzzle->amount * $request->qty;
               if(Auth::user()->coin_ttg >= $amount){

                Auth::user()->coin_ttg = Auth::user()->coin_ttg - $amount;
                Auth::user()->save();

                $puzzleCollect->qty = $puzzleCollect->qty - $request->qty;
                $puzzleCollect->save();

                $puzzleClaim = new puzzleClaim;
                $puzzleClaim->user_id = Auth::user()->id;
                $puzzleClaim->puzzle_id = $puzzle->id;
                $puzzleClaim->puzzle_collect_id = $puzzleCollect->id;
                if($request->file('proof_image')){
                    $file = $request->file('proof_image');
                    $proof_imagetitle = time().'proof_image.'.$file->getClientOriginalExtension();
                    $file->move('img/', $proof_imagetitle);
                    $user->proof_image = $proof_imagetitle;
                }
                $puzzleClaim->recipient_name = $request->recipient_name;
                $puzzleClaim->recipient_phone = $request->recipient_phone;
                $puzzleClaim->recipient_address = $request->recipient_address;
                $puzzleClaim->qty = $request->qty;
                $puzzleClaim->amount = $amount;
                $puzzleClaim->save();

                alert()->success('Successfully');
               }else{
                alert()->info('TTG Balance not enough');
                }

            }else{
                alert()->info('Out of stock!');
            }
        }

        return redirect()->back();
    }

    public function weapon_index()
    {
        $weapons = weapon::orderby('id', 'desc')->paginate(5);
        return view('user.weapon.index', compact('weapons'));
    }

    public function weaponCollect_index()
    {
        $weaponCollects = weaponCollect::orderby('id', 'desc')->where('user_id',Auth::user()->id)->where('qty','>',0)->paginate(5);
        return view('user.weaponCollect.index', compact('weaponCollects'));
    }

    public function weaponAttack_index()
    {
        $weaponAttacks = weaponAttack::orderby('id', 'desc')->where('user_id',Auth::user()->id)->paginate(5);
        return view('user.weaponAttack.index', compact('weaponAttacks'));
    }

    public function weaponAttack_store(Request $request)
    {
        $weaponCollect = weaponCollect::find($request->weapon_collect_id);
        if($weaponCollect){
            if($request->qty){
                $qty = $request->qty;
            }else{
                $qty = 1;
            }
            if($weaponCollect->qty >= $qty){

                $weapon = weapon::find($weaponCollect->weapon_id);

                if($weapon){
                    $antagonist = antagonist::find($request->antagonist_id);
                    if($antagonist){

                        if($weapon->antagonist_id == $antagonist->id ||$weapon->antagonist_id == null ){
                            $weaponCollect->qty = $weaponCollect->qty - $qty;
                            $weaponCollect->save();

                            $weaponAttack = new weaponAttack;
                            $weaponAttack->weapon_id = $weaponCollect->weapon_id;
                            $weaponAttack->weapon_collect_id = $weaponCollect->id;
                            $weaponAttack->antagonist_id = $antagonist->id;
                            $weaponAttack->user_id = Auth::user()->id;
                            $weaponAttack->qty = $qty;
                            $weaponAttack->save();

                            alert()->success($weaponCollect->weapon->title.' Attack '.$weaponAttack->antagonist->title, $weaponAttack->qty);
                        }else{
                            alert()->error($antagonist->title.' is not able to be attacked with a '.$weapon->title);
                        }
                    }else{
                        alert()->info('Antagonist not exist');
                    }
                }else{
                    alert()->info('Weapon not exist');
                }

            }else{
                alert()->info('Out of stock!');
            }
        }else{
            alert()->info('Weapon Collection not exist');
        }

        return redirect()->back();
    }


    public function weaponBuy_index()
    {
        $weaponBuys = weaponBuy::orderby('id', 'desc')->paginate(5);
        return view('user.weaponBuy.index', compact('weaponBuys'));
    }

    public function weaponBuy_store(Request $request)
    {
        $weapon = weapon::find($request->weapon_id);
        if($weapon){
                $amount = $weapon->amount * $request->qty;
               if(Auth::user()->coin_ttg >= $amount){

                Auth::user()->coin_ttg = Auth::user()->coin_ttg - $amount;
                Auth::user()->save();

                $weaponCollect = weaponCollect::where('user_id', Auth::user()->id)->where('weapon_id', $weapon->id)->first();
                if($weaponCollect){
                    $weaponCollect->qty = $weaponCollect->qty + $request->qty;
                    $weaponCollect->save();
                }else{
                    $weaponCollect = new weaponCollect;
                    $weaponCollect->user_id = Auth::user()->id;
                    $weaponCollect->weapon_id = $weapon->id;
                    $weaponCollect->qty = $request->qty;
                    $weaponCollect->save();
                }

                $weaponBuy = new weaponBuy;
                $weaponBuy->weapon_id = $weapon->weapon_id;
                $weaponBuy->weapon_collect_id = $weaponCollect->id;
                $weaponBuy->user_id = Auth::user()->id;
                $weaponBuy->weapon_id = $weapon->id;
                $weaponBuy->qty = $request->qty;
                $weaponBuy->amount = $weapon->amount;
                $weaponBuy->save();

                alert()->success('Successfully');

               }else{
                alert()->info('TTG Balance not enough');
                }


        }else{
            alert()->info('weapon not exist');
        }

        return redirect()->back();
    }

    public function antagonistAttack_index()
    {
        $antagonistAttacks = antagonistAttack::orderby('id', 'desc')->where('user_id',Auth::user()->id)->paginate(5);
        return view('user.antagonistAttack.index', compact('antagonistAttacks'));
    }


    public function antagonistAttack_store(Request $request)
    {
        $antagonist = antagonist::find($request->antagonist_id);

        if($antagonist){
           if(Auth::user()->energy >= 1){
            if(Auth::user()->energy >= $antagonist->energy){

                Auth::user()->energy = Auth::user()->energy - $antagonist->energy;
            Auth::user()->save();

            $antagonistAttack = new antagonistAttack;
            $antagonistAttack->antagonist_id = $antagonist->id;
            $antagonistAttack->user_id = Auth::user()->id;
            $antagonistAttack->energy = $antagonist->energy;
            $antagonistAttack->save();

            alert()->info($antagonist->title.' Attack ', $antagonistAttack->energy);

            }else{


                $antagonistAttack = new antagonistAttack;
                $antagonistAttack->antagonist_id = $antagonist->id;
                $antagonistAttack->user_id = Auth::user()->id;
                $antagonistAttack->energy = Auth::user()->energy;
                $antagonistAttack->save();

                Auth::user()->energy = 0;
                Auth::user()->save();

                alert()->info('Energy has run out!');
            }

           }else{
            alert()->info('Energy is blank!');
        }
        }else{
            alert()->info('Antagonist not exist');
        }






        return redirect()->back();
    }



}
