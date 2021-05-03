@extends('multiauth::layouts.app') 
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card-box">

            <h4 class="header-title">
                Create
                </h4>
<br>
            <form action="{{ route('admin.user.store') }}" enctype="multipart/form-data" class="text-capitalize row" method="post">
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
                <div class="form-group col-md-12">
                    <div class="checkbox checkbox-primary pr-10 pull-left">
                        <input name="emailv" id="checkbox_2" type="checkbox" >
                        <label for="checkbox_2"> Email Verified</label>
                    </div>
                    <div class="clearfix"></div>
                </div>
                
                <div class="form-group col-md-12">
                    <button class="btn btn-primary btn-block" type="submit"><span>Submit</span></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection