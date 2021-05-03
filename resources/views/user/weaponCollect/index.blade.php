@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="text-center mb-3">
            <a href="{{ route('user.coinCollect.index') }}" class="btn  @if(Request::is('user/coinCollect') || Request::is('user/coinCollect/*')) btn-primary @else btn-outline-primary @endif btn-rounded m-1 px-3">COIN GAST</a>
            <a href="{{ route('user.puzzleCollect.index') }}" class="btn @if(Request::is('user/puzzleCollect') || Request::is('user/puzzleCollect/*')) btn-primary @else btn-outline-primary @endif btn-rounded m-1 px-3">Puzzle</a>
            <a href="{{ route('user.weaponCollect.index') }}" class="btn  @if(Request::is('user/weaponCollect') || Request::is('user/weaponCollect/*')) btn-primary @else btn-outline-primary @endif btn-rounded m-1 px-3">weapon</a>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card-box bg-main">
            @if (count($weaponCollects) > 0)
            <div id="carouselId" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    @foreach ($weaponCollects as $weaponCollect)
                    <div class="carousel-item py-3 @if ($loop->iteration == 1)
                        active
                    @endif">
                        <h4 class="text-white mt-0 mb-2 text-center">
                            {{ $weaponCollect->weapon->title }}
                        </h4>
                        <div class="row">
                           <div class="col-md-12 mb-3">
                            <img src="{{ asset('img/'.$weaponCollect->weapon->image.'') }}" class="img-fluid img-shadow" alt="">
                            <div class="w3-display-topright">
                                <span class="btn btn-primary img-shadow mt-2 mr-3">{{ number_format($weaponCollect->qty) }}<small>x</small></span>
                            </div>
                           </div>
                           <div class="col-md-6">
                            <button type="button" data-toggle="modal" data-target="#sell{{ $weaponCollect->id }}" class="btn btn-primary btn-block w3-round-xlarge img-shadow">SELL</button>
                            </div>
                            <div class="col-md-6">
                                <button type="button" data-toggle="modal" data-target="#claim{{ $weaponCollect->id }}" class="btn btn-success btn-block w3-round-xlarge img-shadow">ClAIM</button>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="sell{{ $weaponCollect->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                 <div class="modal-body w3-round-xlarge">
                                    <form action="{{ route('user.weaponSell.store') }}" enctype="multipart/form-data" class="text-capitalize " method="post">
                                        @csrf
                                        <input type="hidden" name="weapon_collect_id" value="{{ $weaponCollect->id }}">
                                        <h4 class="mt-0 mb-2 text-center">
                                            {{ $weaponCollect->weapon->title }}
                                        </h4>
                                        <div class="row justify-content-center">
                                            <div class="col-md-8">
                                                <img src="{{ asset('img/'.$weaponCollect->weapon->image.'') }}" class="img-fluid img-shadow mb-2 w3-round-xxlarge" alt="">
                                            </div>
                                        </div>

                                         <div class="row text-uppercase">
                                            <div class="form-group col-md-6">
                                                <label class="control-label mb-10">qty</label>
                                                <input type="number" min="1" required class="form-control" name="qty" placeholder="Qty">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="control-label mb-10">amount</label>
                                                <input type="text" class="form-control" required name="amount" placeholder="Amount">
                                            </div>
                                            <div class="form-group col-md-12">
                                            <button type="submit" class="btn btn-primary w3-round-xlarge my-1 btn-block">SELL</button>
                                            </div>
                                         </div>
                                     </form>
                                 </div>
                            </div>
                        </div>
                    </div>

                     <!-- Modal -->
                     <div class="modal fade" id="claim{{ $weaponCollect->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                 <div class="modal-body w3-round-xlarge">

                                    <form action="{{ route('user.weaponClaim.store') }}" enctype="multipart/form-data" class="text-capitalize" method="post">
                                        @csrf

                                        <h4 class="header-title text-center mb-2">
                                            {{ $weaponCollect->weapon->title }}
                                        </h4>
                                        <div class="row justify-content-center">
                                            <div class="col-md-8">
                                                <img src="{{ asset('img/'.$weaponCollect->weapon->image.'') }}" class="img-fluid img-shadow mb-2 w3-round-xxlarge" alt="">
                                            </div>
                                        </div>
                                        <input type="hidden" name="weapon_collect_id" value="{{ $weaponCollect->id }}">
                                        <div class="form-group">
                                            <label class="control-label mb-10">qty</label>
                                            <input type="number" min="1" required class="form-control" name="qty" placeholder="Qty">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10">note</label>
                                            <textarea name="note" placeholder="Note" class="form-control" rows="3"></textarea>
                                        </div>
                                        <h4 class="header-title mt-3 mb-2">
                                            Recipient Information
                                        </h4>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="control-label mb-10">Full Name</label>
                                                <input type="text" class="form-control" required name="recipient_name" placeholder="Full Name">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="control-label mb-10">Phone Number</label>
                                                <input type="text" class="form-control" required name="recipient_phone" placeholder="Phone Number">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="control-label mb-10">Full Address</label>
                                                <textarea name="recipient_address" required class="form-control" placeholder="Full Address" rows="3"></textarea>
                                            </div>

                                            <div class="form-group col-md-12">
                                                <button type="submit" class="btn btn-primary w3-round-xlarge my-1 btn-block">CLAIM</button>
                                            </div>

                                        </div>


                                     </form>

                                 </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselId" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselId" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            @else
            <div class="text-center">
                <h4 class="my-3">No weapon</h4>
            <a href="{{route('user.dashboard') }}" class="btn btn-rounded btn-block m-1 btn-primary">Collect Now!</a>
            </div>
            @endif
        </div>
    </div>

    <div class="col-md-7">
        <div class="card-box">
            <h4 class="header-title">
            History
            </h4>
            <br>
                <table id="datatable2" class="table table-borderless text-white dt-responsive nowrap">
                    <thead>
                        <tr class="text-uppercase">
                            <th class="text-center align-middle">Date / Time</th>
                            <th class="text-center align-middle">weapon</th>
                            <th class="text-center align-middle">Amount</th>
                            <th class="text-center align-middle">Energy</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($weaponCollectHistorys as $weaponCollectHistory)
                        <tr>
                            <td class="text-center align-middle">{{ $weaponCollectHistory->created_at->format("H:i, d F Y") ?? "-" }}</td>
                            <td class="text-center align-middle">{{ $weaponCollectHistory->weapon->title ?? "-" }}</td>
                            <td class="text-center align-middle">{{ number_format($weaponCollectHistory->amount , 2, ',', '.') ?? "-" }}</td>
                            <td class="text-center align-middle">{{ number_format($weaponCollectHistory->energy , 2, ',', '.') ?? "-" }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

        </div>
    </div>
</div>


@endsection
