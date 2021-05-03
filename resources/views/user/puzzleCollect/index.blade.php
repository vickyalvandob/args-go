@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="text-center mb-3">
            <a href="{{ route('user.coinCollect.index') }}" class="btn  @if(Request::is('user/coinCollect') || Request::is('user/coinCollect/*')) btn-primary @else btn-outline-primary @endif btn-rounded m-1 px-3">COIN GAST</a>
            <a href="{{ route('user.puzzleCollect.index') }}" class="btn @if(Request::is('user/puzzleCollect') || Request::is('user/puzzleCollect/*')) btn-primary @else btn-outline-primary @endif btn-rounded m-1 px-3">Puzzle</a>
            <a href="{{ route('user.rewardCollect.index') }}" class="btn  @if(Request::is('user/rewardCollect') || Request::is('user/rewardCollect/*')) btn-primary @else btn-outline-primary @endif btn-rounded m-1 px-3">Reward</a>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card-box bg-main">
            <div id="carouselId" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" role="listbox">

                    @foreach ($puzzles as $puzzle)
                    <div class="carousel-item py-3 @if ($loop->iteration == 1) active @endif">
                        <h4 class="text-white mt-0 mb-3 text-center">
                            {{ $puzzle->title }}
                        </h4>
                        <div class="card-box">

                            @php
                               $puzzlePieces = \App\PuzzlePiece::where('puzzle_id', $puzzle->id)->get();
                            @endphp
                            <div class="row text-center">
                               @if ($puzzle->pieces == 12)
                                @foreach ($puzzlePieces as $puzzlePiece)
                                    @php
                                    $puzzlePieceCollect = \App\PuzzlePieceCollect::where('puzzle_piece_id', $puzzlePiece->id)->where('user_id', Auth::user()->id)->first();
                                    @endphp
                                    <div class="col-md-3 p-1">
                                    @if ($puzzlePieceCollect)

                                        @if ($puzzlePieceCollect->qty > 0)
                                        <img src="{{ asset('img/'.$puzzlePiece->image.'') }}" class="img-fluid img-shadow" alt="">
                                        <div class="w3-display-topright">
                                            <span class="badge badge-light">{{ $puzzlePieceCollect->qty }}x</span>
                                        </div>
                                        @else
                                        <img src="{{ asset('img/default.png') }}" class="img-fluid" alt="">
                                        @endif
                                        @else
                                        <img src="{{ asset('img/default.png') }}" class="img-fluid" alt="">
                                        @endif
                                    <p></p>
                                    </div>
                                @endforeach
                                @elseif ($puzzle->pieces == 16)
                                    @foreach ($puzzlePieces as $puzzlePiece)
                                        @php
                                        $puzzlePieceCollect = \App\PuzzlePieceCollect::where('puzzle_piece_id', $puzzlePiece->id)->where('user_id', Auth::user()->id)->first();
                                        @endphp
                                        <div class="col-md-3 p-1">
                                            @if ($puzzlePieceCollect)

                                        @if ($puzzlePieceCollect->qty > 0)


                                            <img src="{{ asset('img/'.$puzzlePiece->image.'') }}" class="img-fluid img-shadow" alt="">
                                            <div class="w3-display-topright">
                                                <span class="badge badge-light">{{ $puzzlePieceCollect->qty }}x</span>
                                            </div>
                                            @else
                                            <img src="{{ asset('img/default.png') }}" class="img-fluid" alt="">
                                            @endif
                                            @else
                                        <img src="{{ asset('img/default.png') }}" class="img-fluid" alt="">
                                        @endif
                                        </div>
                                    @endforeach
                               @endif
                            </div>
                        </div>
                        @php
                        $puzzleCollect = \App\PuzzleCollect::where('puzzle_id', $puzzle->id)->where('user_id', Auth::user()->id)->first();
                        $puzzlePieceCollects = \App\PuzzlePieceCollect::where('puzzle_id', $puzzle->id)->where('user_id', Auth::user()->id)->where('qty', '>', 0)->get();
                        @endphp
                        <div class="mt-2">
                            <div class="row">
                               @if ($puzzleCollect)
                               <div class="col-md-12">
                                <div class="card-box text-center">
                                    <h4 class="mb-0">
                                        {{ number_format($puzzleCollect->qty) }}  Puzzle

                                    </h4>
                                    <small> {{ $puzzlePieceCollects->sum('qty') }} <i class="mdi mdi-puzzle"> </i></small>

                                </div>
                                </div>
                               @endif
                                <div class="col-md-6">
                                    <button type="button" @if (count($puzzlePieceCollects) > 0)  data-toggle="modal" data-target="#sell{{ $puzzle->id }}" @else    disabled  @endif   class="btn btn-primary btn-block w3-round-xlarge img-shadow">SELL</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" data-toggle="modal" data-target="#combine{{ $puzzle->id }}"  @if ( $puzzle->pieces  !=  count($puzzlePieceCollects))  disabled @endif class="btn btn-success btn-block w3-round-xlarge img-shadow" >
                                       combine @if ( $puzzle->pieces  ==  count($puzzlePieceCollects))  @if ($puzzlePieceCollects->min('qty') > 0)
                                           <span class="badge badge-light">{{ $puzzlePieceCollects->min('qty') }}</span>
                                       @endif @endif
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>

                    <style>

                    </style>
                    <!-- Modal -->
                    <div class="modal fade" id="sell{{ $puzzle->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-body w3-round-xlarge">
                                    <form action="{{ route('user.puzzlePieceSell.store') }}" enctype="multipart/form-data" class="text-capitalize " method="post">
                                        @csrf

                                        <div class="row text-uppercase">
                                            <div class="form-group col-md-6">
                                                <label>pieces</label>
                                                <select class="form-control" name="puzzle_piece_collect_id" required style="width:100%" data-toggle="select2">
                                                    <option value="">Select</option>
                                                    @foreach($puzzlePieceCollects as $puzzlePieceCollect)
                                                    <option value="{{ $puzzlePieceCollect->id }}"> {{ $puzzlePieceCollect->puzzlePiece->title }} | Qty. {{ $puzzlePieceCollect->qty }}x </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="control-label mb-10">qty</label>
                                                <input type="number" min="1" required class="form-control" name="qty" placeholder="Qty">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="control-label mb-10">amount</label>
                                                <input type="text" class="form-control" required name="amount" placeholder="Amount">
                                            </div>
                                            <div class="form-group col-md-12">
                                            <button type="submit" class="btn btn-primary w3-round-xlarge my-1 btn-block">SELL</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Modal -->
                    <div class="modal fade" id="combine{{ $puzzle->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-body w3-round-xlarge">
                                    <form action="{{ route('user.puzzleCollect.store') }}" enctype="multipart/form-data" class="text-capitalize " method="post">
                                        @csrf
                                        <input type="hidden" name="puzzle_id" value="{{ $puzzle->id }}">
                                        <div class="row text-uppercase">
                                            <div class="form-group col-md-12">
                                                <label class="control-label mb-10">qty</label>
                                                <input type="number" min="1" required class="form-control" name="qty" placeholder="Qty">
                                            </div>
                                            <div class="form-group col-md-12">
                                            <button type="submit" class="btn btn-primary w3-round-xlarge my-1 btn-block">COMBINE</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach
                    <a class="carousel-control-prev" href="#carouselId" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselId" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-7">

        <div class="card-box">
            <h4 class="header-title">
                History
            </h4>
            <br>
            <div class="table-responsive">
                <table class="table table-borderless table-striped">
                    <thead>
                        <tr class="text-uppercase">
                            <th class="text-center align-middle">Date/Time</th>
                            <th class="text-center align-middle">Piece</th>
                            <th class="text-center align-middle">Amount</th>
                            <th class="text-center align-middle">Energy</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($puzzlePieceCollectHistorys as $puzzlePieceCollectHistory)
                        <tr>
                            <td class="text-center align-middle">{{ $puzzlePieceCollectHistory->created_at->format("H:i, d F Y") ?? "-" }}</td>
                            <td class="text-center align-middle">
                                  <img src="{{ asset('img/'.$puzzlePieceCollectHistory->puzzlePiece->image.'') }}" height="25" alt="">
                            </td>
                            <td class="text-center align-middle">{{ number_format($puzzlePieceCollectHistory->amount , 2, ',', '.') ?? "-" }}</td>
                            <td class="text-center align-middle">{{ number_format($puzzlePieceCollectHistory->energy , 2, ',', '.') ?? "-" }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pull-right clearfix">
                    {{ $puzzlePieceCollectHistorys->links('pagination::bootstrap-4') }}
                </div>
               </div>

        </div>
        <div class="card-box">
            <h4 class="header-title">
             Combine
            </h4>
            <br>
            <div class="table-responsive">
                <table class="table table-borderless table-striped">
                    <thead>
                    <thead>
                        <tr class="text-uppercase">
                            <th class="text-center align-middle">Date/Time</th>
                            <th class="text-center align-middle">Puzzle</th>
                            <th class="text-center align-middle">Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($puzzleCollectHistorys as $puzzleCollectHistory)
                        <tr>
                            <td class="text-center align-middle">{{ $puzzleCollectHistory->created_at->format("H:i, d F Y") ?? "-" }}</td>
                            <td class="text-center align-middle">
                                  <img src="{{ asset('img/'.$puzzleCollectHistory->puzzle->image.'') }}" height="25" alt="">
                            </td>
                            <td class="text-center align-middle">{{ number_format($puzzleCollectHistory->qty) ?? "-" }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pull-right clearfix">
                    {{ $puzzleCollectHistorys->links('pagination::bootstrap-4') }}
                </div>
            </div>

        </div>

    </div>
</div>


@endsection
