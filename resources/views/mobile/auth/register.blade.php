@extends('layouts.app', ['auth' => true])
@section('content')
<div class="account-pages w-100 mt-5 mb-5">
    <div class="container">
        <div class="text-center">

            <a href="{{ route('home') }}">
                <img src="{{ asset('img/'.$general->logo_light.'') }}" alt="" class="my-4" height="50" />
               </a>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @include('multiauth::message')
                        <form class="pt-2 text-capitalize row" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group col-md-12">
                                <label>Name</label>
                                <input type="text" name="name" placeholder="name" class="form-control" required value="{{ old('name') }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label>email</label>
                                <input type="email" name="email" placeholder="email" required class="form-control" value="{{ old('email') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>username</label>
                                <input type="text" name="username" placeholder="username" required class="form-control" value="{{ old('username') }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label>birth</label>
                                <input type="date" name="birth" placeholder="birth" class="form-control" value="{{ old('birth') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>phone</label>
                                <input type="text" name="phone" placeholder="+62 " class="form-control" value="{{ old('phone') }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label>city</label>
                                <select class="form-control" name="city" style="width:100%" data-toggle="select2">
                                    <option value="">Select</option>
                                    @php
                                    $city = city();
                                    $city = json_decode($city,true);
                                    @endphp
                                    @foreach($city['rajaongkir']['results'] as $citys)
                                    <option value="{{ $citys['city_name'] }}"> {{ $citys['city_name'] }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>zipcode</label>
                                <input type="text" name="zipcode" placeholder="zipcode " class="form-control" value="{{ old('zipcode') }}">
                            </div>
                            <div class="form-group col-md-12">
                                <label>full address</label>
                                <textarea name="address" class="form-control" placeholder="full address" rows="4">{{ old('address') }}</textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label>password</label>
                                <input type="password" name="password" placeholder="password" required class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>password confirmation</label>
                                <input type="password" name="password_confirmation" placeholder="password confirmation" required class="form-control">
                            </div>
                            <div class="form-group col-md-12 mb-3 mt-3 text-center">
                                <button class="btn btn-primary btn-block" type="submit"> Register</button>
                            </div>
                            <div class="form-group text-center col-md-12">
                                <p class="txt-light mb-0">Already have account ? <a href="{{ route('login') }}" class="w3-hover-text-red"><b>login</b></a></p>
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
