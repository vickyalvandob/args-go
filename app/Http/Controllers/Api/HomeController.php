<?php

namespace App\Http\Controllers\Api;

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
use App\General;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


    /**
     * @authenticated
     * APIs for users
    */

class HomeController extends Controller
{
    protected $general;

    public function __construct()
    {
        $this->general = general::first();
    }


        /**
     *  @group  User
     *
    * Index
    *
    * @response {
    *  "user": "user data"
    * }
    *
    */

    public function profile_index()
    {
        return response()->json(auth('api')->user());
    }

        /**
     *  @group  User
     *
    * Update
    *
    * @bodyParam  name string required
    * @bodyParam  city string required
    * @bodyParam  zipcode string required
    * @bodyParam  phone string
    * @bodyParam  zipcode string
    * @bodyParam  city string
    * @bodyParam  birth date
    * @bodyParam  address text
    *
   * @response {
    *  "user": "user data"
    * }
    */
    public function profile_update(Request $request)
    {
        $user = User::find(auth('api')->user()->id);
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
        return response()->json([
            'user' => $user,
            'message' => 'Update Successfully'
        ], 200);
    }




        /**
     *  @group User
     *
    * Change Password
    *
    * @bodyParam  old_password string required
    * @bodyParam  password string required
    * @bodyParam  password_confirmation string required
    *
    * @response {
    *  "user": "user data"
    * }
    *
    */
    public function password_update(PasswordRequest $request)
    {
        $user = auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return response()->json([
            'user' => $user,
            'message' => 'Update Successfully'
        ], 200);
    }

     /**
     *  @group  Energy Boost
     *
    * Index
    *
   * @response {
    *  "energyBoost": "query tbl energy boost"
    * }
    */

    public function energyBoost_index()
    {
        $energyBoosts = energyBoost::orderby('id', 'desc')->where('user_id',auth('api')->user()->id)->get();
        return response()->json([
            'energyBoosts' => $energyBoosts,
        ], 200);
    }


 /**
     *  @group  Energy Boost
     *
    * Store
    *Boost enum[plus, minus] to update energy  until max or blank
    *
    * @bodyParam type string required
    *
   * @response {
    *  "user": "update energy user",
    *  "energyBoost": "store query tbl energy boost"
    * }
    */
    public function energyBoost_store(Request $request)
    {
        $user = User::find(auth('api')->user()->id);
        $amount = $user->energy_quota * ($this->general->boost_percentage / 100);

        if($user->energy_quota >= ($user->energy + $amount)){
            $user->energy = $user->energy + $amount;
            $user->save();

            $energyBoost = new energyBoost;
            $energyBoost->user_id = auth('api')->user()->id;
            $energyBoost->amount = $amount;
            $energyBoost->save();

            return response()->json([
                'energyBoost' => $energyBoost,
                'user' => $user,
                'message' => 'Successfully'
            ], 200);
        }else{


            $energyBoost = new energyBoost;
            $energyBoost->user_id = auth('api')->user()->id;
            $energyBoost->amount = ($user->energy + $amount) - $user->energy_quota;
            $energyBoost->save();

            $user->energy = $user->energy_quota;
            $user->save();

            return response()->json([
                'message' => 'Energy is full!'
            ], 404);
        }

    }

    /**
     *  @group  Top Up
     *
    * Index
    *
   * @response {
    *  "topUp": "show query top Up"
    * }
    */
    public function topUp_index()
    {
        $topUps = topUp::orderby('id', 'desc')->where('user_id',auth('api')->user()->id)->get();
        return response()->json([
            'topUps' => $topUps,
        ], 200);
    }


    /**
     *  @group  Top Up
     *
    * Store
    *
    * @bodyParam  amount double required
    * @bodyParam  note string
    * @bodyParam  proof_image string required
    *
    * @response {
    *  "topUp": "store new query top Up"
    * }
    */

    public function topUp_store(Request $request)
    {

        $request->validate([
            'amount' => ['required','numeric'],
            'proof_image' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => $validator->errors(),
            ], 422);
        }

        $tax = $request->amount * ($this->general->topUp_tax / 100);

