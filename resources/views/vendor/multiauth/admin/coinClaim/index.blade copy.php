@extends('multiauth::layouts.app')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="text-center mb-3">
            <a href="{{ route('admin.coinClaim.index') }}" class="btn  @if(Request::is('admin/coinClaim') || Request::is('admin/coinClaim/*')) btn-primary @else btn-outline-primary @endif btn-rounded m-1 px-3">COIN GAST</a>
            <a href="{{ route('admin.puzzleClaim.index') }}" class="btn @if(Request::is('admin/puzzleClaim') || Request::is('admin/puzzleClaim/*')) btn-primary @else btn-outline-primary @endif btn-rounded m-1 px-3">Puzzle</a>
            <a href="{{ route('admin.rewardClaim.index') }}" class="btn  @if(Request::is('admin/rewardClaim') || Request::is('user/rewardClaim/*')) btn-primary @else btn-outline-primary @endif btn-rounded m-1 px-3">Reward</a>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card-box">
            <h4 class="header-title">
            Claim
            </h4>
            <br>
            <div class="table-reponsive">
                <table class="table table-borderless table-striped">
                    <thead>
                        <tr class="text-uppercase">
                            <th class="text-center align-middle">Date / Time</th>
                            <th class="text-center align-middle">Username</th>
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
                            <td class="text-center align-middle">{{ $coinClaim->user->username ?? "-" }}</td>
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
</div>


@endsection
