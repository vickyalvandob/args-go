<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PuzzleCollectHistory extends Model
{
    function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    function puzzle(){
        return $this->belongsTo('App\Puzzle', 'puzzle_id', 'id');
    }

    function puzzleCollect(){
        return $this->belongsTo('App\PuzzleCollect', 'puzzle_collect_id', 'id');
    }
}
