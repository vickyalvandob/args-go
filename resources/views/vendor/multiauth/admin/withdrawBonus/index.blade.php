@extends('layouts.app', ['title' => 'Withdrawal Bonus','page' => 'admin'])

@section('content')
       <div class="row">
       <div class="col-md-12">
      <div class="card">
           <div class="card-header">
             Request
           </div>
           <form class="form-inline justify-content-center" action="" method="get">
            <div class="form-group m-1">
                <input class="form-control" placeholder="Search.." name="q" value="{{ request()->get('q') }}" type="text">
            </div>
            <div class="form-group m-1 text-right">
                    <button type="submit" class="btn btn-outline-primary m-1"> <i class="fa fa-search mr-1"></i> Find User</button>
            </div>
        </form>
            <div class="card-body table-responsive table__request">
                @include('admin.withdrawBonus.request')
            </div>
          </div>
      </div>

      <div class="col-md-12">
      <div class="card">
        <div class="card-header">
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
            <div class="card-body table-responsive table__requested">
                @include('admin.withdrawBonus.requested')
            </div>
          </div>
      </div>


    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $('body').on('click', '.request__paginate .pagination li a', function (e) {
                e.preventDefault();
                const url = $(this).attr('href');
                $.ajax({
                    url: url,
                    beforeSend: overlayLoading(),
                }).done(function (response) {
                    $('.table__request').html(response)
                })
                window.history.pushState('', '', url)
            });
            $('body').on('click', '.requested__paginate .pagination li a', function (e) {
                e.preventDefault();
                const url = $(this).attr('href');
                $.ajax({
                    url: url,
                    beforeSend: overlayLoading(),
                }).done(function (response) {
                    $('.table__requested').html(response)
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
