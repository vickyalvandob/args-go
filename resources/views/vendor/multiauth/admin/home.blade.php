

@extends('multiauth::layouts.app')
@section('content')

<div class="row">
   <div class="col-md-12">
       <div class="row">
        <div class="col-md-4">
            <div class="card-box widget-chart-one text-white bg-main bx-shadow-lg">
                <div class="widget-chart-one-content text-center">
                    <p class="mb-0 mt-2 text-uppercase font-weight-bold">Total User</p>
                <h3 class="text-white">{{ number_format(\App\User::all()->count()) }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-box widget-chart-one text-white bg-main bx-shadow-lg">
                <div class="widget-chart-one-content text-center">
                    <p class="mb-0 mt-2 text-uppercase font-weight-bold">Total Top Up</p>
                <h3 class="text-white">{{ number_format(\App\TopUp::where('status', 'approved')->sum('amount'), 2, ',', '.') ?? "-" }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-box widget-chart-one text-white bg-main bx-shadow-lg">
                <div class="widget-chart-one-content text-center">
                    <p class="mb-0 mt-2 text-uppercase font-weight-bold">Total Payout</p>
                <h3 class="text-white">{{ number_format(\App\Payout::where('status', 'approved')->sum('amount'), 2, ',', '.') ?? "-" }}</h3>
                </div>
            </div>
        </div>

       </div>
   </div>
@endsection
