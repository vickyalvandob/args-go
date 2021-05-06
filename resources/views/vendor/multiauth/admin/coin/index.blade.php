@extends('multiauth::layouts.app')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <h4 class="header-title">
            Coin <a href="#" data-toggle="modal" data-target="#create"><i class="fa fa-plus-circle"></i></a>
            </h4>


            <div class="modal fade" id="create" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <h5> Create Coin GAST</h5>
                            <br>
                            <form action="{{ route('admin.coin.store') }}" enctype="multipart/form-data" class="text-capitalize row" method="post">
                                @csrf
                                <div class="form-group col-md-4">
                                    <label class="control-label mb-10">Amount</label>
                                    <input type="text" class="form-control" name="amount" placeholder="amount">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label mb-10">qty</label>
                                    <input type="text" class="form-control" name="qty" placeholder="qty">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label mb-10">energy</label>
                                    <input type="text" class="form-control" name="energy" placeholder="energy">
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="control-label mb-10">Image</label>
                                    <input type="file" class="form-control" name="image" placeholder="image">
                                </div>
                                <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-primary my-1 btn-block">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

{{-- <br>
<div class="search-form md-3">
    <form action="#"  method="get">
        <input type="text" class="form-control form-contro-sm" placeholder="Search.."  name="q" value="{{ $search ?? '' }}">
        <button type="submit" class="btn btn-primary btn-rounded"><i class="dripicons-search"></i></button>
    </form>
</div> --}}
            <br>

            <div class="table-responsive">
                <table class="table table-borderless table-striped">
                    <thead>
                        <tr class="text-uppercase">
                            <th class="text-center align-middle">Image</th>
                            <th class="text-center align-middle">Amount</th>
                            <th class="text-center align-middle">energy</th>
                            <th class="text-center align-middle">qty</th>
                            <th class="text-center align-middle">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coins as $coin)
                        <tr @if ($coin->status == 'hide') class="bg-soft-danger" @endif>
                            <td class="text-center align-middle">
                                @if($coin->image != null)
                                <a href="{{ asset('img/'.$coin->image.'') }}" target="_blank">
                                    <img src="{{ asset('img/'.$coin->image.'') }}" width="50" alt="">
                                  </a>
                                  @else
          -
                                  @endif
                              </td>
                            <td class="text-center align-middle">{{ number_format($coin->amount , 2, ',', '.') ?? "-" }} <small>GAST</small></td>
                            <td class="text-center align-middle">{{ number_format($coin->energy) ?? "-" }} <i class="mdi mdi-flash text-warning"></i></td>
                            <td class="text-center align-middle">{{ number_format($coin->qty) ?? "-" }}</td>
                            <td class="text-center align-middle">
                                <a href="#"  data-toggle="modal" data-target="#edit{{ $coin->id }}" class="m-1"><i class="mdi mdi-circle-edit-outline"></i></a>
                                <a href="#" onclick="confirm1Tag({{ $coin->id }})" class="m-1"><i class="mdi mdi-delete"></i></a>
                                <form id="confirm1-form-{{ $coin->id }}" action="{{ route('admin.coin.destroy',[$coin->id]) }}" method="POST" style="display: none;">
                                    @csrf @method('delete')
                                </form>
                            </td>

                        </tr>



                        <div class="modal fade" id="edit{{ $coin->id }}" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                     <div class="modal-body">
                                        <div class="text-center my-2">
                                            <a href="{{ asset('img/'.$coin->image.'') }}" target="_blank">
                                                <img src="{{ asset('img/'.$coin->image.'') }}" width="80" class="img-shadow" alt="">
                                              </a>
                                              <h4> {{ $coin->amount }} <small>GAST</small></h4>
                                              <br>
                                        </div>
                                        <form action="{{ route('admin.coin.update',$coin->id) }}" enctype="multipart/form-data" class="text-capitalize " method="post">
                                            @csrf
                                            @method('put')
                                             <div class="row text-capitalize">
                                                <div class="form-group col-md-4">
                                                    <label class="control-label mb-10">Amount</label>
                                                    <input type="text" class="form-control" name="amount" value="{{ $coin->amount }}" placeholder="amount">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label class="control-label mb-10">energy</label>
                                                    <input type="text" class="form-control" name="energy" value="{{ $coin->energy }}" placeholder="energy">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label class="control-label mb-10">qty</label>
                                                    <input type="text" class="form-control" name="qty" value="{{ $coin->qty }}" placeholder="qty">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>status</label>
                                                    <select class="form-control" name="status" style="width:100%" data-search="false">
                                                        <option value="">Select</option>
                                                        <option value="show" @if ($coin->status == "show")
                                                            selected
                                                        @endif> Show </option>
                                                        <option value="hide" @if ($coin->status == "hide")
                                                            selected
                                                        @endif> Hide </option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label class="control-label mb-10">Image</label>
                                                    <input type="file" class="form-control" name="image" placeholder="image">
                                                </div>
                                                <div class="form-group col-md-12">
                                                <button type="submit" class="btn btn-primary my-1 btn-block">update</button>
                                                </div>
                                             </div>
                                         </form>
                                     </div>
                                </div>
                            </div>
                        </div>


                        @endforeach
                    </tbody>
                </table>
                <div class="row justify-content-center">
                    {{ $coins->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
