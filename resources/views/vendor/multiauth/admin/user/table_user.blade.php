<div class="table-responsive">
    <table class="table table-borderless table-striped text-white text-capitalize">
        <thead>
        <tr class="text-uppercase">
            <th class="text-center align-middle">created at</th>
            <th class="text-center align-middle">Name</th>
            <th class="text-center align-middle">Username</th>
            <th class="text-center align-middle">email</th>
            <th class="text-center align-middle">Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td class="text-center align-middle">{{ $user->created_at }}</td>
                <td class="text-center align-middle">{{ $user->name ?? "-" }}</td>
                <td class="text-center align-middle">{{ $user->username ?? "-" }}</td>
                <td class="text-center align-middle">{{ $user->email ?? "-" }}</td>
                <td class="text-center align-middle">
                    <a href="{{ route('admin.user.show',[$user->id]) }}" class="m-1"><i class="mdi mdi-eye"></i></a>
                    <a href="{{ route('admin.user.edit',[$user->id]) }}" class="m-1"><i class="mdi mdi-circle-edit-outline"></i></a>
                    <a href="#" onclick="confirm1Tag({{ $user->id }})" class="m-1"><i class="mdi mdi-delete"></i></a>
                    <form id="confirm1-form-{{ $user->id }}" action="{{ route('admin.user.destroy',[$user->id]) }}" method="POST" style="display: none;">
                        @csrf @method('delete')
                    </form>
                    <a href="{{ route('user.login',[$user->id]) }}" target="_blank" class="m-1"><i class="mdi mdi-login"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row justify-content-center table__paginate__user">
        {{ $users->links('pagination::bootstrap-4') }}
    </div>

</div>
