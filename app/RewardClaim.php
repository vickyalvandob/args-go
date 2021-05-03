<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RewardClaim extends Model
{
    function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }


    function reward(){
        return $this->belongsTo('App\Reward', 'reward_id', 'id');
    }
}
