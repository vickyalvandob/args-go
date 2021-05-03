@extends('multiauth::layouts.app')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="text-center mb-3">
            <a href="{{ route('admin.coinCollect.index') }}" class="btn  @if(Request::is('admin/coinCollect') || Request::is('admin/coinCollect/*')) btn-primary @else btn-outline-primary @endif btn-rounded m-1 px-3">COIN GAST</a>
            <a href="{{ route('admin.puzzleCollect.index') }}" class="btn @if(Request::is('admin/puzzleCollect') || Request::is('admin/puzzleCollect/*')) btn-primary @else btn-outline-primary @endif btn-rounded m-1 px-3">Puzzle</a>
            <a href="{{ route('admin.rewardCollect.index') }}" class="btn  @if(Request::is('admin/rewardCollect') || Request::is('admin/rewardCollect/*')) btn-primary @else btn-outline-primary @endif btn-rounded m-1 px-3">Reward</a>
        </div>
        <div class="card-box">
            <h4 class="header-title">
            History
            </h4>
            <br>
                <table id="datatable2" class="table text-white table-borderless dt-responsive nowrap">
                    <thead>
                        <tr class="text-uppercase">
                            <th class="text-center align-middle">Date / Time</th>
                            <th class="text-center align-middle">Username</th>
                            <th class="text-center align-middle">Amount</th>
                            <th class="text-center align-middle">Energy</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coinCollects as $coinCollect)
                        <tr>
                            <td class="text-center align-middle">{{ $coinCollect->created_at->format("H:i, d F Y") ?? "-" }}</td>
                            <td class="text-center align-middle">{{ $coinCollect->user->username ?? "-" }}</td>
                            <td class="text-center align-middle">{{ number_format($coinCollect->amount , 2, ',', '.') ?? "-" }}</td>
                            <td class="text-center align-middle">{{ number_format($coinCollect->energy , 2, ',', '.') ?? "-" }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

        </div>
    </div>
</div>


@endsection
