<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weapon extends Model
{
    function antagonist(){
        return $this->belongsTo('App\Antagonist', 'antagonist_id', 'id');
    }
}
