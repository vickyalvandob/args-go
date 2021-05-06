@extends('multiauth::layouts.app')

@section('content')
<div id="accordianId" role="tablist" aria-multiselectable="true">
        <a data-toggle="collapse" class="btn btn-primary mb-3" data-parent="#accordianId" href="#section1ContentId" aria-expanded="true" aria-controls="section1ContentId">
            <i class="mdi mdi-plus-circle"></i> TRANSFER
          </a>
        <div id="section1ContentId" class="collapse in" role="tabpanel" aria-labelledby="section1HeaderId">
            <div class="card-box">
                <form method="POST" id="confirm2-form-1" action="{{route('admin.transfer.store')}}"
                class="row text-capitalize" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group col-md-12">
                    <label>Username </label>
                    <input class="form-control " placeholder="Username to transfer" name="username" id="username"
                        type="text" required>
                    <small class="float-right text-primary my-1" id="showUser"> </small>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group col-md-6">
                    <label>Amount</label>
                    <input type="text" name="amount" class="form-control" placeholder="Amount" required>
                </div>
                <div class="form-group col-md-6">
                    <label>type</label>
                    <select name="type" required class="form-control select2">
                        <option value="">Select</option>
                        <option value="ARGS"> ARGS </option>
                        <option value="GAST"> GAST </option>
                        <option value="TTG"> TTG </option>
                    </select>
                </div>
                <div class="form-group col-md-12">
                    <label>Note <small>(Optional)</small></label>
                    <textarea name="note" class="form-control" placeholder="Type your note.." rows="4"></textarea>
                </div>
                <div class="form-group col-md-12">
                    <a href="#" class="btn-primary btn btn-block" onclick="confirm2Tag(1)"> TRANSFER </a>
                </div>
            </form>

            </div>
        </div>
</div>

<div class="row">


    <div class="col-md-6">
        <div class="card-box">
            User
            <br>

            <table id="datatable2" class="table table-borderless table-striped dt-responsive nowrap">
                <thead>
                    <tr class="text-uppercase">
                        <th class="text-center align-middle">Date/Time</th>
                        <th class="text-center align-middle">Username</th>
                        <th class="text-center align-middle">recipient</th>
                        <th class="text-center align-middle">Amount</th>
                        <th class="text-center align-middle">Tax</th>
                        <th class="text-center align-middle">Charge</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transfers_user as $transfer_user)
                    <tr>

                        <td class="text-center aligh-middle">{{ $transfer_user->created_at->format("H:i, d F Y") }}</td>
                        <td class="text-center align-middle">
                            {{ $transfer_user->user->username ?? '-' }}
                        </td>
                        <td class="text-center align-middle">
                            {{ $transfer_user->recipient->username ?? '-' }}
                        </td>
                        <td class="text-center align-middle">{{ number_format($transfer_user->amount, 2, ',', '.') ?? "-" }}<small class="ml-1">{{ $transfer_user->type ?? "-" }}</small></td>
                        <td class="text-center align-middle">{{ number_format($transfer_user->tax, 2, ',', '.') ?? "-" }}<small class="ml-1">{{ $transfer_user->type ?? "-" }}</small></td>
                        <td class="text-center align-middle">
                            @if ($transfer_user->energy > 0)
                            <span class="d-block">{{ number_format($transfer_user->energy, 2, ',', '.') ?? "-" }}<small class="ml-1"><i class="mdi mdi-flash text-warning"></i></small></span>
                            @endif
                            @if ($transfer_user->ttg > 0)
                           <span class="d-block"> {{ number_format($transfer_user->ttg, 2, ',', '.') ?? "-" }}<small class="ml-1">TTG</small></span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
    <div class="col-md-6">
        <div class="card-box">
            Admin
            <br>
            <table id="datatable1" class="table table-borderless table-striped dt-responsive nowrap">
                <thead class="text-uppercase">
                    <tr>
                        <th class="text-center align-middle">Date/Time</th>
                        <th class="text-center align-middle">Username</th>
                        <th class="text-center align-middle">Amount</th>
                        <th class="text-center align-middle">Tax</th>
                        <th class="text-center align-middle">Charge</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transfers_admin as $transfer_admin)
                    <tr>

                        <td class="text-center aligh-middle">{{ $transfer_admin->created_at->format("H:i, d F Y") }}</td>
                        <td class="text-center align-middle">
                            {{ $transfer_admin->recipient->username ?? '-' }}
                        </td>
                        <td class="text-center align-middle">{{ number_format($transfer_admin->amount, 2, ',', '.') ?? "-" }}<small class="ml-1">{{ $transfer_admin->type ?? "-" }}</small></td>
                        <td class="text-center align-middle">{{ number_format($transfer_admin->tax, 2, ',', '.') ?? "-" }}<small class="ml-1">{{ $transfer_admin->type ?? "-" }}</small></td>
                        <td class="text-center align-middle">
                            @if ($transfer_admin->energy > 0)
                            <span class="d-block">{{ number_format($transfer_admin->energy, 2, ',', '.') ?? "-" }}<small class="ml-1"><i class="mdi mdi-flash text-warning"></i></small></span>
                            @endif
                            @if ($transfer_admin->ttg > 0)
                           <span class="d-block"> {{ number_format($transfer_admin->ttg, 2, ',', '.') ?? "-" }}<small class="ml-1">TTG</small></span>
                            @endif
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
    $(document).ready(function () {
        $(document).on('keyup', '#username', function () {
            var username = $("input[name='username']").val();
            var token = $("input[name='_token']").val();

            $.ajax({
                type: 'POST',
                url: "{{ route('getUser') }}",
                data: {
                    'username': username,
                    '_token': token
                },
                success: function (data) {
                    $("#showUser").html(data);
                }
            });
        });

        $('body').on('click', '.table__user__paginate .pagination li a', function (e) {
            e.preventDefault();
            const url = $(this).attr('href');
            $.ajax({
                url: url,
                beforeSend: overlayLoading(),
            }).done(function (response) {
                $('.table__user').html(response)
            })
            window.history.pushState('', '', url)
        });

        $('body').on('click', '.table__admin__paginate .pagination li a', function (e) {
            e.preventDefault();
            const url = $(this).attr('href');
            $.ajax({
                url: url,
                beforeSend: overlayLoading(),
            }).done(function (response) {
                $('.table__admin').html(response)
            })
            window.history.pushState('', '', url)
        });

        function overlayLoading() {
            $.LoadingOverlay("show");
            setTimeout(function () {
                $.LoadingOverlay("hide");
            });
        }
    });

</script>
@endpush
