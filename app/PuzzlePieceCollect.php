<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PuzzlePieceCollect extends Model
{
    function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }


    function puzzle(){
        return $this->belongsTo('App\Puzzle', 'puzzle_id', 'id');
    }

    function puzzlePiece(){
        return $this->belongsTo('App\PuzzlePiece', 'puzzle_piece_id', 'id');
    }
}
