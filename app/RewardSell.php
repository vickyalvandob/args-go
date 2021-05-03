<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RewardSell extends Model
{
    function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    function puchaser(){
        return $this->belongsTo('App\User', 'puchaser_id', 'id');
    }

    function reward(){
        return $this->belongsTo('App\Reward', 'reward_id', 'id');
    }
}
