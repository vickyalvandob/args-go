@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-md-12 text-center">
        <h3 class="img-shadow"><i class="mdi mdi-shopping mr-1"></i> MALL</h3>
        <div class="mb-2">
            <a href="{{ route('user.puzzlePieceSell.index') }}" class="btn @if(Request::is('user/puzzlePieceSell') || Request::is('user/puzzlePieceSell/*')) btn-primary @else btn-outline-primary @endif btn-rounded m-1 px-3">Puzzle</a>
            <a href="{{ route('user.rewardSell.index') }}" class="btn  @if(Request::is('user/rewardSell') || Request::is('user/rewardSell/*')) btn-primary @else btn-outline-primary @endif btn-rounded m-1 px-3">Reward</a>
            <a href="{{ route('user.rewardSell.index') }}" class="btn  @if(Request::is('user/rewardSell') || Request::is('user/rewardSell/*')) btn-primary @else btn-outline-primary @endif btn-rounded m-1 px-3">Purchase</a>
        </div>

        <div class="row">
            <div class="col-md-6">
                 <div class="card-box bg-none">
                     <div class="table-responsive">
                         <table class="table table-borderless text-white">
                             <thead>
                                 <tr class="text-uppercase">
                                     <th class="text-center align-middle">Buy</th>
                                     <th class="text-center align-middle">reward</th>
                                     <th class="text-center align-middle">qty</th>
                                     <th class="text-center align-middle">Amount</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @foreach ($rewardBuys as $rewardBuy)
                                 <tr>
                                     <td class="text-center align-middle">{{ $rewardBuy->created_at->format("H:i, d F Y") ?? "-" }}</td>
                                     <td class="text-center align-middle">{{ $rewardBuy->reward->title ?? "-" }}</td>
                                     <td class="text-center align-middle">{{ number_format($rewardBuy->qty) ?? "-" }}</td>
                                     <td class="text-center align-middle">{{ number_format($rewardBuy->amount , 2, ',', '.') ?? "-" }}</td>
                                 </tr>
                                 @endforeach
                             </tbody>
                         </table>
                         <div class="pull-right">
                             {{ $rewardBuys->links('pagination::bootstrap-4') }}
                         </div>
                     </div>
                 </div>
            </div>
            <div class="col-md-6">
                 <div class="card-box">
                     <div class="table-responsive">
                         <table class="table table-borderless text-white">
                             <thead>
                                 <tr class="text-uppercase">
                                     <th class="text-center align-middle">Sell</th>
                                     <th class="text-center align-middle">reward</th>
                                     <th class="text-center align-middle">qty</th>
                                     <th class="text-center align-middle">Amount</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @foreach ($rewardSells as $rewardSell)
                                 <tr>
                                     <td class="text-center align-middle">{{ $rewardSell->created_at->format("H:i, d F Y") ?? "-" }}</td>
                                     <td class="text-center align-middle">{{ $rewardSell->reward->title ?? "-" }}</td>
                                     <td class="text-center align-middle">{{ number_format($rewardSell->qty) ?? "-" }}</td>
                                     <td class="text-center align-middle">{{ number_format($rewardSell->amount , 2, ',', '.') ?? "-" }}</td>
                                 </tr>
                                 @endforeach
                             </tbody>
                         </table>
                         <div class="pull-right">
                             {{ $rewardSells->links('pagination::bootstrap-4') }}
                         </div>
                     </div>
                 </div>
             </div>
        </div>

    </div>
</div>


@endsection