        $topUp = new topUp;
        $topUp->user_id = auth('api')->user()->id;
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
        return response()->json([
            'topUp' => $topUp,
            'message' => 'Successfully, Wait for top up processing day'
        ], 200);

    }

        /**
     *  @group  Payout
     *
    * Index
    *
   * @response {
    *  "payout": "payout data"
    * }
    */
    public function payout_index()
    {
        $payouts = payout::orderby('id', 'desc')->where('user_id',auth('api')->user()->id)->get();
        return response()->json([
            'payouts' => $payouts,
        ], 200);
    }

    /**
     *  @group  Payout
     *
    * Store
    *
    * @bodyParam  amount double required
    * @bodyParam  note string
    *
    * @response {
    *  "user": "user data",
    *  "payout": "payout data"
    * }
    */
    public function payout_store(Request $request)
    {
        $request->validate([
            'amount' => ['required','numeric'],
        ]);

        if (auth('api')->user()->balance >= $request->amount) {
            $energy = $request->amount * $this->general->energy_exchange;
            if (auth('api')->user()->energy >= $energy) {

                $tax = $request->amount * ($this->general->payout_tax / 100);

                auth('api')->user()->balance = auth('api')->user()->balance - $request->amount;
                auth('api')->user()->energy = auth('api')->user()->energy - $energy;
                auth('api')->user()->save();

                $payout = new payout;
                $payout->user_id = auth('api')->user()->id;
                $payout->amount = $request->amount - $tax;
                $payout->tax = $tax;
                $payout->energy = $energy;
                $payout->save();

                return response()->json([
                    'user' => auth('api')->user(),
                    'payout' => $payout,
                    'message' => 'Successfully'
                ], 200);

            }else{
                return response()->json(['message' => 'Energy not enough!'], 404);
            }
        }else{
            return response()->json(['message' => 'Balance not enough!'], 404);
        }

    }


        /**
     *  @group  Transfer
     *
    * Index
    *
   * @response {
    *  "transfer": "transfer data"
    * }
    */
    public function transfer_index()
    {
        $transfers = transfer::orderby('id', 'desc')->where('user_id',auth('api')->user()->id)->get();
        return response()->json([
            'transfers' => $transfers,
        ], 200);
    }
    /**
     *  @group  Transfer
     *
    * Store
    *
    * @bodyParam  username string required
    * @bodyParam  amount double required
    * @bodyParam  type string enum['ARGS', 'GAST',]
    * @bodyParam  note string
    *
    * @response {
    *  "user": "user data",
    *  "recipient": "recipient data",
    *  "transfer": "transfer data"
    * }
    */
    public function transfer_store(Request $request)
    {


        $request->validate([
            'type' => ['required'],
            'amount' => ['required','numeric'],
        ]);
        $recipient = User::where('username', $request->username)->first();
        if ($recipient) {

           if($request->type == 'ARGS'){
                if (auth('api')->user()->balance >= $request->amount) {

                    $energy = $request->amount * $this->general->energy_exchange;
                    if (auth('api')->user()->energy >= $energy) {

                        if(auth('api')->user()->coin_ttg >= $this->general->transfer_ttg){

                            $tax = $request->amount * ($this->general->transfer_tax / 100);
                            // ttg
                            auth('api')->user()->balance = auth('api')->user()->balance - $request->amount;
                            auth('api')->user()->energy = auth('api')->user()->energy - $energy;
                            auth('api')->user()->coin_ttg = auth('api')->user()->coin_ttg - $this->general->transfer_ttg;
                            auth('api')->user()->save();

                            $recipient->balance = $recipient->balance + $request->amount;
                            $recipient->energy = $recipient->energy + $energy;
                            $recipient->energy_quota = $recipient->energy_quota + $energy;
                            $recipient->save();

                            $transfer = new transfer;
                            $transfer->user_id = auth('api')->user()->id;
                            $transfer->recipient_id = $recipient->id;
                            $transfer->type = $request->type;
                            $transfer->amount = $request->amount - $tax;
                            $transfer->tax = $tax;
                            $transfer->ttg = $this->general->transfer_ttg;
                            $transfer->energy = $energy;
                            $transfer->save();

                            return response()->json([
                                'user' => auth('api')->user(),
                                'recipient' => $recipient,
                                'transfer' => $transfer,
                                'message' => 'Successfully'
                            ], 200);

                        }else{
                            return response()->json(['message' => 'TTG balance not enough!'], 404);
                        }

                    }else{
                        return response()->json(['message' => 'Energy not enough!'], 404);
                    }
                }else{
                    return response()->json(['message' => 'ARGS Balance not enough!'], 404);
                }
           }elseif($request->type == 'GAST'){
                if (auth('api')->user()->coin_gast >= $request->amount) {

                    $energy = $request->amount * $this->general->energy_exchange;
                    if (auth('api')->user()->energy >= $energy) {

                        if(auth('api')->user()->coin_ttg >= $this->general->transfer_ttg){

                            $tax = $request->amount * ($this->general->transfer_tax / 100);
                            // ttg
                            auth('api')->user()->coin_gast = auth('api')->user()->coin_gast - $request->amount;
                            auth('api')->user()->energy = auth('api')->user()->energy - $energy;
                            auth('api')->user()->coin_ttg = auth('api')->user()->coin_ttg - $this->general->transfer_ttg;
                            auth('api')->user()->save();

                            $recipient->coin_gast = $recipient->coin_gast + $request->amount;
                            $recipient->energy = $recipient->energy + $energy;
                            $recipient->save();

                            $transfer = new transfer;
                            $transfer->user_id = auth('api')->user()->id;
                            $transfer->recipient_id = $recipient->id;
                            $transfer->type = $request->type;
                            $transfer->amount = $request->amount - $tax;
                            $transfer->tax = $tax;
                            $transfer->ttg = $this->general->transfer_ttg;
                            $transfer->energy = $energy;
                            $transfer->save();

                            return response()->json([
                                'user' => auth('api')->user(),
                                'recipient' => $recipient,
                                'transfer' => $transfer,
                                'message' => 'Successfully'
                            ], 200);

                        }else{
                            return response()->json(['message' => 'TTG balance not enough!'], 404);
                        }

                    }else{
                        return response()->json(['message' => 'Energy not enough!'], 404);
                    }
                }else{
                    return response()->json(['message' => 'GAST Balance not enough!'], 404);
                }
            }elseif($request->type == 'TTG'){
                if (auth('api')->user()->coin_ttg >= $request->amount) {

                    $energy = $request->amount * $this->general->energy_exchange;
                    if (auth('api')->user()->energy >= $energy) {

                        if(auth('api')->user()->coin_ttg >= $this->general->transfer_ttg){

                            $tax = $request->amount * ($this->general->transfer_tax / 100);
                            // ttg
                            auth('api')->user()->energy = auth('api')->user()->energy - $energy;
                            auth('api')->user()->coin_ttg = auth('api')->user()->coin_ttg - ($this->general->transfer_ttg + $request->amount);
                            auth('api')->user()->save();

                            $recipient->coin_ttg = $recipient->coin_ttg + $request->amount;
                            $recipient->energy = $recipient->energy + $energy;
                            $recipient->save();

                            $transfer = new transfer;
                            $transfer->user_id = auth('api')->user()->id;
                            $transfer->recipient_id = $recipient->id;
                            $transfer->type = $request->type;
                            $transfer->amount = $request->amount - $tax;
                            $transfer->tax = $tax;
                            $transfer->ttg = $this->general->transfer_ttg;
                            $transfer->energy = $energy;
                            $transfer->save();

                            return response()->json([
                                'user' => auth('api')->user(),
                                'recipient' => $recipient,
                                'transfer' => $transfer,
                                'message' => 'Successfully'
                            ], 200);

                        }else{
                            return response()->json(['message' => 'TTG balance not enough!'], 404);
                        }

                    }else{
                        return response()->json(['message' => 'TTG Energy not enough!'], 404);
                    }
                }else{
                    return response()->json(['message' => 'Balance not enough!'], 404);
                }
           }
        }else{
            return response()->json(['message' => 'Username not exnot exist!'], 404);
        }

    }

