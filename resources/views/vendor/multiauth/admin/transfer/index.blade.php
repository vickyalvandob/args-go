@extends('multiauth::layouts.app')

@section('content')
<div id="accordianId" role="tablist" aria-multiselectable="true">
    <div class="">
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
                <div class="form-group col-md-4">
                    <label>Amount</label>
                    <input type="text" name="amount" class="form-control" placeholder="Amount" required>
                </div>
                <div class="form-group col-md-4">
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
</div>

<div class="row">


    <div class="col-md-6">
        <div class="card-box">
            User
            <div class="search-form m-2">
                <form action="#"  method="get">
                    <input type="text" class="form-control form-contro-sm" placeholder="Search.."  name="q" value="{{ $search ?? '' }}">
                    <button type="submit" class="btn btn-primary btn-rounded"><i class="dripicons-search"></i></button>
                </form>
            </div>

            <div class="table__user table-responsive">
                @include('multiauth::admin.transfer.table_user')
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card-box">
            Admin
            <div class="search-form m-2">
                <form action="#"  method="get">
                    <input type="text" class="form-control form-contro-sm" placeholder="Search.."  name="qq" value="{{ $search ?? '' }}">
                    <button type="submit" class="btn btn-primary btn-rounded"><i class="dripicons-search"></i></button>
                </form>
            </div>
            <div class="table__admin table-responsive">
                @include('multiauth::admin.transfer.table_admin')
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
