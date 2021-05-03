@extends('multiauth::layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-4">
        <div class="pricing-box card-box ribbon-box px-0">
            <div class="inner-box">
                <div class="ribbon-two ribbon-two-info price-ribbon"><span class="text-uppercase">{{ $user->position }}</span></div>
                <div class="plan-header text-center mb-2">
                    <div class="plan-title bg-primary py-2">
                        <h4 class="text-uppercase text-white font-16 my-1">{{ $user->name }}</h4>
                    </div>
                    <img class="rounded-circle m-3" src="{{ asset('img/'.$user->image.'') }}" height="100" width="100">
                </div>
                <div class="p-2">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tr>
                                <th class="text-left text-uppercase">username</th>
                                <td class="text-right">{{ $user->username ?? "-" }}</td>
                            </tr>
                            <tr>
                                <th class="text-left text-uppercase">email</th>
                                <td class="text-right">{{ $user->email ?? "-" }}</td>
                            </tr>
                            <tr>
                                <th class="text-left text-uppercase">phone</th>
                                <td class="text-right">{{ $user->phone ?? "-" }} </td>
                            </tr>
                            <tr>
                                <th class="text-left text-uppercase">birth</th>
                                <td class="text-right">{{ $user->birth ?? "-" }}</td>
                            </tr>
                            <tr>
                                <th class="text-left text-uppercase">city</th>
                                <td class="text-right">{{ $user->city ?? "-" }}</td>
                            </tr>
                            <tr>
                                <th class="text-left text-uppercase">address</th>
                                <td class="text-right">{{ $user->address ?? "-" }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="text-center my-3">
                    <a href="{{ route('admin.user.edit',$user->id) }}" class="btn btn-primary m-1 btn-rounded width-lg">Edit Profile</a>
                    <a href="{{ route('admin.user.reset',$user->id) }}" class="btn btn-primary m-1 btn-rounded width-lg">Reset Password</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
       
    </div>
</div>
@endsection