/**
     *  @group  Collection
     *
    * Get Collection
    * ambil data reward, coin, puzzle untuk di collect
    *
    * @response {
    *  "user": "user data",
    *  "coin": "coin data",
    *  "puzzle": "puzzle data",
    *  "puzzlePiece": "puzzlePiece data",
    *  "reward": "reward data",
    *  "message": "Get Collection"
    * }
    */
    public function collection_index()
    {
        $coin = coin::where('status','show')->inRandomOrder()->first();
        $puzzle = puzzle::where('status','show')->inRandomOrder()->first();
        $puzzlePiece = puzzlePiece::where('status','show')->inRandomOrder()->first();
        $reward = reward::where('status','show')->inRandomOrder()->first();

        return response()->json([
            'user' => auth('api')->user(),
            'coin' => $coin,
            'puzzle' => $puzzle,
            'puzzlePiece' => $puzzlePiece,
            'reward' => $reward,
            'message' => 'Get Collection'
        ], 200);

    }


/**
     *  @group  Collection
     *
    * Coin GAST Index
    * Get data coin GAST user yang sudah di collection
    *
    * @response {
    *  "coinCollects": "coinCollects",
    *  "message": "List Collect Coin GAST"
    * }
    */
    public function coinCollect_index()
    {
        $coinCollects = coinCollect::orderby('id', 'desc')->where('user_id',auth('api')->user()->id)->get();
        return response()->json([
            'coinCollects' => $coinCollects,
            'message' => 'List Collect Coin GAST'
        ], 200);
    }

    /**
     *  @group  Collection
        *
     * Coin GAST Store
    * Store collection coin nya pake coin_id yg di dapet dari get collection.
    *
    * @bodyParam  coin_id int required
    *
    * @response {
    *  "user": "update query user",
    *  "coinCollect": "store query coinCollect",
    *  "message": "Collect Coin GAST"
    * }
    */
    public function coinCollect_store(Request $request)
    {
        $coin = coin::find($request->coin_id);
        if($coin){
            if(auth('api')->user()->energy >= $coin->energy){

                auth('api')->user()->coin_gast = auth('api')->user()->coin_gast + $coin->amount;
                auth('api')->user()->energy = auth('api')->user()->energy - $coin->energy;
                auth('api')->user()->save();

                $coinCollect = new coinCollect;
                $coinCollect->user_id = auth('api')->user()->id;
                $coinCollect->coin_id = $coin->id;
                $coinCollect->amount = $coin->amount;
                $coinCollect->energy = $coin->energy;
                $coinCollect->save();

                return response()->json([
                    'user' => auth('api')->user(),
                    'coinCollect' => $coinCollect,
                    'message' => 'Collect Coin GAST'
                ], 200);

            }else{
                return response()->json(['message' => 'Energy not enough!'], 404);
            }
        }

    }

      /**
     *  @group  Claim
     *
    * Claim Coin GAST Index
    * Get data coin GAST user yang sudah di claim
    *
    * @response {
    *  "coinClaims": "List claim coin GAST"
    * }
    */

    public function coinClaim_index()
    {
        $coinClaims = coinClaim::orderby('id', 'desc')->where('user_id',auth('api')->user()->id)->get();
        return response()->json([
            'coinClaims' => $coinClaims,
            'message' => 'List claim coin GAST'
        ], 200);
    }

    /**
     *  @group  Claim
     *
    * Claim Coin GAST Store
    * Request claim coin gast use coin ttg
    *
    * @bodyParam  amount double required
    * @bodyParam  note text optional
    *
    * @response {
   *  "user": "update coin_gast & coin_ttg user",
    *  "coinClaim": "store query coinClaim "
    * }
    */
    public function coinClaim_store(Request $request)
    {
        if(auth('api')->user()->coin_gast >= $request->amount){
            $amount_ttg = $request->amount / 100;
            if(auth('api')->user()->coin_ttg >= $amount_ttg){

                auth('api')->user()->coin_gast = auth('api')->user()->coin_gast - $request->amount;
                auth('api')->user()->coin_ttg = auth('api')->user()->coin_ttg - $amount_ttg;
                auth('api')->user()->save();

                $coinClaim = new coinClaim;
                $coinClaim->user_id = auth('api')->user()->id;
                $coinClaim->coin_id = $request->coin_id;
                $coinClaim->amount = $request->amount;
                $coinClaim->note = $request->note;
                $coinClaim->save();

                return response()->json([
                    'user' => auth('api')->user(),
                    'coinClaim' => $coinClaim,
                    'message' => 'Successfully'
                ], 200);

            }else{
                return response()->json(['message' => 'TTG Balance not enough'], 404);
            }
        }else{
        return response()->json(['message' => 'GAST Balance not enough'], 404);
        }
    }

