@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-md-4 text-center">
        <div class="card">
            <div class="card-header">
                <h4>Coin</h4>
            </div>
            <div class="card-body">
                @if ($coin->image == null)
                <img src="{{ asset('img/default.png') }}" class="img-fluid" alt="">
                @else
                <img src="{{ asset('img/'.$coin->image.'') }}" class="img-fluid" alt="">
                @endif
            </div>
            <div class="card-footer">
                <h4>{{ $coin->amount }} <small>GAST</small></h4>
                <a href="#" onclick="confirm1Tag({{ $coin->id }})" class="m-1 btn btn-primary btn-block">collect</a>
                <form id="confirm1-form-{{ $coin->id }}" action="{{ route('user.coinCollect.store') }}" method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="coin_id" value="{{ $coin->id }}">
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4 text-center">
        <div class="card">
            <div class="card-header">
                <h4>Puzzle Piece</h4>
            </div>
            <div class="card-body">
                @if ($puzzlePiece->image == null)
                <img src="{{ asset('img/default.png') }}" class="img-fluid" alt="">
                @else
                <img src="{{ asset('img/'.$puzzlePiece->image.'') }}" class="img-fluid" alt="">
                @endif

            </div>
            <div class="card-footer">
                <h4>{{ $puzzlePiece->title }}</h4>
                <a href="#" onclick="confirm2Tag({{ $puzzlePiece->id }})" class="m-1 btn btn-primary btn-block">collect</a>
                <form id="confirm2-form-{{ $puzzlePiece->id }}" action="{{ route('user.puzzlePieceCollect.store') }}" method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="puzzle_piece_id" value="{{ $puzzlePiece->id }}">
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4 text-center">
        <div class="card">
            <div class="card-header">
                <h4>Reward</h4>
            </div>
            <div class="card-body">
                @if ($reward->image == null)
                <img src="{{ asset('img/default.png') }}" class="img-fluid" alt="">
                @else
                <img src="{{ asset('img/'.$reward->image.'') }}" class="img-fluid" alt="">
                @endif

            </div>
            <div class="card-footer">
                <h4>{{ $reward->title }}</h4>
                <a href="#" onclick="confirm3Tag({{ $reward->id }})" class="m-1 btn btn-primary btn-block">collect</a>
                <form id="confirm3-form-{{ $reward->id }}" action="{{ route('user.rewardCollect.store') }}" method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="reward_id" value="{{ $reward->id }}">
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
