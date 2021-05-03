<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PuzzleCollect extends Model
{
    function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    function puzzle(){
        return $this->belongsTo('App\Puzzle', 'puzzle_id', 'id');
    }
}
