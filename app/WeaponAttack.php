<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WeaponAttack extends Model
{
    function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    function weapon(){
        return $this->belongsTo('App\Weapon', 'weapon_id', 'id');
    }

    function antagonist(){
        return $this->belongsTo('App\Antagonist', 'antagonist_id', 'id');
    }

}
