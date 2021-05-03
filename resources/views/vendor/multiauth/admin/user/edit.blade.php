@extends('multiauth::layouts.app') 
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card-box">
            <h4 class="header-title">
                Edit
                </h4>
                <br>
                <form action="{{ route('admin.user.update', $user->id) }}" enctype="multipart/form-data" class="text-capitalize row" method="post">
                    @csrf
                    @method('put')
                <div class="form-group col-md-6">
                    <label>Name</label>
                    <input type="text" name="name" placeholder="name" class="form-control" required value="{{ $user->name }}">
                </div>
                <div class="form-group col-md-6">
                    <label>email</label>
                    <input type="email" name="email" placeholder="email" required class="form-control" value="{{ $user->email }}">
                </div>
                <div class="form-group col-md-6">
                    <label>birth</label>
                    <input type="date" name="birth" placeholder="birth" class="form-control" value="{{ $user->birth }}">
                </div>
                <div class="form-group col-md-6">
                    <label>phone</label>
                    <input type="text" name="phone" placeholder="phone " class="form-control" value="{{ $user->phone }}">
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
                        <option value="{{ $citys['city_name'] }}" @if ($user->city == $citys['city_name'])
                            selected
                        @endif> {{ $citys['city_name'] }} </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group col-md-6">
                    <label>zipcode</label>
                    <input type="text" name="zipcode" placeholder="zipcode " class="form-control" value="{{ $user->zipcode }}">
                </div>
                <div class="form-group col-md-12">
                    <label>address</label>
                    <textarea name="address" class="form-control" placeholder="address" rows="4">{{ $user->address }}</textarea>
                </div>
                <div class="form-group col-md-12">
                    <div class="checkbox checkbox-primary pr-10 pull-left">
                        <input name="emailv" id="checkbox_2" type="checkbox" @if($user->email_verified_at != null) checked @endif>
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