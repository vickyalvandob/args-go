@extends('multiauth::layouts.app')

@section('content')
       <div class="row">
       <div class="col-md-12">
      <div class="card-box">
           <div class="">
             Pending
           </div>
           <form class="form-inline justify-content-center" action="" method="get">
            <div class="form-group m-1">
                <input class="form-control" placeholder="Search.." name="q" value="{{ request()->get('q') }}" type="text">
            </div>
            <div class="form-group m-1 text-right">
                    <button type="submit" class="btn btn-outline-primary m-1"> <i class="fa fa-search mr-1"></i> Find User</button>
            </div>
        </form>
            <div class="table-responsive table__pending">
                @include('multiauth::admin.topUp.pending')
            </div>
          </div>
      </div>

      <div class="col-md-12">
      <div class="card-box">
        <div class="">
          History
        </div>
        <form class="form-inline justify-content-center" action="" method="get">
            <div class="form-group m-1">
                <input class="form-control" placeholder="Search.." name="qc" value="{{ request()->get('qc') }}" type="text">
            </div>
            <div class="form-group m-1 text-right">
                    <button type="submit" class="btn btn-outline-primary m-1"> <i class="fa fa-search mr-1"></i> Find User</button>
            </div>
        </form>
            <div class="table-responsive table__history">
                @include('multiauth::admin.topUp.history')
            </div>
          </div>
      </div>


    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $('body').on('click', '.pending__paginate .pagination li a', function (e) {
                e.preventDefault();
                const url = $(this).attr('href');
                $.ajax({
                    url: url,
                    beforeSend: overlayLoading(),
                }).done(function (response) {
                    $('.table__pending').html(response)
                })
                window.history.pushState('', '', url)
            });
            $('body').on('click', '.history__paginate .pagination li a', function (e) {
                e.preventDefault();
                const url = $(this).attr('href');
                $.ajax({
                    url: url,
                    beforeSend: overlayLoading(),
                }).done(function (response) {
                    $('.table__history').html(response)
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
