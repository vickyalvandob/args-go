@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-md-4">
        <div class="card-box">
            <div class="text-center">
                <img class="rounded-circle m-3" src="{{ asset('img/'.Auth::user()->image.'') }}" height="100" width="100">
                <h4 class="mb-0">{{ Auth::user()->name }}</h4>
                <small>{{ '@'.Auth::user()->username }}</small>
                <div class="mt-3">
                    <a href="{{ route('user.password.index') }}" class="btn btn-primary">Change Password</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card-box">
            <form action="{{ route('user.profile.update') }}" enctype="multipart/form-data" class="text-capitalize row" method="post">
                @csrf
                <div class="form-group col-md-12">
                    <label>Name</label>
                    <input type="text" name="name" placeholder="name" class="form-control" required value="{{ Auth::user()->name }}">
                </div>
                <div class="form-group col-md-6">
                    <label>birth</label>
                    <input type="date" name="birth" placeholder="birth" class="form-control" value="{{ Auth::user()->birth }}">
                </div>
                <div class="form-group col-md-6">
                    <label>phone</label>
                    <input type="text" name="phone" placeholder="phone" class="form-control" value="{{ Auth::user()->phone }}">
                </div>
                <div class="form-group col-md-6">
                    <label>city</label>
                    <select class="form-control" name="city" required style="width:100%" data-toggle="select2">
                        <option value="">Select</option>
                        @php
                        $city = city();
                        $city = json_decode($city,true);
                        @endphp
                        @foreach($city['rajaongkir']['results'] as $citys)
                        <option value="{{ $citys['city_name'] }}" @if (Auth::user()->city == $citys['city_name'])
                            selected
                        @endif> {{ $citys['city_name'] }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>zipcode</label>
                    <input type="text" name="zipcode" placeholder="zipcode" class="form-control" value="{{ Auth::user()->zipcode }}">
                </div>
                <div class="form-group col-md-12">
                    <label>image</label>
                    <input type="file" name="image" placeholder="image" class="form-control" value="{{ Auth::user()->image }}">
                </div>
                <div class="form-group col-md-12">
                    <label>address</label>
                    <textarea name="address" class="form-control" placeholder="address" rows="4">{{ Auth::user()->address }}</textarea>
                </div>
                <div class="form-group col-md-12">
                    <button class="btn btn-primary" type="submit"><span>save changes</span></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
