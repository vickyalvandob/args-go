<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WeaponCollect extends Model
{
    function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }


    function weapon(){
        return $this->belongsTo('App\Weapon', 'weapon_id', 'id');
    }
}
