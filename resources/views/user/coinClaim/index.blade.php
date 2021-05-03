@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="text-center mb-3">
            <a href="{{ route('user.coinClaim.index') }}" class="btn  @if(Request::is('user/coinClaim') || Request::is('user/coinClaim/*')) btn-primary @else btn-outline-primary @endif btn-rounded m-1 px-3">COIN GAST</a>
            <a href="{{ route('user.puzzleClaim.index') }}" class="btn @if(Request::is('user/puzzleClaim') || Request::is('user/puzzleClaim/*')) btn-primary @else btn-outline-primary @endif btn-rounded m-1 px-3">Puzzle</a>
            <a href="{{ route('user.rewardClaim.index') }}" class="btn  @if(Request::is('user/rewardClaim') || Request::is('user/rewardClaim/*')) btn-primary @else btn-outline-primary @endif btn-rounded m-1 px-3">Reward</a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card-box text-center bg-main">
           <img src="{{ asset('img/'.$general->logo_sm.'') }}" height="60" alt="">
            <h4 class="text-white mb-0">
               {{ number_format(Auth::user()->coin_gast) }} <small>GAST</small>
            </h4>
        </div>
        <div class="card-box">
            <form action="{{ route('user.coinClaim.store') }}" enctype="multipart/form-data" class="text-capitalize" method="post">
                @csrf
                <div class="form-group">
                    <label>amount</label>
                    <input type="text" name="amount" placeholder="amount" class="form-control" value="{{ old('amount') }}">
                </div>
                <div class="form-group">
                    <label>note</label>
                    <textarea name="note" placeholder="note" rows="3" class="form-control">{{ old('note') }}</textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit">CLAIM</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card-box">
            <h4 class="header-title">
            Claim
            </h4>
            <br>
                <table id="datatable1" class="table table-borderless table-striped dt-responsive nowrap">
                    <thead>
                        <tr class="text-uppercase">
                            <th class="text-center align-middle">Date / Time</th>
                            <th class="text-center align-middle">Proof Image</th>
                            <th class="text-center align-middle">Amount</th>
                            <th class="text-center align-middle">Note</th>
                            <th class="text-center align-middle">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coinClaims as $coinClaim)
                        <tr>
                            <td class="text-center align-middle">{{ $coinClaim->created_at ?? "-" }}</td>
                            <td class="text-center align-middle">
                                @if($coinClaim->proof_image != null)
                                  <a href="{{ asset('img/'.$coinClaim->proof_image.'') }}" target="_blank">
                                      <img src="{{ asset('img/'.$coinClaim->proof_image.'') }}" width="50" alt="">
                                    </a>
                                    @else
            -
                                    @endif
                                </td>
                            <td class="text-center align-middle">{{ number_format($coinClaim->amount , 2, ',', '.') ?? "-" }}</td>
                            <td class="text-center align-middle">{{ $coinClaim->note ?? "-" }}</td>
                            <td class="text-center align-middle">
                                @if ($coinClaim->status == "approved")
                                <span class="badge badge-success">{{ $coinClaim->status }}</span>
                                @elseif ($coinClaim->status == "declined")
                                <span class="badge badge-danger">{{ $coinClaim->status }}</span>
                                @elseif ($coinClaim->status == "requested")
                                <span class="badge badge-secondary">{{ $coinClaim->status }}</span>
                                @else
                                -
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

        </div>


    </div>
</div>


@endsection