/**
     *  @group  Collection
     *
    * Reward Index
    * Get data reward user yang sudah di collection
    *
    * @response {
    *  "rewardCollects": "rewardCollects",
    *  "rewardCollectHistory": "rewardCollectHistory",
    *  "message": "List Collect Reward"
    * }
    */
    public function rewardCollect_index()
    {
        $rewardCollects = rewardCollect::orderby('id', 'desc')->where('user_id',auth('api')->user()->id)->get();
        $rewardCollectHistorys = rewardCollectHistory::orderby('id', 'desc')->where('user_id',auth('api')->user()->id)->get();
        return response()->json([
            'rewardCollects' => $rewardCollects,
            'rewardCollectHistorys' => $rewardCollectHistorys,
            'message' => 'Successfully'
        ], 200);
    }


    /**
     *  @group  Collection
     *
    * Reward Store
    * Store collection reward  pake reward_id yg di dapet dari get collection.
    *
    * @bodyParam  reward_id int required
    *
    * @response {
    *  "user": "user",
    *  "rewardCollect": "rewardCollect",
    *  "rewardCollectHistory": "rewardCollectHistory"
    * }
    */

    public function rewardCollect_store(Request $request)
    {

        $reward = reward::find($request->reward_id);
        if($reward){
            if(auth('api')->user()->energy >= $reward->energy){

                auth('api')->user()->energy = auth('api')->user()->energy - $reward->energy;
                auth('api')->user()->save();

                $rewardCollect = rewardCollect::where('user_id', auth('api')->user()->id)->where('reward_id', $reward->id)->first();
                if($rewardCollect){
                    $rewardCollect->qty = $rewardCollect->qty + 1;
                    $rewardCollect->save();
                }else{
                    $rewardCollect = new rewardCollect;
                    $rewardCollect->user_id = auth('api')->user()->id;
                    $rewardCollect->reward_id = $reward->id;
                    $rewardCollect->qty = 1;
                    $rewardCollect->save();
                }

                $rewardCollectHistory = new rewardCollectHistory;
                $rewardCollectHistory->reward_id = $reward->id;
                $rewardCollectHistory->reward_collect_id = $rewardCollect->id;
                $rewardCollectHistory->user_id = auth('api')->user()->id;
                $rewardCollectHistory->amount = $reward->amount;
                $rewardCollectHistory->energy = $reward->energy;
                $rewardCollectHistory->save();


                return response()->json([
                    'user' => auth('api')->user(),
                    'rewardCollect' => $rewardCollect,
                    'rewardCollectHistory' => $rewardCollectHistory,
                    'message' => 'Successfully'
                ], 200);



            }else{
                return response()->json(['message' => 'Energy not enough!'], 404);
            }
        }else{
            return response()->json(['message' => 'Reward not found!'], 404);
        }

    }

