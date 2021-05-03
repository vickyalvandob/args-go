@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-md-4">
        <div class="card-box">
            <h4 class="header-title">
            Payout
            </h4>
            <br>
            <form action="{{ route('user.payout.store') }}" enctype="multipart/form-data" class="text-capitalize" method="post">
                @csrf
                <div class="form-group">
                    <label>amount</label>
                    <input type="text" name="amount" placeholder="amount" class="form-control" value="{{ old('amount') }}">
                    <small>tax {{ $general->payout_tax }}%</small>
                </div>
                <div class="form-group">
                    <label>note</label>
                    <textarea name="note" placeholder="note" rows="3" class="form-control">{{ old('note') }}</textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card-box">
            <h4 class="header-title">
            History
            </h4>
            <br>
            <table id="datatable1" class="table table-borderless dt-responsive nowrap">
                <thead class="text-uppercase">
                <tr>
                    <th class="text-center align-middle">Date / Time</th>
                    <th class="text-center align-middle">Proof Image</th>
                    <th class="text-center align-middle">energy</th>
                    <th class="text-center align-middle">amount</th>
                    <th class="text-center align-middle">tax</th>
                    <th class="text-center align-middle">note</th>
                    <th class="text-center align-middle">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payouts as $payout)
                    <tr>
                        <td class="text-center align-middle">{{ $payout->created_at }}</td>
                        <td class="text-center align-middle">
                        @if($payout->proof_image != null)
                          <a href="{{ asset('img/'.$payout->proof_image.'') }}" target="_blank">
                              <img src="{{ asset('img/'.$payout->proof_image.'') }}" width="50" alt="">
                            </a>
                            @else
    -
                            @endif
                        </td>
                        <td class="text-center align-middle">{{ number_format($payout->energy) ?? "-" }}</td>
                        <td class="text-center align-middle">{{ number_format($payout->amount , 2, ',', '.') ?? "-" }}</td>
                        <td class="text-center align-middle">{{ number_format($payout->tax , 2, ',', '.') ?? "-" }}</td>
                        <td class="text-center align-middle">{{ $payout->note }}</td>
                        <td class="text-center aligh-middle">
                            @if($payout->status == 'approved')
                            <span class="badge badge-success">approved</span>
                            @elseif($payout->status == 'declined')
                            <span class="badge badge-danger">declined</span>
                            @elseif($payout->status == 'pending')
                            <span class="badge badge-secondary">pending</span>
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
