<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AntagonistAttack extends Model
{
    function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    function antagonist(){
        return $this->belongsTo('App\Antagonist', 'antagonist_id', 'id');
    }
}
