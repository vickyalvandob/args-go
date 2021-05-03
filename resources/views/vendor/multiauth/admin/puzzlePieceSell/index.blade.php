@extends('multiauth::layouts.app')
@section('content')

<div class="row">
    <div class="col-md-12 text-center">
        <h3 class="img-shadow"><i class="mdi mdi-shopping mr-1"></i> MALL</h3>
        <div class="mb-2">
            <a href="{{ route('admin.puzzlePieceSell.index') }}" class="btn @if(Request::is('admin/puzzlePieceSell') || Request::is('admin/puzzlePieceSell/*')) btn-primary @else btn-outline-primary @endif btn-rounded m-1 px-3">Puzzle</a>
            <a href="{{ route('admin.rewardSell.index') }}" class="btn  @if(Request::is('admin/rewardSell') || Request::is('admin/rewardSell/*')) btn-primary @else btn-outline-primary @endif btn-rounded m-1 px-3">Reward</a>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card-box">
            <h4>Buy</h4>
            <div class="table-responsive">
                <table class="table table-borderless text-white">
                    <thead>
                        <tr class="text-uppercase">
                            <th class="text-center align-middle">Username</th>
                            <th class="text-center align-middle">puzzle</th>
                            <th class="text-center align-middle">qty</th>
                            <th class="text-center align-middle">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($puzzlePieceBuys as $puzzlePieceBuy)
                        <tr>
                            <td class="text-center align-middle">{{ $puzzlePieceBuy->user->username ?? "-" }}</td>
                            <td class="text-center align-middle">{{ $puzzlePieceBuy->puzzlePiece->title ?? "-" }}</td>
                            <td class="text-center align-middle">{{ number_format($puzzlePieceBuy->qty) ?? "-" }}</td>
                            <td class="text-center align-middle">{{ number_format($puzzlePieceBuy->amount , 2, ',', '.') ?? "-" }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pull-right">
                    {{ $puzzlePieceBuys->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
   </div>
   <div class="col-md-6">
        <div class="card-box">
            <h4>Sell</h4>
            <div class="table-responsive">
                <table class="table table-borderless text-white">
                    <thead>
                        <tr class="text-uppercase">
                            <th class="text-center align-middle">Username</th>
                            <th class="text-center align-middle">puzzle</th>
                            <th class="text-center align-middle">qty</th>
                            <th class="text-center align-middle">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($puzzlePieceSells as $puzzlePieceSell)
                        <tr>
                            <td class="text-center align-middle">{{ $puzzlePieceSell->user->username ?? "-" }}</td>
                            <td class="text-center align-middle">{{ $puzzlePieceSell->puzzlePiece->title ?? "-" }}</td>
                            <td class="text-center align-middle">{{ number_format($puzzlePieceSell->qty) ?? "-" }}</td>
                            <td class="text-center align-middle">{{ number_format($puzzlePieceSell->amount , 2, ',', '.') ?? "-" }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pull-right">
                    {{ $puzzlePieceSells->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

</div>


@endsection
