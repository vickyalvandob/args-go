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
            Attack
            </h4>
            <br>
            <div class="table-responsive">
                <table class="table text-white table-borderless table-striped">
                    <thead>
                        <tr class="text-uppercase">
                            <th class="text-center align-middle">Date / Time</th>
                            <th class="text-center align-middle">Antagonist</th>
                            <th class="text-center align-middle">Energy</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($antagonistAttacks as $antagonistAttack)
                        <tr>
                            <td class="text-center align-middle">{{ $antagonistAttack->created_at->format("H:i, d F Y") ?? "-" }}</td>
                            <td class="text-center align-middle">{{ $antagonistAttack->antagonist->title ?? "-" }}</td>
                            <td class="text-center align-middle">{{ number_format($antagonistAttack->energy , 2, ',', '.') ?? "-" }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pull-right clearfix">
                    {{ $antagonistAttacks->links('pagination::bootstrap-4') }}
                </div>
            </div>

        </div>
    </div>
</div>


@endsection
