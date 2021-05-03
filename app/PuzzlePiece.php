<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PuzzlePiece extends Model
{

    function puzzle(){
        return $this->belongsTo('App\Puzzle', 'puzzle_id', 'id');
    }
}
