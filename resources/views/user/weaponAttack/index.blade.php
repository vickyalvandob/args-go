@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="text-center mb-3">
            <a href="{{ route('user.weaponAttack.index') }}" class="btn  @if(Request::is('user/weaponAttack') || Request::is('user/weaponAttack/*')) btn-primary @else btn-outline-primary @endif btn-rounded m-1 px-3">weapon</a>
            <a href="{{ route('user.antagonistAttack.index') }}" class="btn @if(Request::is('user/antagonistAttack') || Request::is('user/antagonistAttack/*')) btn-primary @else btn-outline-primary @endif btn-rounded m-1 px-3">antagonist</a>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card-box">
            <h4 class="header-title">
            Protection
            </h4>
            <br>
            <div class="table-responsive">
                <table class="table text-white table-borderless table-striped">
                    <thead>
                        <tr class="text-uppercase">
                            <th class="text-center align-middle">Date / Time</th>
                            <th class="text-center align-middle">Weapon</th>
                            <th class="text-center align-middle">Antagonist</th>
                            <th class="text-center align-middle">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($weaponAttacks as $weaponAttack)
                        <tr>
                            <td class="text-center align-middle">{{ $weaponAttack->created_at->format("H:i, d F Y") ?? "-" }}</td>
                            <td class="text-center align-middle">{{ $weaponAttack->weapon->title ?? "-" }}</td>
                            <td class="text-center align-middle">{{ $weaponAttack->antagonist->title ?? "-" }}</td>
                            <td class="text-center align-middle">{{ number_format($weaponAttack->amount , 2, ',', '.') ?? "-" }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pull-right clearfix">
                    {{ $weaponAttacks->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
