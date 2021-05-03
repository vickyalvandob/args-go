@extends('multiauth::layouts.app') 
@section('content')
<div class="card-box">
    <h4 class="header-title">
        create 
        </h4>
        <br>
    <form action="{{ route('admin.register') }}" enctype="multipart/form-data" class="text-capitalize" method="post">
        @csrf
        <input type="hidden" name="role_id[]" value="1" required>
        <input type="hidden" name="active" value="1" required>

        <div class="form-group">
            <label>name</label>
            <input type="text" name="name" placeholder="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>email</label>
            <input type="email" name="email" placeholder="email" class="form-control" value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <label>role</label>
            <select class="form-control" name="role" required required style="width:100%" data-toggle="select2">
                <option value="">Select</option>
                <option value="master">master</option>
                <option value="product">product</option>
                <option value="reseller">reseller</option>
                <option value="packing">packing</option>
                <option value="finance">finance</option>
            </select>
        </div>
        <div class="form-group">
            <label>password</label>
            <input type="password" name="password" placeholder="password" class="form-control" value="{{ old('password') }}">
        </div>
        <div class="form-group">
            <label>password confirmation</label>
            <input type="password" name="password_confirmation" placeholder="password confirmation" class="form-control" value="{{ old('password_confirmation') }}">
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit">Submit</button>
        </div>
    </form>
</div>
@endsection

