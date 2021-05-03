@extends('multiauth::layouts.app')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="text-center mb-3">
            <a href="{{ route('admin.coinCollect.index') }}" class="btn  @if(Request::is('admin/coinCollect') || Request::is('admin/coinCollect/*')) btn-primary @else btn-outline-primary @endif btn-rounded m-1 px-3">COIN GAST</a>
            <a href="{{ route('admin.puzzleCollect.index') }}" class="btn @if(Request::is('admin/puzzleCollect') || Request::is('admin/puzzleCollect/*')) btn-primary @else btn-outline-primary @endif btn-rounded m-1 px-3">Puzzle</a>
            <a href="{{ route('admin.rewardCollect.index') }}" class="btn  @if(Request::is('admin/rewardCollect') || Request::is('admin/rewardCollect/*')) btn-primary @else btn-outline-primary @endif btn-rounded m-1 px-3">Reward</a>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card-box">
            <h4 class="header-title">
             Puzzle
            </h4>
            <br>
            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead>
                    <thead>
                        <tr class="text-uppercase">
                            <th class="text-center align-middle">Date / Time</th>
                            <th class="text-center align-middle">Username</th>
                            <th class="text-center align-middle">Puzzle</th>
                            <th class="text-center align-middle">Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($puzzleCollectHistorys as $puzzleCollectHistory)
                        <tr>
                            <td class="text-center align-middle">{{ $puzzleCollectHistory->created_at ?? "-" }}</td>

                            <td class="text-center align-middle">{{ $puzzleCollectHistory->user->username ?? "-" }}</td>
                            <td class="text-center align-middle">
                                  <img src="{{ asset('img/'.$puzzleCollectHistory->puzzle->image.'') }}" height="25" alt="">
                            </td>
                            <td class="text-center align-middle">{{ number_format($puzzleCollectHistory->qty) ?? "-" }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <div class="col-md-6">


        <div class="card-box">
            <h4 class="header-title">
                Piece
            </h4>
            <br>
            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead>
                        <tr class="text-uppercase">
                            <th class="text-center align-middle">Date / Time</th>
                            <th class="text-center align-middle">Username</th>
                            <th class="text-center align-middle">Piece</th>
                            <th class="text-center align-middle">Amount</th>
                            <th class="text-center align-middle">Energy</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($puzzlePieceCollectHistorys as $puzzlePieceCollectHistory)
                        <tr>
                            <td class="text-center align-middle">{{ $puzzlePieceCollectHistory->created_at ?? "-" }}</td>
                            <td class="text-center align-middle">{{ $puzzleCollectHistory->user->username ?? "-" }}</td>
                            <td class="text-center align-middle">
                                  <img src="{{ asset('img/'.$puzzlePieceCollectHistory->puzzlePiece->image.'') }}" height="25" alt="">
                            </td>
                            <td class="text-center align-middle">{{ number_format($puzzlePieceCollectHistory->amount , 2, ',', '.') ?? "-" }}</td>
                            <td class="text-center align-middle">{{ number_format($puzzlePieceCollectHistory->energy , 2, ',', '.') ?? "-" }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
               </div>

        </div>
    </div>
</div>


@endsection
