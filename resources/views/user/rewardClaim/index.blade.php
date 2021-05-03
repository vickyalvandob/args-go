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
    <div class="col-md-12">
        <div class="card-box">
            <h4 class="header-title">
            List
            </h4>
            <br>
            <div class="table-responsive">
                <table class="table table-borderless table-striped text-white">
                    <thead>
                        <tr class="text-uppercase">
                            <th class="text-center align-middle">Date/Time</th>
                            <th class="text-center align-middle">Reward</th>
                            <th class="text-center align-middle">Image</th>
                            <th class="text-center align-middle">Name</th>
                            <th class="text-center align-middle">Address</th>
                            <th class="text-center align-middle">Phone</th>
                            <th class="text-center align-middle">qty</th>
                            <th class="text-center align-middle">Amount</th>
                            <th class="text-center align-middle">Note</th>
                            <th class="text-center align-middle">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rewardClaims as $rewardClaim)
                        <tr>
                            <td class="text-center align-middle">{{ $rewardClaim->created_at->format("H:i, d F Y") ?? "-" }}</td>
                            <td class="text-center align-middle">{{ $rewardClaim->reward->title ?? "-" }}</td>
                            <td class="text-center align-middle">
                                @if($rewardClaim->proof_image != null)
                                <a href="{{ asset('img/'.$rewardClaim->proof_image.'') }}">
                                    <img src="{{ asset('img/'.$rewardClaim->proof_image.'') }}" width="50" alt="">
                                </a>
                                @else
                                -
                                @endif
                            </td>

                            <td class="text-center align-middle">{{ $rewardClaim->recipient_name ?? "-" }}</td>
                            <td class="text-center align-middle">{{ $rewardClaim->recipient_address ?? "-" }}</td>
                            <td class="text-center align-middle">{{ $rewardClaim->recipient_phone ?? "-" }}</td>
                            <td class="text-center align-middle">{{ number_format($rewardClaim->qty , 2, ',', '.') ?? "-" }}</td>
                            <td class="text-center align-middle">{{ number_format($rewardClaim->amount , 2, ',', '.') ?? "-" }}</td>
                            <td class="text-center align-middle">{{ $rewardClaim->note ?? "-" }}</td>
                            <td class="text-center align-middle">
                                @if ($rewardClaim->status == "approved")
                                <span class="badge badge-success">{{ $rewardClaim->status }}</span>
                                @elseif ($rewardClaim->status == "declined")
                                <span class="badge badge-danger">{{ $rewardClaim->status }}</span>
                                @elseif ($rewardClaim->status == "requested")
                                <span class="badge badge-secondary">{{ $rewardClaim->status }}</span>
                                @else
                                -
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pull-right clearfix">
                    {{ $rewardClaims->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
