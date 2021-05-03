<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RewardCollectHistory extends Model
{
    function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }


    function reward(){
        return $this->belongsTo('App\Reward', 'reward_id', 'id');
    }

    function rewardCollect(){
        return $this->belongsTo('App\RewardCollect', 'reward_collect_id', 'id');
    }
}
