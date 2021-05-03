@extends('layouts.app', ['auth' => true])
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
                        <h3 class="text-white">Login</h3>
                        @include('multiauth::message')
                        <form class="pt-2 text-capitalize" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="password" class="text-white">Email or username</label>
                                <input class="form-control text-white-50 border-0 " autofocus style="background: none!important;" type="text" name="identity" required="" placeholder="Enter your email or username">
                            </div>

                            <div class="form-group mb-3">
                                <label for="password" class="text-white">Password</label>
                                <input class="form-control text-white-50 border-0" style="background: none!important;" type="password" required="" name="password" id="password" placeholder="Enter your password">
                            </div>
                            <div class="form-group mb-3 text-center">
                                <button class="btn btn-outline-light btn-block w3-round-xlarge" type="submit" style="background: none!important;" > Login </button>
                            </div>
                            <div class="form-group mb-3 text-center">
                                <a href="{{ route('loginbygoogle') }}"class="btn btn-outline-light btn-block w3-round-xlarge"> Login By Google</a><br>
                            </div>

                            

                            <div class="form-group text-center">
                                <h5 class="txt-light mb-0">Doesn't have account ? <a href="{{ route('register') }}" class="w3-hover-text-red"><b>register</b></a></h5>
                                <h5 class="text-muted mb-0"><a href="{{ route('home') }}" class="w3-hover-text-red"><b>Back to home</b></a></h5>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
