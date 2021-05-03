@extends('multiauth::layouts.app')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <h4 class="header-title">
            reward <a href="#" data-toggle="modal" data-target="#create"><i class="fa ml-1 fa-plus-circle"></i></a>
            </h4>


            <div class="modal fade" id="create" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form action="{{ route('admin.reward.store') }}" enctype="multipart/form-data" class="text-capitalize row" method="post">
                                @csrf
                                <div class="form-group col-md-12">
                                    <label class="control-label mb-10">title</label>
                                    <input type="text" class="form-control" name="title" placeholder="title">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label mb-10">Amount</label>
                                    <input type="text" class="form-control" name="amount" placeholder="amount">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label mb-10">energy</label>
                                    <input type="text" class="form-control" name="energy" placeholder="energy">
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="control-label mb-10">image</label>
                                    <input type="file" class="form-control" name="image" placeholder="image">
                                </div>
                                <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-primary my-1 btn-block">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <br>
           <div class="table-responsive">
            <table class="table table-borderless table-striped">
                <thead>
                    <tr class="text-uppercase">
                        <th class="text-center align-middle">Image</th>
                        <th class="text-center align-middle">Title</th>
                        <th class="text-center align-middle">Amount</th>
                        <th class="text-center align-middle">energy</th>
                        <th class="text-center align-middle">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rewards as $reward)
                    <tr @if ($reward->status == 'hide') class="bg-soft-danger" @endif>
                        <td class="text-center align-middle">
                            <a href="{{ asset('img/'.$reward->image.'') }}" target="_blank">
                                <img src="{{ asset('img/'.$reward->image.'') }}" height="50" alt="">
                            </a>
                        </td>
                        <td class="text-center align-middle">{{ $reward->title ?? "-" }}</td>
                        <td class="text-center align-middle">{{ number_format($reward->amount , 2, ',', '.') ?? "-" }}</td>
                        <td class="text-center align-middle">{{ number_format($reward->energy) ?? "-" }}</td>
                        <td class="text-center align-middle">
                            <a href="#"  data-toggle="modal" data-target="#edit{{ $reward->id }}" class="m-1"><i class="mdi mdi-circle-edit-outline"></i></a>
                            <a href="#" onclick="confirm1Tag({{ $reward->id }})" class="m-1"><i class="mdi mdi-delete"></i></a>
                            <form id="confirm1-form-{{ $reward->id }}" action="{{ route('admin.reward.destroy',[$reward->id]) }}" method="POST" style="display: none;">
                                @csrf @method('delete')
                            </form>
                        </td>

                    </tr>



                    <div class="modal fade" id="edit{{ $reward->id }}" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                 <div class="modal-body">
                                     <div class="text-center my-3">
                                        <img src="{{ asset('img/'.$reward->image.'') }}" style="max-height: 100px" alt="" class="img-fluid img-shadow">
                                     </div>
                                    <form action="{{ route('admin.reward.update',$reward->id) }}" enctype="multipart/form-data" class="text-capitalize " method="post">
                                        @csrf
                                        @method('put')
                                         <div class="row text-capitalize">
                                            <div class="form-group col-md-12">
                                                <label class="control-label mb-10">title</label>
                                                <input type="text" class="form-control" name="title" value="{{ $reward->title }}" placeholder="title">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="control-label mb-10">Amount</label>
                                                <input type="text" class="form-control" name="amount" value="{{ $reward->amount }}" placeholder="amount">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="control-label mb-10">energy</label>
                                                <input type="text" class="form-control" name="energy" value="{{ $reward->energy }}" placeholder="energy">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="control-label mb-10">image</label>
                                                <input type="file" class="form-control" name="image" placeholder="image">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>status</label>
                                                <select class="form-control" name="status" style="width:100%" data-search="false">
                                                    <option value="">Select</option>
                                                    <option value="show" @if ($reward->status == "show")
                                                        selected
                                                    @endif> Show </option>
                                                    <option value="hide" @if ($reward->status == "hide")
                                                        selected
                                                    @endif> Hide </option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12">
                                            <button type="submit" class="btn btn-primary my-1 btn-block">save change</button>
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
           </div>

        </div>
    </div>

</div>


@endsection
