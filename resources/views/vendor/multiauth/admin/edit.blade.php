
@extends('multiauth::layouts.app') @section('content')
<div class="card-box">

    <h4 class="header-title">
        edit 
        </h4>
        <br>

        <form action="{{route('admin.update',[$admin->id])}}" method="post"  enctype="multipart/form-data" class="text-capitalize" >
            @csrf @method('patch')
        <input type="hidden" name="role_id[]" value="1" required>
        <input type="hidden" name="active" value="1" required>

        <div class="form-group">
            <label>name</label>
            <input type="text" name="name" placeholder="name" class="form-control" value="{{ $admin->name }}">
        </div>
        <div class="form-group">
            <label>email</label>
            <input type="email" name="email" placeholder="email" class="form-control" value="{{ $admin->email }}">
        </div>
        <div class="form-group">
            <label>role</label>
            <select class="form-control" name="role" required required style="width:100%" data-toggle="select2">
                <option value="">Select</option>
                <option value="master" @if ($admin->role == 'master') selected @endif >master</option>
                <option value="product"  @if ($admin->role == 'product') selected @endif>product</option>
                <option value="reseller"  @if ($admin->role == 'reseller') selected @endif>reseller</option>
                <option value="packing"  @if ($admin->role == 'packing') selected @endif>packing</option>
                <option value="finance"  @if ($admin->role == 'finance') selected @endif>finance</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <div class="checkbox">
                <input id="activation" type="checkbox" value="1" {{ $admin->active ? 'checked':'' }} name="activation">
                <label for="activation">
                   Active
                </label>
            </div>
        </div>
        
        
        <div class="form-group">
            <button class="btn btn-primary" type="submit">save changes</button>
        </div>
    </form>
</div>
@endsection

