<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PuzzlePieceCollectHistory extends Model
{
    function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }


    function puzzlePieceCollect(){
        return $this->belongsTo('App\puzzlePieceCollect', 'puzzle_piece_collect_id', 'id');
    }

    function puzzlePiece(){
        return $this->belongsTo('App\PuzzlePiece', 'puzzle_piece_id', 'id');
    }
}
