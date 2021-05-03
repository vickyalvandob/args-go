@extends('multiauth::layouts.app')
@section('content')
@php
$coinClaim_req = \App\CoinClaim::where('status','pending')->count();
$rewardClaim_req = \App\RewardClaim::where('status','pending')->count();
$puzzleClaim_req = \App\PuzzleClaim::where('status','pending')->count();
@endphp
<div class="row">
    <div class="col-md-12">
        <div class="text-center mb-3">
            <a href="{{ route('admin.coinClaim.index') }}" class="btn  @if(Request::is('admin/coinClaim') || Request::is('admin/coinClaim/*')) btn-primary @else btn-outline-primary @endif btn-rounded m-1 px-3">COIN GAST @if($coinClaim_req > 0) <span class="badge badge-primary ml-2">{{ $coinClaim_req }}</span> @endif</span></a>
            <a href="{{ route('admin.puzzleClaim.index') }}" class="btn @if(Request::is('admin/puzzleClaim') || Request::is('admin/puzzleClaim/*')) btn-primary @else btn-outline-primary @endif btn-rounded m-1 px-3">Puzzle  @if($puzzleClaim_req > 0) <span class="badge badge-primary ml-2">{{ $puzzleClaim_req }}</span> @endif</span> </a>
            <a href="{{ route('admin.rewardClaim.index') }}" class="btn  @if(Request::is('admin/rewardClaim') || Request::is('user/rewardClaim/*')) btn-primary @else btn-outline-primary @endif btn-rounded m-1 px-3">Reward  @if($rewardClaim_req > 0) <span class="badge badge-primary ml-2">{{ $rewardClaim_req }}</span> @endif</span></a>
        </div>
    </div>
       <div class="col-md-12">
      <div class="card-box">
           <div class="">
             Pending
           </div>
           <form class="form-inline justify-content-center" action="" method="get">
            <div class="form-group m-1">
                <input class="form-control" placeholder="Search.." name="q" value="{{ request()->get('q') }}" type="text">
            </div>
            <div class="form-group m-1 text-right">
                    <button type="submit" class="btn btn-outline-primary m-1"> <i class="fa fa-search mr-1"></i> Find User</button>
            </div>
        </form>
            <div class="table-responsive table__pending">
                @include('multiauth::admin.coinClaim.pending')
            </div>
          </div>
      </div>

      <div class="col-md-12">
      <div class="card-box">
        <div class="">
          History
        </div>
        <form class="form-inline justify-content-center" action="" method="get">
            <div class="form-group m-1">
                <input class="form-control" placeholder="Search.." name="qc" value="{{ request()->get('qc') }}" type="text">
            </div>
            <div class="form-group m-1 text-right">
                    <button type="submit" class="btn btn-outline-primary m-1"> <i class="fa fa-search mr-1"></i> Find User</button>
            </div>
        </form>
            <div class="table-responsive table__history">
                @include('multiauth::admin.coinClaim.history')
            </div>
          </div>
      </div>


    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $('body').on('click', '.pending__paginate .pagination li a', function (e) {
                e.preventDefault();
                const url = $(this).attr('href');
                $.ajax({
                    url: url,
                    beforeSend: overlayLoading(),
                }).done(function (response) {
                    $('.table__pending').html(response)
                })
                window.history.pushState('', '', url)
            });
            $('body').on('click', '.history__paginate .pagination li a', function (e) {
                e.preventDefault();
                const url = $(this).attr('href');
                $.ajax({
                    url: url,
                    beforeSend: overlayLoading(),
                }).done(function (response) {
                    $('.table__history').html(response)
                })
                window.history.pushState('', '', url)
            });
            function overlayLoading() {
                $.LoadingOverlay("show");
                setTimeout(function(){
                    $.LoadingOverlay("hide");
                });
            }
        });
    </script>
@endpush
