@extends('layouts.app', ['auth' => true]) 
@section('content')
<div class="account-pages w-100 mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                           <h4>LOGIN</h4>
                        </div>
                        @include('multiauth::message')
                        <form class="pt-2 text-capitalize" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="nameaddress">Username or email</label>
                                <input class="form-control" type="text" id="nameaddress" name="identity" required="" placeholder="Enter your username or email">
                            </div>

                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input class="form-control" type="password" required="" name="password" id="password" placeholder="Enter your password">
                            </div>
                            <div class="form-group mb-3 text-center">
                                <button class="btn btn-primary btn-block" type="submit"> Log In </button>
                            </div>
                            <div class="form-group text-center">
                                <p class="txt-light mb-0">Doesn't have account ? <a href="{{ route('register') }}" class="w3-hover-text-red"><b>register</b></a></p>
                                <p class="text-muted mb-0"><a href="{{ route('home') }}" class="w3-hover-text-red"><b>Back to home</b></a></p>
                            </div> 
                        </form>

                    </div> 
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection