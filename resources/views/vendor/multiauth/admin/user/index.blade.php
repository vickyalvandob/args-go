@extends('multiauth::layouts.app')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card-box">
            <h4 class="header-title">
            list <a href="{{ route('admin.user.create') }}"><i class="fa fa-plus-circle"></i></a>
            </h4>

            <div class="row justify-content-center">
                <div class="col-md-6">
                   <form class="form-inline justify-content-center" action="" method="get">
                       <div class="form-group m-1">
                           <input class="form-control" placeholder="Search.." value="{{ request()->get('q') }}" name="q"  type="text" >
                       </div>
                       <div class="form-group m-1 text-right">
                            <button type="submit" class="btn btn-primary m-1"> <i class="fa fa-search mr-1"></i> Find User</button>
                       </div>
                   </form>
                </div>
            </div>
            <div class="table__user">
                @include('multiauth::admin.user.table_user')
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
    <script>
        $(document).ready(function(){
            $('body').on('click', '.table__paginate__user .pagination li a', function (e) {
                e.preventDefault();
                const url = $(this).attr('href');
                $.ajax({
                    url: url,
                    beforeSend: overlayLoading()
                }).done(function (response) {
                    $('.table__user').html(response)
                })
                window.history.pushState('', '', url)
            });
            function overlayLoading() {
            $.LoadingOverlay("show");
            setTimeout(function(){
                $.LoadingOverlay("hide");
            });
        }
        });
    </script>
@endpush
