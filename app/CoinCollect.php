<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoinCollect extends Model
{
    function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }


    function coin(){
        return $this->belongsTo('App\Coin', 'coin_id', 'id');
    }
}