/**
     *  @group  Mall
     *
    *  reward Sells Index
    *
    * @response {
    *  "rewardSells": "list item user Sell reward in mall",
    *  "pieces": "List item in mall"
    * }
    */
    public function rewardSell_index()
    {

        $puzzlePieceSells = puzzlePieceSell::orderby('id', 'desc')->where('user_id', auth('api')->user()->id)->paginate(5);
        $pieces = puzzlePieceSell::orderby('id', 'desc')->where('qty', '>', 0)->paginate(5);
        return response()->json([
            'puzzlePieceSells' => $puzzlePieceSells,
            'pieces' => $pieces
        ], 200);

        $rewardBuys = rewardBuy::orderby('id', 'desc')->where('user_id', auth('api')->user()->id)->paginate(5);
        $rewardSells = rewardBuy::orderby('id', 'desc')->where('seller_id', auth('api')->user()->id)->paginate(5);
        $rewards = rewardSell::orderby('id', 'desc')->where('qty', '>', 0)->paginate(5);
        return response()->json([
            'rewardBuys' => $rewardBuys,
            'rewardSells' => $rewardSells,
            'rewards' => $rewards,
            'message' => 'Successfully'
        ], 200);
    }

    /**
     *  @group  Mall
     *
    * Reward Sell Store
    *
    * @bodyParam  reward_collect_id int required
    * @bodyParam  amount int required
    * @bodyParam  qty int required
    *
    * @response {
    *  "user": "user",
    *  "rewardCollect": "rewardCollect",
    *  "rewardSell": "rewardSell"
    * }
    */
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
                $rewardSell->user_id = auth('api')->user()->id;
                $rewardSell->qty = $request->qty;
                $rewardSell->amount = $request->amount;
                $rewardSell->save();

                return response()->json([
                    'user' => auth('api')->user(),
                    'rewardCollect' => $rewardCollect,
                    'rewardSell' => $rewardSell,
                    'message' => 'Successfully'
                ], 200);

            }else{
                return response()->json(['message' => 'Out of stock!'], 404);
            }
        }

    }

       /**
     *  @group  Mall
     *
    *  Reward Buys Index
    *
    * @response {
    *  "rewardBuys": "list item user buy reward another user in mall",
    *  "rewardSellBuys": "List item user sell reward in purchase another user"
    * }
    */

    public function rewardBuy_index()
    {
        $rewardBuys = rewardBuy::orderby('id', 'desc')->where('user_id', auth('api')->user()->id)->paginate(5);
        $rewardSellBuys = rewardBuy::orderby('id', 'desc')->where('seller_id', auth('api')->user()->id)->paginate(5);
        return response()->json([
            'rewardBuys' => $rewardBuys,
            'rewardSellBuys' => $rewardSellBuys
        ], 200);
    }

    /**
     *  @group  Mall
     *
    * Reward Buy Store
    *
    * @bodyParam  reward_collect_id int required
    * @bodyParam  amount int required
    * @bodyParam  qty int required
    *
    * @response {
    *  "user": "user",
    *  "seller": "seller",
    *  "rewardCollect": "rewardCollect",
    *  "rewardSell": "rewardSell",
    *  "rewardBuy": "rewardBuy"
    * }
    */
    public function rewardBuy_store(Request $request)
    {
        $rewardSell = rewardSell::find($request->reward_sell_id);
        if($rewardSell){
            if($rewardSell->qty >= $request->qty){
                $amount = $rewardSell->amount * $request->qty;
               if(auth('api')->user()->coin_ttg >= $amount){

                auth('api')->user()->coin_ttg = auth('api')->user()->coin_ttg - $amount;
                auth('api')->user()->save();

                $rewardCollect = rewardCollect::where('user_id', auth('api')->user()->id)->where('reward_id', $rewardSell->reward_id)->first();
                if($rewardCollect){
                    $rewardCollect->qty = $rewardCollect->qty + $request->qty;
                    $rewardCollect->save();
                }else{
                    $rewardCollect = new rewardCollect;
                    $rewardCollect->user_id = auth('api')->user()->id;
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
                $rewardBuy->user_id = auth('api')->user()->id;
                $rewardBuy->seller_id = $seller->id;
                $rewardBuy->reward_sell_id = $rewardSell->id;
                $rewardBuy->qty = $request->qty;
                $rewardBuy->amount = $rewardSell->amount;
                $rewardBuy->save();

                return response()->json([
                    'user' => auth('api')->user(),
                    'seller' => $seller,
                    'rewardCollect' => $rewardCollect,
                    'rewardSell' => $rewardSell,
                    'rewardBuy' => $rewardBuy,
                    'message' => 'Successfully'
                ], 200);

               }else{
                return response()->json(['message' => 'TTG Balance not enough'], 404);
                }

            }else{
                return response()->json(['message' => 'Out of stock!'], 404);
            }
        }

    }



    /**
     *  @group  Claim
     *
    * Reward Claim Index
    *
    * @response {
    *  "rewardClaims": "rewardClaims"
    * }
    */
    public function rewardClaim_index()
    {
        $rewardClaims = rewardClaim::orderby('id', 'desc')->where('user_id',auth('api')->user()->id)->get();
        return response()->json([
                    'rewardClaims' => $rewardClaims,
                    'message' => 'Successfully'
                ], 200);
    }

    /**
     *  @group  Claim
     *
    * Claim Reward Store
    *
    * request claim Reward use coin ttg
    *
    * @bodyParam  reward_collect_id double required
    * @bodyParam  qty double required
    * @bodyParam  recipient_name double required
    * @bodyParam  recipient_phone double required
    * @bodyParam  recipient_address double required
    * @bodyParam  note text optional
    *
    * @response {
   *  "user": "update query user",
    *  "rewardClaim": "store query rewardClaim",
    *  "rewardCollect": "store query rewardCollect",
    *  "reward": "store query reward"
    * }
    */

    public function rewardClaim_store(Request $request)
    {
        $rewardCollect = rewardCollect::find($request->reward_collect_id);

        if($rewardCollect){
            $reward = reward::find($rewardCollect->reward_id);
            if($rewardCollect->qty >= $request->qty){
                  $amount = $reward->amount * $request->qty;
               if(auth('api')->user()->coin_ttg >= $amount){

                auth('api')->user()->coin_ttg = auth('api')->user()->coin_ttg - $amount;
                auth('api')->user()->save();

                $rewardCollect->qty = $rewardCollect->qty - $request->qty;
                $rewardCollect->save();

                $rewardClaim = new rewardClaim;
                $rewardClaim->user_id = auth('api')->user()->id;
                $rewardClaim->reward_id = $reward->id;
                $rewardClaim->reward_collect_id = $rewardCollect->id;
                if($request->file('proof_image')){
                    $file = $request->file('proof_image');
                    $proof_imagetitle = time().'proof_image.'.$file->getClientOriginalExtension();
                    $file->move('img/', $proof_imagetitle);
                    $rewardClaim->proof_image = $proof_imagetitle;
                }
                $rewardClaim->recipient_name = $request->recipient_name;
                $rewardClaim->recipient_phone = $request->recipient_phone;
                $rewardClaim->recipient_address = $request->recipient_address;
                $rewardClaim->qty = $request->qty;
                $rewardClaim->amount = $amount;
                $rewardClaim->save();

                return response()->json([
                    'user' => auth('api')->user(),
                    'rewardClaim' => $rewardClaim,
                    'rewardCollect' => $rewardCollect,
                    'reward' => $reward,
                    'message' => 'Successfully'
                ], 200);

               }else{
                return response()->json(['message' => 'TTG Balance not enough'], 404);
                }

            }else{
                return response()->json(['message' => 'Out of stock!'], 404);
            }
        }

    }

        /**
     *  @group  Collection
     *
    *  Puzzle Index
    * get data puzzle yang telah ter combine dari pieces2 yg di collection
    *
    * @response {
    *  "puzzles": "get query puzzle",
    *  "puzzleCollects": "get query puzzleCollect",
    *  "puzzleCollectHistorys": "get query puzzleCollect"
    * }
    */


    public function puzzleCollect_index()
    {
        $puzzles = puzzle::all();
        $puzzleCollects = puzzleCollect::orderby('id', 'desc')->where('user_id',auth('api')->user()->id)->get();
        $puzzleCollectHistorys = puzzleCollectHistory::orderby('id', 'desc')->where('user_id',auth('api')->user()->id)->get();

        return response()->json([
            'puzzles' => $puzzles,
            'puzzleCollects' => $puzzleCollects,
            'puzzleCollectHistorys' => $puzzleCollectHistorys
        ], 200);

    }

     /**
     *  @group  Collection
     *
    *  Puzzle  Store
    * Combine pieces become full puzzle
    *
    * @bodyParam  puzzle_id int required
    * @bodyParam  qty int required
    *
    * @response {
   *  "user": "update query user",
    *  "puzzle": "show query puzzle",
    *  "puzzleCollect": "store or update qty puzzleCollect",
    *  "puzzleCollectHistory": "store query puzzleCollectHistory",
    *  "puzzlePieceCollectHistory": "store query puzzlePieceCollectHistory"
    * }
    */
    public function puzzleCollect_store(Request $request)
    {
        $puzzle = puzzle::find($request->puzzle_id);
        if($puzzle){
            $puzzlePieceCollects = puzzlePieceCollect::where('puzzle_id',$puzzle->id)->where('user_id',auth('api')->user()->id)->where('qty','>=',$request->qty)->get();

            if(count($puzzlePieceCollects) >= $puzzle->pieces){

                if(auth('api')->user()->coin_ttg >= $puzzle->amount){


                    foreach($puzzlePieceCollects as $puzzlePieceCollect){
                        $puzzlePieceCollect->qty = $puzzlePieceCollect->qty - $request->qty;
                        $puzzlePieceCollect->save();
                    }

                    $amount = $puzzle->amount * $request->qty;

                    auth('api')->user()->coin_ttg = auth('api')->user()->coin_ttg - $amount;
                    auth('api')->user()->save();

                    $puzzleCollect = puzzleCollect::where('user_id', auth('api')->user()->id)->where('puzzle_id', $puzzle->id)->first();
                    if($puzzleCollect){
                        $puzzleCollect->qty = $puzzleCollect->qty + $request->qty;
                        $puzzleCollect->save();
                    }else{
                        $puzzleCollect = new puzzleCollect;
                        $puzzleCollect->user_id = auth('api')->user()->id;
                        $puzzleCollect->puzzle_id = $puzzle->id;
                        $puzzleCollect->qty = $request->qty;
                        $puzzleCollect->save();
                    }

                    $puzzleCollectHistory = new puzzleCollectHistory;
                    $puzzleCollectHistory->puzzle_id = $puzzle->id;
                    $puzzleCollectHistory->puzzle_collect_id = $puzzleCollect->id;
                    $puzzleCollectHistory->user_id = auth('api')->user()->id;
                    $puzzleCollectHistory->amount = $amount;
                    $puzzleCollectHistory->qty = $request->qty;
                    $puzzleCollectHistory->save();

                    return response()->json([
                        'user' => auth('api')->user(),
                        'puzzle' => $puzzle,
                        'puzzleCollects' => $puzzleCollects,
                        'puzzleCollectHistorys' => $puzzleCollectHistorys,
                        'puzzlePieceCollectHistorys' => $puzzlePieceCollectHistorys,
                        'message' => 'Successfully'
                    ], 200);

                }else{
                    return response()->json(['message' => 'TTG Balance not enough!'], 404);
                }


            }else{
                return response()->json(['message' => 'Puzzle Not Completed!'], 404);
            }
        }else{
            return response()->json(['message' => 'Puzzle Not Found!'], 404);
        }

    }


        /**
     *  @group  Collection
     *
    *  Puzzle Piece Index
    * get data pieece yang di collection
    *
    * @response {
    *  "puzzles": "get query puzzle",
    *  "puzzleCollects": "get query puzzleCollect",
    *  "puzzleCollectHistorys": "get query puzzleCollect"
    * }
    */


    public function puzzlePieceCollect_index()
    {
        $puzzlePieces = puzzlePiece::all();
        $puzzlePieceCollects = puzzlePieceCollect::orderby('id', 'desc')->where('user_id',auth('api')->user()->id)->get();
        $puzzlePieceCollectHistorys = puzzlePieceCollectHistory::orderby('id', 'desc')->where('user_id',auth('api')->user()->id)->get();
        $puzzlePiecePieceCollectHistorys = puzzlePiecePieceCollectHistory::orderby('id', 'desc')->where('user_id',auth('api')->user()->id)->get();

        return response()->json([
            'puzzlePieces' => $puzzlePieces,
            'puzzlePieceCollects' => $puzzlePieceCollects,
            'puzzlePieceCollectHistorys' => $puzzlePieceCollectHistorys
        ], 200);

    }



     /**
     *  @group  Collection
     *
    *  Puzzle Piece Store
    * collect pize puzzle dari get collection
    *
    * @bodyParam  puzzle_piece_id int required
    *
    * @response {
   *  "user": "update query user",
    *  "puzzlePiece": "show query puzzlePiece",
    *  "puzzlePieceCollect": "store or update qty puzzlePieceCollect",
    *  "puzzlePieceCollectHistory": "store query puzzlePieceCollectHistory"
    * }
    */
    public function puzzlePieceCollect_store(Request $request)
    {

        $puzzlePiece = puzzlePiece::find($request->puzzle_piece_id);
        if($puzzlePiece){
            if(auth('api')->user()->energy >= $puzzlePiece->energy){

                auth('api')->user()->energy = auth('api')->user()->energy - $puzzlePiece->energy;
                auth('api')->user()->save();

                $puzzlePieceCollect = puzzlePieceCollect::where('user_id', auth('api')->user()->id)->where('puzzle_piece_id', $puzzlePiece->id)->first();
                if($puzzlePieceCollect){
                    $puzzlePieceCollect->qty = $puzzlePieceCollect->qty + 1;
                    $puzzlePieceCollect->save();
                }else{
                    $puzzlePieceCollect = new puzzlePieceCollect;
                    $puzzlePieceCollect->user_id = auth('api')->user()->id;
                    $puzzlePieceCollect->puzzle_piece_id = $puzzlePiece->id;
                    $puzzlePieceCollect->qty = 1;
                    $puzzlePieceCollect->save();
                }

                $puzzlePieceCollectHistory = new puzzlePieceCollectHistory;
                $puzzlePieceCollectHistory->puzzle_piece_id = $puzzlePiece->id;
                $puzzlePieceCollectHistory->puzzle_piece_collect_id = $puzzlePieceCollect->id;
                $puzzlePieceCollectHistory->user_id = auth('api')->user()->id;
                $puzzlePieceCollectHistory->amount = $puzzlePiece->amount;
                $puzzlePieceCollectHistory->energy = $puzzlePiece->energy;
                $puzzlePieceCollectHistory->save();

                return response()->json([
                    'user' => auth('api')->user(),
                    'puzzlePieceCollect' => $puzzlePieceCollect,
                    'puzzlePieceCollectHistory' => $puzzlePieceCollectHistory,
                    'message' => 'Successfully'
                ], 200);

            }else{
                return response()->json(['message' => 'Energy not enough!'], 404);
            }
        }

    }

    /**
     *  @group  Mall
     *
    *  Puzzle Piece Buys Index
    *
    * @response {
    *  "puzzlePieceBuys": "list item user buy puzzle piece another user in mall",
    *  "puzzlePieceSellBuys": "List item user sell puzzle in purchase another user"
    * }
    */

    public function puzzlePieceBuy_index()
    {
        $puzzlePieceBuys = puzzlePieceBuy::orderby('id', 'desc')->where('user_id', auth('api')->user()->id)->paginate(5);
        $puzzlePieceSellBuys = puzzlePieceBuy::orderby('id', 'desc')->where('seller_id', auth('api')->user()->id)->paginate(5);
        return response()->json([
            'puzzlePieceBuys' => $puzzlePieceBuys,
            'puzzlePieceSellBuys' => $puzzlePieceSellBuys
        ], 200);
    }



    /**
     *  @group  Mall
     *
    *  Puzzle Piece Buy store
    * Buy piece puzzle in mall
    *
    * @bodyParam  puzzle_piece_sell_id int required
    * @bodyParam  qty int required
    *
    * @response {
   *  "user": "update coin_ttg user",
    *  "puzzlePieceCollect": "update puzzlePieceCollect",
    *  "seller": "show query seller",
    *  "puzzlePieceSell": "store or update puzzlePieceSell",
    *  "puzzlePieceBuy": "store query puzzlePieceBuy"
    * }
    */

    public function puzzlePieceBuy_store(Request $request)
    {
        $request->validate([
            'qty' => ['required','numeric','min:1'],
        ]);

        $puzzlePieceSell = puzzlePieceSell::where('id', $request->puzzle_piece_sell_id)->where('user_id','!=', auth('api')->user()->id)->first();


      if($puzzlePieceSell){
        if($puzzlePieceSell->qty >= $request->qty){
            $amount = $puzzlePieceSell->amount * $request->qty;
            if(auth('api')->user()->coin_ttg >= $amount){

                auth('api')->user()->coin_ttg = auth('api')->user()->coin_ttg - $amount;
                auth('api')->user()->save();

                $puzzlePieceCollect = puzzlePieceCollect::where('user_id', auth('api')->user()->id)->where('puzzle_piece_id', $puzzlePieceSell->puzzle_piece_id)->first();
                if($puzzlePieceCollect){
                    $puzzlePieceCollect->qty = $puzzlePieceCollect->qty + $request->qty;
                    $puzzlePieceCollect->save();
                }else{
                    $puzzlePieceCollect = new puzzlePieceCollect;
                    $puzzlePieceCollect->user_id = auth('api')->user()->id;
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
                $puzzlePieceBuy->user_id = auth('api')->user()->id;
                $puzzlePieceBuy->seller_id = $seller->id;
                $puzzlePieceBuy->puzzle_piece_sell_id = $puzzlePieceSell->id;
                $puzzlePieceBuy->qty = $request->qty;
                $puzzlePieceBuy->amount = $puzzlePieceSell->amount;
                $puzzlePieceBuy->save();

                return response()->json([
                    'user' => auth('api')->user(),
                    'puzzlePieceCollect' => $puzzlePieceCollect,
                    'seller' => $seller,
                    'puzzlePieceSell' => $puzzlePieceSell,
                    'puzzlePieceBuy' => $puzzlePieceBuy,
                    'message' => 'Successfully'
                ], 200);

            }else{
                return response()->json(['message' => 'TTG balance not enough!'], 404);
            }

        }else{
            return response()->json(['message' => 'Out of stock!'], 404);
        }
      }else{
        return response()->json(['message' => 'Puzzle not found!'], 404);
    }

    }


/**
     *  @group  Mall
     *
    *  Puzzle Piece Sells Index
    *
    * @response {
    *  "puzzlePieceSells": "list item user Sell puzzle piece in mall",
    *  "pieces": "List item in mall"
    * }
    */
    public function puzzlePieceSell_index()
    {
        $puzzlePieceSells = puzzlePieceSell::orderby('id', 'desc')->where('user_id', auth('api')->user()->id)->paginate(5);
        $pieces = puzzlePieceSell::orderby('id', 'desc')->where('qty', '>', 0)->paginate(5);
        return response()->json([
            'puzzlePieceSells' => $puzzlePieceSells,
            'pieces' => $pieces
        ], 200);
    }

    /**
     *  @group  Mall
     *
    *  Puzzle Piece Sells Store
    *
    * @bodyParam  puzzle_piece_collect_id int required
    * @bodyParam  amount double required
    * @bodyParam  qty int required
    *
    * @response {
   *  "user": "update query user",
    *  "puzzlePieceCollect": "update query puzzlePieceCollect",
    *  "puzzlePieceSell": "store query puzzlePieceSell"
    * }
    */
    public function puzzlePieceSell_store(Request $request)
    {
        $request->validate([
            'amount' => ['required','numeric'],
        ]);



        $puzzlePieceCollect = puzzlePieceCollect::find($request->puzzle_piece_collect_id);
        if($puzzlePieceCollect){
            if($puzzlePieceCollect->qty >= $request->qty){

                $puzzlePieceCollect->qty = $puzzlePieceCollect->qty - $request->qty;
                $puzzlePieceCollect->save();

                $puzzlePieceSell = new puzzlePieceSell;
                $puzzlePieceSell->puzzle_piece_id = $puzzlePieceCollect->puzzle_piece_id;
                $puzzlePieceSell->puzzle_piece_collect_id = $puzzlePieceCollect->id;
                $puzzlePieceSell->user_id = auth('api')->user()->id;
                $puzzlePieceSell->qty = $request->qty;
                $puzzlePieceSell->amount = $request->amount;
                $puzzlePieceSell->save();

                return response()->json([
                    'user' => auth('api')->user(),
                    'puzzlePieceCollect' => $puzzlePieceCollect,
                    'puzzlePieceSell' => $puzzlePieceSell,
                    'message' => 'Successfully'
                ], 200);

            }else{
                return response()->json(['message' => 'Out of stock!'], 404);
            }
        }
    }



        /**
     *  @group  Claim
     *
    *  Puzzle Claim Index
    *
    * @bodyParam  amount double required
    * @bodyParam  qty int required
    *
    * @response {
    *  "puzzlePieceClaims": "update query puzzlePieceClaims"
    * }
    */
    public function puzzleClaim_index()
    {
        $puzzlePieceClaims = puzzlePieceClaim::orderby('id', 'desc')->where('user_id',auth('api')->user()->id)->get();
        return response()->json([
            'puzzlePieceClaims' => $puzzlePieceClaims,
            'message' => 'Successfully'
        ], 200);
    }

        /**
     *  @group  Claim
     *
    *  Puzzle Claim Store
    *
    * @bodyParam  puzzle_collect_id int required
    * @bodyParam  recipient_name string required
    * @bodyParam  recipient_phone string required
    * @bodyParam  recipient_address string required
    * @bodyParam  note string required
    * @bodyParam  qty int required
    *
    * @response {
    *  "user": "update coin_ttg user",
    *  "puzzleCollect": "update qty puzzleCollect",
    *  "puzzleClaim": "store query puzzleClaim",
     *  "message": "Successfully"
    * }
    */
    public function puzzleClaim_store(Request $request)
    {
        $puzzleCollect = puzzleCollect::find($request->puzzle_collect_id);

        if($puzzleCollect){
            $puzzle = puzzle::find($puzzleCollect->puzzle_id);
            if($puzzleCollect->qty >= $request->qty){
                  $amount = $puzzle->amount * $request->qty;
               if(auth('api')->user()->coin_ttg >= $amount){

                auth('api')->user()->coin_ttg = auth('api')->user()->coin_ttg - $amount;
                auth('api')->user()->save();

                $puzzleCollect->qty = $puzzleCollect->qty - $request->qty;
                $puzzleCollect->save();

                $puzzleClaim = new puzzleClaim;
                $puzzleClaim->user_id = auth('api')->user()->id;
                $puzzleClaim->puzzle_id = $puzzle->id;
                $puzzleClaim->puzzle_collect_id = $puzzleCollect->id;
                $puzzleClaim->recipient_name = $request->recipient_name;
                $puzzleClaim->recipient_phone = $request->recipient_phone;
                $puzzleClaim->recipient_address = $request->recipient_address;
                $puzzleClaim->qty = $request->qty;
                $puzzleClaim->amount = $amount;
                $puzzleClaim->save();

                return response()->json([
                    'user' => auth('api')->user(),
                    'puzzleCollect' => $puzzleCollect,
                    'puzzleClaim' => $puzzleClaim,
                    'message' => 'Successfully'
                ], 200);
               }else{
                return response()->json(['message' => 'TTG Balance not enough'], 404);
                }

            }else{
                return response()->json(['message' => 'Out of stock!'], 404);
            }
        }else{
            return response()->json(['message' => 'Puzzle Collection not found!'], 404);
        }

    }


       /**
     *
    *  General
    * General setting tax, charge, logo, etc.
    *
    * @response {
    *"general": {
    *    "id": 1,
    *    "title": "ARGS",
    *    "description": null,
     *   "favicon": null,
     *   "logo_sm": "1619525299logo_sm.png",
     *   "logo_light": "1619462486logo_light.png",
     *   "logo_dark": "1619462486logo_dark.png",
     *   "coin_gast": "coin_gast.svg",
     *   "coin_ttg": "coin_ttg.svg",
     *   "coin_args": "coin_args.svg",
     *   "transfer_tax": 0,
     *   "transfer_ttg": 0.01,
     *   "topUp_tax": 0,
     *   "payout_tax": 0,
     *   "energy_exchange": 10,
     *   "energy_exchange_coin_gast": 10,
     *   "boost_percentage": 1,
     *   "created_at": "2020-11-15 19:08:50",
     *   "updated_at": "2021-04-27 19:08:19"
    *},
    *"message": "Successfully"
    * }
    */
    public function general()
    {
        $general = general::first();
        return response()->json([
            'general' => $general,
            'message' => 'Successfully'
        ], 200);
    }


}
