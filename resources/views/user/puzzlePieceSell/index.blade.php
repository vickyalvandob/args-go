@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card-box text-center" style="background: none!important">
            <h3 class="img-shadow"><i class="mdi mdi-shopping mr-1"></i> MALL</h3>
            <div class="mb-2">
                <a href="{{ route('user.puzzlePieceSell.index') }}" class="btn @if(Request::is('user/puzzlePieceSell') || Request::is('user/puzzlePieceSell/*')) btn-primary @else btn-outline-primary @endif btn-rounded m-1 px-3">Puzzle</a>
                <a href="{{ route('user.rewardSell.index') }}" class="btn  @if(Request::is('user/rewardSell') || Request::is('user/rewardSell/*')) btn-primary @else btn-outline-primary @endif btn-rounded m-1 px-3">Reward</a>
                <a href="{{ route('user.weapon.index') }}" class="btn  @if(Request::is('user/weapon') || Request::is('user/weapon/*')) btn-primary @else btn-outline-primary @endif btn-rounded m-1 px-3">weapon</a>
            </div>
        </div>

        <div class="row mx-md-4 justify-content-center">
            @if (count($pieces) > 0)
            @foreach ($pieces as $piece)
            <div class="col-md-4">
                <div class="card-box">
                      <img src="{{ asset('img/'.$piece->user->image.'') }}" height="40" width="40" alt="user-image" class="rounded-circle mr-1"> {{ $piece->user->name }}
                    <br>
                    <div class="row my-3 text-center">
                        <div class="col-md-6">
                            <img src="{{ asset('img/'.$piece->puzzlePiece->image.'') }}" class="img-fluid img-shadow" alt="" style="max-height: 80px">
                        </div>
                        <div class="col-md-6">
                            <h4 class="mb-0 mt-2">{{ number_format($piece->amount , 2, ',', '.') ?? "-" }} <small>TTG</small></h4>
                            <p>  {{ number_format($piece->qty) ?? "-" }} <small><i class="mdi mdi-puzzle"></i></small></p>

                        </div>
                    </div>
                    @if ($piece->user_id != Auth::user()->id)
                    <button type="button" data-toggle="modal" data-target="#buy{{ $piece->id }}" class="btn btn-primary btn-rounded btn-block">BUY</button>
                    @else
                    <button type="button" disabled class="text-white btn btn-link btn-rounded btn-block">Your Piece</button>
                    @endif
                    <!-- Modal -->
                    <div class="modal fade" id="buy{{ $piece->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-body w3-round-xlarge">
                                    <div class="row my-3 text-center card-box m-2">
                                        <div class="col-md-6">
                                            <img src="{{ asset('img/'.$piece->puzzlePiece->image.'') }}" class="img-fluid img-shadow" alt="" style="max-height: 80px">
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{ $piece->puzzlePiece->title }}</p>
                                            <h4 class="mb-0 mt-2">{{ number_format($piece->amount , 2, ',', '.') ?? "-" }}</h4>
                                            <p>  {{ number_format($piece->qty) ?? "-" }} <i class="mdi mdi-puzzle"></i></p>

                                        </div>
                                    </div>
                                    <form id="confirm1-form-{{ $piece->id }}" action="{{ route('user.puzzlePieceBuy.store') }}" enctype="multipart/form-data" class="text-capitalize " method="post">
                                        @csrf
                                        <input type="hidden" name="puzzle_piece_sell_id" value="{{ $piece->id }}">
                                        <div class="row text-uppercase">
                                            <div class="form-group col-md-12">
                                                <label class="control-label mb-10">qty</label>
                                                <input type="number" min="1" required class="form-control" name="qty" placeholder="Qty">
                                            </div>
                                            <div class="form-group col-md-12">
                                            <button type="button" onclick="confirm1Tag({{ $piece->id }})" class="btn btn-primary w3-round-xlarge my-1 btn-block">BUY</button>
                                            </div>
                                        </div>
                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @endforeach
            <div class="col-md-12">
                <div class="pull-right clearfix">
                    {{ $pieces->links('pagination::bootstrap-4') }}
                </div>
            </div>
            @else
            <div class="col-md-12">
                <h4 class="text-center">No Available</h4>
            </div>
            @endif
        </div>

    </div>
</div>


@endsection
