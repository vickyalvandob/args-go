@extends('multiauth::layouts.app', ['auth' => true])
@section('content')
<div class="account-pages w-100 mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="row justify-content-center">
                   <div class="col-md-8 text-center">
                    <img src="{{ asset('img/icon4.svg') }}" alt="" class="img-fluid img-shadow"/>
                   </div>
               </div>
            </div>
            <div class="col-md-5">
                <div class="mt-md-5">
                        <h3 class="text-white">Admin | Login</h3>
                        @include('multiauth::message')
                        <form class="pt-2 text-capitalize" method="POST" action="{{ route('admin.login') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="password" class="text-white">Username</label>
                                <input class="form-control text-white-50 border-0 " autofocus style="background: none!important;" type="text" name="name" required="" placeholder="Enter your username">
                            </div>

                            <div class="form-group mb-3">
                                <label for="password" class="text-white">Password</label>
                                <input class="form-control text-white-50 border-0" style="background: none!important;" type="password" required="" name="password" id="password" placeholder="Enter your password">
                            </div>
                            <div class="form-group mb-3 text-center">
                                <button class="btn btn-outline-light btn-block w3-round-xlarge" type="submit" style="background: none!important;" > Login </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
