@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card-box text-center" style="background: none!important">
            <h3 class="img-shadow"><i class="mdi mdi-shopping mr-1"></i> MALL</h3>
            <div class="mb-2">
                <a href="{{ route('user.puzzlePieceSell.index') }}" class="btn @if(Request::is('user/puzzlePieceSell') || Request::is('user/puzzlePieceSell/*')) btn-primary @else btn-outline-primary @endif btn-rounded m-1 px-3">Puzzle</a>
                <a href="{{ route('user.rewardSell.index') }}" class="btn  @if(Request::is('user/rewardSell') || Request::is('user/rewardSell/*')) btn-primary @else btn-outline-primary @endif btn-rounded m-1 px-3">reward</a>
                <a href="{{ route('user.weapon.index') }}" class="btn  @if(Request::is('user/weapon') || Request::is('user/weapon/*')) btn-primary @else btn-outline-primary @endif btn-rounded m-1 px-3">weapon</a>
            </div>
        </div>
        <div class="row mx-md-4 justify-content-center">
            @if (count($weapons) > 0)
            @foreach ($weapons as $weapon)
            <div class="col-md-4">
                <div class="card-box text-center">

                    <p>{{ $weapon->title }}</p>

                    <div class="my-3">
                        <img src="{{ asset('img/'.$weapon->image.'') }}" class="img-fluid img-shadow mb-0" alt="" style="max-height: 80px">
                        <div class="mt-n2">
                            @if ($weapon->antagonist_id != null)
                            <span class="badge badge-light text-primary ">{{ $weapon->antagonist->title ?? "-" }}</span>
                            @else
                            <span class="badge badge-light text-primary ">All</span>
                            @endif
                        </div>
                    </div>


                    <h3>{{ number_format($weapon->amount , 2, ',', '.') ?? "-" }} <small>TTG</small></h3>

                    <button type="button" data-toggle="modal" data-target="#buy{{ $weapon->id }}" class="btn btn-primary btn-rounded btn-block">BUY</button>

                    <!-- Modal -->
                    <div class="modal fade" id="buy{{ $weapon->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-body w3-round-xlarge">
                                    <div class="my-3 text-center card-box">
                                            <img src="{{ asset('img/'.$weapon->image.'') }}" class="img-fluid img-shadow" alt="" style="max-height: 80px">
                                            <p class="mt-1">{{ $weapon->title }}</p>
                                            <h4 class="mb-1 mt-2">{{ number_format($weapon->amount , 2, ',', '.') ?? "-" }}</h4>
                                            @if ($weapon->antagonist_id != null)
                                                <span class="badge badge-light">{{ $weapon->antagonist->title ?? "-" }}</span>
                                            @else
                                            <span class="badge badge-light">All</span>
                                            @endif
                                    </div>
                                    <form id="confirm1-form-{{ $weapon->id }}" action="{{ route('user.weaponBuy.store') }}" enctype="multipart/form-data" class="text-capitalize " method="post">
                                        @csrf
                                        <input type="hidden" name="weapon_id" value="{{ $weapon->id }}">
                                        <div class="row text-uppercase text-left">
                                            <div class="form-group col-md-12">
                                                <label class="control-label mb-10">qty</label>
                                                <input type="number" min="1" required class="form-control" name="qty" placeholder="Qty">
                                            </div>
                                            <div class="form-group col-md-12">
                                            <button type="button" onclick="confirm1Tag({{ $weapon->id }})" class="btn btn-primary w3-round-xlarge my-1 btn-block">BUY</button>
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
                    {{ $weapons->links('pagination::bootstrap-4') }}
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
