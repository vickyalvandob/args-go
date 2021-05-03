@extends('layouts.app')
@section('content')


<div class="row">

    <div class="col-md-4">
        <div class="card-box">

         <h4>
            Weapon
             </h4>
             <br>
         @foreach ($weaponCollects as $weaponCollect)
         <div class="text-center card-box" style="background: none!important">
            <div class="row mb-3">
                <div class="col-md-6">
                    <img src="{{ asset('img/'.$weaponCollect->weapon->image.'') }}" class="img-fluid img-shadow mb-0" alt="" style="max-height: 80px">
                    <div class="mt-n2">
                        @if ($weaponCollect->weapon->antagonist_id != null)
                        <span class="badge badge-light text-primary ">{{ $weaponCollect->weapon->antagonist->title ?? "-" }}</span>
                        @else
                        <span class="badge badge-light text-primary ">All</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <h3>{{ $weaponCollect->qty }}</h3>
                    <p>{{ $weaponCollect->weapon->title }}</p>

                </div>
               </div>
               <form action="{{ route('user.weaponAttack.store') }}" method="POST">
                @csrf
                <input type="hidden" name="antagonist_id" value="{{ $antagonist->id }}">
                <input type="hidden" name="weapon_collect_id" value="{{ $weaponCollect->id }}">
                <button type="submit" class="m-1 btn btn-primary btn-rounded btn-block">Attack</button>
            </form>
         </div>
        @endforeach
        </div>
     </div>
    <div class="col-md-8" style="background: none!important">
        <h4>
            Collect everything you find !
            </h4>
            <br>
        <div class="row">
            @if ($coin)
            <div class="col-md-6 text-center">
                <div class="card-box">
                    <h5>{{ $coin->amount }} <small>GAST</small></h5>
                    <div class="my-3">
                        @if ($coin->image == null)
                        <img style="max-height: 100px" src="{{ asset('img/default.png') }}" class="img-fluid img-shadow w3-round-xlarge" alt="">
                        @else
                        <img style="max-height: 100px" src="{{ asset('img/'.$coin->image.'') }}" class="img-fluid img-shadow w3-round-xlarge" alt="">
                        @endif
                    </div>
                    <div class="">
                        <form action="{{ route('user.coinCollect.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="coin_id" value="{{ $coin->id }}">
                            <button type="submit" class="m-1 btn btn-primary btn-rounded btn-block">collect</button>
                        </form>
                    </div>
                </div>
            </div>
            @endif
           @if ($puzzlePiece)
           <div class="col-md-6 text-center">
            <div class="card-box">
                <h5>{{ $puzzlePiece->title }}</h5>
                <div class="my-3">
                    @if ($puzzlePiece->image == null)
                    <img style="max-height: 100px" src="{{ asset('img/default.png') }}" class="img-fluid img-shadow w3-round-xlarge" alt="">
                    @else
                    <img style="max-height: 100px" src="{{ asset('img/'.$puzzlePiece->image.'') }}" class="img-fluid img-shadow w3-round-xlarge" alt="">
                    @endif

                </div>
                <div class="">
                    <form action="{{ route('user.puzzlePieceCollect.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="puzzle_piece_id" value="{{ $puzzlePiece->id }}">
                        <button type="submit" class="m-1 btn btn-primary btn-rounded btn-block">collect</button>
                    </form>

                </div>
            </div>
        </div>
           @endif
           @if ($reward)
           <div class="col-md-6 text-center">
            <div class="card-box">
                <h5>{{ $reward->title }}</h5>
                <div class="my-3">
                    @if ($reward->image == null)
                    <img style="max-height: 100px" src="{{ asset('img/default.png') }}" class="img-fluid img-shadow w3-round-xlarge" alt="">
                    @else
                    <img style="max-height: 100px" src="{{ asset('img/'.$reward->image.'') }}" class="img-fluid img-shadow w3-round-xlarge" alt="">
                    @endif

                </div>
                <div class="">
                    <form action="{{ route('user.rewardCollect.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="reward_id" value="{{ $reward->id }}">
                        <button type="submit" class="m-1 btn btn-primary btn-rounded btn-block">collect</button>
                    </form>
                </div>
            </div>
        </div>
           @endif

           @if ($antagonist)
           <div class="col-md-6 text-center">
            <div class="card-box">
                <h5>{{ $antagonist->title }}</h5>
                <div class="my-3">
                    @if ($antagonist->image == null)
                    <img style="max-height: 100px" src="{{ asset('img/default.png') }}" class="img-fluid img-shadow w3-round-xlarge" alt="">
                    @else
                    <img style="max-height: 100px" src="{{ asset('img/'.$antagonist->image.'') }}" class="img-fluid img-shadow w3-round-xlarge" alt="">
                    @endif
                </div>
                <div class="">
                    <form action="{{ route('user.antagonistAttack.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="antagonist_id" value="{{ $antagonist->id }}">
                        <button type="submit" class="m-1 btn btn-primary btn-rounded btn-block">Attack</button>
                    </form>
                </div>
            </div>
        </div>
           @endif

        </div>
    </div>



</div>

@endsection
