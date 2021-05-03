

@extends('multiauth::layouts.app') 
@section('content')

<div class="card-box">
    <h4 class="header-title">
    list <a href="{{ route('admin.register') }}"><i class="fa fa-plus-circle"></i></a>
    </h4>
    <br>
    <table id="datatable" class="table table-bordered text-capitalize dt-responsive nowrap">
        <thead>
        <tr>
            <th class="text-center align-middle">no</th>
            <th class="text-center align-middle">Name</th>
            <th class="text-center align-middle">email</th>
            <th class="text-center align-middle">status</th>
            <th class="text-center align-middle">role</th>
            <th class="text-center align-middle">Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($admins as $admin)
            <tr>
                <td class="text-center align-middle">{{ $loop->iteration }}</td>
                <td class="text-center align-middle">{{ $admin->name ?? "-" }}</td>
                <td class="text-center align-middle">{{ $admin->email ?? "-" }}</td>
                <td class="text-center align-middle"> {{ $admin->active? 'Active' : 'Inactive' }}</td>
                <td class="text-center align-middle">{{ $admin->role ?? "-" }}</td>
                <td class="text-center align-middle">
                    <a href="{{route('admin.edit',[$admin->id])}}" class="m-1"><i class="mdi mdi-circle-edit-outline"></i></a>
                    <a href="#" onclick="confirm1Tag({{ $admin->id }})" class="m-1"><i class="mdi mdi-delete"></i></a>
                    <form id="confirm1-form-{{ $admin->id }}" action="{{ route('admin.delete',[$admin->id]) }}" method="POST" style="display: none;">
                        @csrf @method('delete')
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection