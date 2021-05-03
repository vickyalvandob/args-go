@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <form action="{{ route('user.password.update') }}" enctype="multipart/form-data" class="text-capitalize" method="post">
                @csrf
                <div class="form-group">
                    <label>old password</label>
                    <input type="password" name="old_password" placeholder="old password" class="form-control">
                </div>
                <div class="form-group">
                    <label>new password</label>
                    <input type="password" name="password" placeholder="new password" class="form-control">
                </div>
                <div class="form-group">
                    <label>confirm new password</label>
                    <input type="password" name="password_confirmation" placeholder="confirm new password" class="form-control">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit"><span>Submit</span></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection