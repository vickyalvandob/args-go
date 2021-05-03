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
                            <th class="text-center align-middle">Date / Time</th>
                            <th class="text-center align-middle">Proof Image</th>
                            <th class="text-center align-middle">puzzle</th>
                            <th class="text-center align-middle">Recipient Name</th>
                            <th class="text-center align-middle">Recipient Address</th>
                            <th class="text-center align-middle">Recipient Phone</th>
                            <th class="text-center align-middle">qty</th>
                            <th class="text-center align-middle">Amount</th>
                            <th class="text-center align-middle">Note</th>
                            <th class="text-center align-middle">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($puzzleClaims as $puzzleClaim)
                        <tr>
                            <td class="text-center align-middle">{{ $puzzleClaim->created_at->format("H:i, d F Y") ?? "-" }}</td>
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
                            <td class="text-center align-middle">{{ $puzzleClaim->puzzle->title ?? "-" }}</td>
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
