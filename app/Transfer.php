<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

     function recipient(){
        return $this->belongsTo('App\User', 'recipient_id', 'id');
    }
}
