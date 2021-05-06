@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-md-4">
        <div class="card-box">
            <h4 class="header-title">
            Transfer
            </h4>
            <br>
            <form action="{{ route('user.transfer.store') }}" enctype="multipart/form-data" class="text-capitalize row" method="post">
                @csrf
                <div class="form-group col-md-12">
                    <label>Username </label>
                    <input class="form-control " placeholder="Username to transfer" name="username" id="username" type="text" required>
                        <small class="text-primary pull-right clearfix my-1" id="showRecipient"> </small>
                </div>
                <div class="form-group col-md-6">
                    <label>amount</label>
                    <input type="text" name="amount" placeholder="amount" class="form-control" value="{{ old('amount') }}">

                </div>
                <div class="form-group col-md-6">
                    <label>Type</label>
                    <select class="form-control" name="type" required style="width:100%" data-toggle="select2">
                        <option value="">Select</option>
                        <option value="ARGS"> ARGS </option>
                        <option value="GAST"> GAST </option>
                        <option value="TTG"> TTG </option>
                    </select>
                </div>
                <div class="form-group col-md-12">
                    <label>note</label>
                    <textarea name="note" placeholder="note" rows="3" class="form-control">{{ old('note') }}</textarea>
                </div>
                <div class="col-md-12 mb-2">
                    <small>Fee {{ $general->transfer_tax }}% Tax and  <small>{{ $general->transfer_ttg }} <small>TTG</small></small></small>
                </div>
                <div class="form-group col-md-12">
                    <button class="btn btn-primary btn-block" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card-box">
            <h4 class="header-title">
                History
            </h4>
            <br>
            <div class="table-responsive">
                <table class="table table-borderless table-striped">
                    <thead class="text-uppercase">
                    <tr>
                        <th class="text-center align-middle">Date/Time</th>
                        <th class="text-center align-middle">Username</th>
                        <th class="text-center align-middle">Amount</th>
                        <th class="text-center align-middle">Energy</th>
                        <th class="text-center align-middle">Tax </th>
                        <th class="text-center align-middle">Charge</th>
                        <th class="text-center align-middle">Note</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transfers as $transfer)
                        <tr>
                            <td class="text-center align-middle">{{ $transfer->created_at->format("H:i, d F Y") ?? "-" }}</td>
                            <td class="text-center align-middle">{{ $transfer->recipient->username ?? "-" }}</td>
                            <td class="text-center align-middle">{{ number_format($transfer->amount , 2, ',', '.') ?? "-" }} <small>{{ $transfer->type ?? "-" }}</small></td>
                            <td class="text-center align-middle">{{ number_format($transfer->energy) ?? "-" }}</td>
                            <td class="text-center align-middle">{{ number_format($transfer->tax , 2, ',', '.') ?? "-" }}</td>
                            <td class="text-center align-middle">{{ number_format($transfer->ttg , 2, ',', '.') ?? "-" }} <small>TTG</small></td>
                            <td class="text-center align-middle">{{ $transfer->note ?? "-" }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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
                url: "{{ route('getRecipient') }}",
                data: {
                    'username': username,
                    '_token': token
                },
                success: function (data) {
                    $("#showRecipient").html(data);
                }
            });
        });

    });

</script>
@endpush
