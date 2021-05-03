<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PuzzlePieceBuy extends Model
{
    function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    function purchaser(){
        return $this->belongsTo('App\User', 'purchaser_id', 'id');
    }

    function puzzlePiece(){
        return $this->belongsTo('App\PuzzlePiece', 'puzzle_piece_id', 'id');
    }
}
