@extends('multiauth::layouts.app')
@section('content')
@php
$rewardClaim_req = \App\RewardClaim::where('status','requested')->count();
$puzzleClaim_req = \App\PuzzleClaim::where('status','requested')->count();
@endphp
<div class="row">
    <div class="col-md-12">
        <div class="text-center mb-3">
            <a href="{{ route('admin.coinClaim.index') }}" class="btn  @if(Request::is('admin/coinClaim') || Request::is('admin/coinClaim/*')) btn-primary @else btn-outline-primary @endif btn-rounded m-1 px-3">COIN GAST</a>
            <a href="{{ route('admin.puzzleClaim.index') }}" class="btn @if(Request::is('admin/puzzleClaim') || Request::is('admin/puzzleClaim/*')) btn-primary @else btn-outline-primary @endif btn-rounded m-1 px-3">Puzzle  @if($puzzleClaim_req > 0) <span class="badge badge-primary ml-2">{{ $puzzleClaim_req }}</span> @endif</span> </a>
            <a href="{{ route('admin.rewardClaim.index') }}" class="btn  @if(Request::is('admin/rewardClaim') || Request::is('user/rewardClaim/*')) btn-primary @else btn-outline-primary @endif btn-rounded m-1 px-3">Reward  @if($rewardClaim_req > 0) <span class="badge badge-primary ml-2">{{ $rewardClaim_req }}</span> @endif</span></a>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card-box">
            <h4 class="header-title">
                Claim
            </h4>
            <br>
            <div class="table-responsive">
                <table class="table table-borderless table-striped text-white">
                    <thead>
                        <tr class="text-uppercase">
                            <th class="text-center align-middle">Date/Time</th>
                            <th class="text-center align-middle">Username</th>
                            <th class="text-center align-middle">puzzle</th>
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
                        @foreach ($puzzleClaims_pending as $puzzleClaim)
                        <tr>
                            <td class="text-center align-middle">{{ $puzzleClaim->created_at->format("H:i, d F Y") ?? "-" }}</td>
                            <td class="text-center align-middle">{{ $puzzleClaim->user->username ?? "-" }}</td>
                            <td class="text-center align-middle">{{ $puzzleClaim->puzzle->title ?? "-" }}</td>
                            <td class="text-center align-middle">
                                @if($puzzleClaim->proof_image != null)
                                <a href="{{ asset('img/'.$puzzleClaim->proof_image.'') }}">
                                    <img src="{{ asset('img/'.$puzzleClaim->proof_image.'') }}" width="50" alt="">
                                </a>
                                @else
                                -
                                @endif
                            </td>

                            <td class="text-center align-middle">{{ $puzzleClaim->recipient_name ?? "-" }}</td>
                            <td class="text-center align-middle">{{ $puzzleClaim->recipient_address ?? "-" }}</td>
                            <td class="text-center align-middle">{{ $puzzleClaim->recipient_phone ?? "-" }}</td>
                            <td class="text-center align-middle">{{ number_format($puzzleClaim->qty , 2, ',', '.') ?? "-" }}</td>
                            <td class="text-center align-middle">{{ number_format($puzzleClaim->amount , 2, ',', '.') ?? "-" }}</td>
                            <td class="text-center align-middle">{{ $puzzleClaim->note ?? "-" }}</td>
                            <td class="text-center align-middle">
                                @if ($puzzleClaim->status == "approved")
                                <span class="badge badge-success">{{ $puzzleClaim->status }}</span>
                                @elseif ($puzzleClaim->status == "declined")
                                <span class="badge badge-danger">{{ $puzzleClaim->status }}</span>
                                @elseif ($puzzleClaim->status == "requested")
                                <span class="badge badge-secondary">{{ $puzzleClaim->status }}</span>
                                @else
                                -
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pull-right">
                    {{ $puzzleClaims->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
