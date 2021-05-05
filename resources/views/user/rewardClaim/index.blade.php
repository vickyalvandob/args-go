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
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-white my-0">
                        {{ number_format($rewardCollects->sum('qty')) }} <small>reward</small>
                     </h3>
                </div>
            </div>
        </div>
        <div class="card-box">
            <form action="{{ route('user.rewardClaim.store') }}" enctype="multipart/form-data" class="text-capitalize" method="post">
                @csrf
                <div class="form-group">
                    <label>reward</label>
                    <select class="form-control" name="reward_collect_id" required style="width:100%" data-toggle="select2">
                        <option value="">Select</option>
                        @foreach($rewardCollects as $rewardCollect)
                        <option value="{{ $rewardCollect->id }}"> {{ $rewardCollect->reward->title }} | Qty. {{ $rewardCollect->qty }}x </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>qty</label>
                    <input type="text" name="qty" placeholder="qty" class="form-control" value="{{ old('qty') }}">
                </div>
                <div class="form-group">
                    <label>note</label>
                    <textarea name="note" placeholder="note" rows="3" class="form-control">{{ old('note') }}</textarea>
                </div>
                <h4 class="header-title mt-3 mb-2">
                    Recipient Information
                </h4>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="control-label mb-10">Name</label>
                        <input type="text" class="form-control" required name="recipient_name" placeholder="Name">
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label mb-10">Phone</label>
                        <input type="text" class="form-control" required name="recipient_phone" placeholder="Phone">
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label mb-10">Address</label>
                        <textarea name="recipient_address" required class="form-control" placeholder="Address" rows="3"></textarea>
                    </div>

                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-primary w3-round-xlarge my-1 btn-block">CLAIM</button>
                    </div>

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
                            <th class="text-center align-middle">Date/Time</th>
                            <th class="text-center align-middle">Image</th>
                            <th class="text-center align-middle">reward</th>
                            <th class="text-center align-middle">Name</th>
                            <th class="text-center align-middle">ADDRESS</th>
                            <th class="text-center align-middle">PHONE</th>
                            <th class="text-center align-middle">QTY</th>
                            <th class="text-center align-middle">AMOUNT</th>
                            <th class="text-center align-middle">NOTE</th>
                            <th class="text-center align-middle">STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rewardClaims as $rewardClaim)
                        <tr>
                            <td class="text-center align-middle">{{ $rewardClaim->created_at->format("H:i, d F Y") ?? "-" }}</td>
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
                            <td class="text-center align-middle">{{ $rewardClaim->reward->title ?? "-" }}</td>
                            <td class="text-center align-middle">{{ number_format($rewardClaim->qty , 2, ',', '.') ?? "-" }}</td>
                            <td class="text-center align-middle">{{ number_format($rewardClaim->amount , 2, ',', '.') ?? "-" }}</td>
                            <td class="text-center align-middle">{{ $rewardClaim->note ?? "-" }}</td>
                            <td class="text-center align-middle">
                                @if ($rewardClaim->status == "approved")
                                <span class="badge badge-success">{{ $rewardClaim->status }}</span>
                                @elseif ($rewardClaim->status == "declined")
                                <span class="badge badge-danger">{{ $rewardClaim->status }}</span>
                                @elseif ($rewardClaim->status == "pending")
                                <span class="badge badge-secondary">{{ $rewardClaim->status }}</span>
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
