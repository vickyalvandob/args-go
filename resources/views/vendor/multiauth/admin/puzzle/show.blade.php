@extends('multiauth::layouts.app')
@section('content')

<div class="row">
    <div class="col-md-4">
        <div class="card-box">
            <h4 class="header-title">
            Puzzle Piece <a href="#" data-toggle="modal" data-target="#create"><i class="fa fa-plus-circle"></i></a>
            </h4>


            <div class="modal fade" id="create" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="m-0"> Create Puzzle Piece</h5>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.puzzlePiece.store') }}" enctype="multipart/form-data" class="text-capitalize row" method="post">
                                @csrf
                                <div class="form-group col-md-12">
                                    <label class="control-label mb-10">title</label>
                                    <input type="text" class="form-control" name="title" placeholder="title">
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="control-label mb-10">image</label>
                                    <input type="file" class="form-control" name="image" placeholder="image">
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
                                <button type="submit" class="btn btn-primary my-1 btn-block">Submit</button>
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
                    @foreach ($puzzlePieces as $puzzlePiece)
                    <tr @if ($puzzlePiece->status == 'hide') class="bg-soft-danger" @endif>

                        <td class="text-center align-middle">
                            <a href="{{ asset('img/'.$puzzlePiece->image.'') }}" target="_blank">
                                <img src="{{ asset('img/'.$puzzlePiece->image.'') }}" width="50" alt="">
                            </a>
                        </td>
                        <td class="text-center align-middle">
                            <a href="{{ route('admin.puzzlePiece.show', $puzzlePiece->id) }}">
                                {{ $puzzlePiece->title ?? "-" }}
                            </a>
                        </td>
                        <td class="text-center align-middle">{{ number_format($puzzlePiece->amount , 2, ',', '.') ?? "-" }}</td>
                        <td class="text-center align-middle">{{ number_format($puzzlePiece->energy) ?? "-" }}</td>
                        <td class="text-center align-middle">
                            <a href="{{ route('admin.puzzlePiece.show', $puzzlePiece->id) }}" class="m-1"><i class="mdi mdi-eye"></i></a>
                            <a href="#"  data-toggle="modal" data-target="#edit{{ $puzzlePiece->id }}" class="m-1"><i class="mdi mdi-circle-edit-outline"></i></a>
                            <a href="#" onclick="confirm1Tag({{ $puzzlePiece->id }})" class="m-1"><i class="mdi mdi-delete"></i></a>
                            <form id="confirm1-form-{{ $puzzlePiece->id }}" action="{{ route('admin.puzzlePiece.destroy',[$puzzlePiece->id]) }}" method="POST" style="display: none;">
                                @csrf @method('delete')
                            </form>
                        </td>

                    </tr>
                    <div class="modal fade" id="edit{{ $puzzlePiece->id }}" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="m-0"> Edit Puzzle Piece</h5>
                                 </div>
                                 <div class="modal-body">
                                    <form action="{{ route('admin.puzzlePiece.update',$puzzlePiece->id) }}" enctype="multipart/form-data" class="text-capitalize " method="post">
                                        @csrf
                                        @method('put')
                                         <div class="row text-capitalize">
                                            <div class="form-group col-md-12">
                                                <label class="control-label mb-10">title</label>
                                                <input type="text" class="form-control" name="title" value="{{ $puzzlePiece->title }}"  placeholder="title">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="control-label mb-10">image</label>
                                                <input type="file" class="form-control" name="image" placeholder="image">
                                                <small>Fill if you want to change</small>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="control-label mb-10">Amount</label>
                                                <input type="text" class="form-control" name="amount" value="{{ $puzzlePiece->amount }}" placeholder="amount">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="control-label mb-10">energy</label>
                                                <input type="text" class="form-control" name="energy" value="{{ $puzzlePiece->energy }}" placeholder="energy">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>status</label>
                                                <select class="form-control" name="status" style="width:100%" data-search="false">
                                                    <option value="">Select</option>
                                                    <option value="show" @if ($puzzlePiece->status == "show")
                                                        selecter
                                                    @endif> Show </option>
                                                    <option value="hide" @if ($puzzlePiece->status == "hide")
                                                        selecter
                                                    @endif> Hide </option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12">
                                            <button type="submit" class="btn btn-primary my-1 btn-block">Submit</button>
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

    <div class="col-md-8">
        <div class="card-box">
            <h4 class="header-title">
                Collection
            </h4>
            <br>
                <table id="datatable2" class="table table-bordered dt-responsive nowrap">
                    <thead>
                        <tr class="text-uppercase">
                            <th class="text-center align-middle">Date / Time</th>
                            <th class="text-center aligh-middle">PuzzlePiece</th>
                            <th class="text-center aligh-middle">Username</th>
                            <th class="text-center aligh-middle">Proof Image</th>
                            <th class="text-center aligh-middle">Recipient Name</th>
                            <th class="text-center aligh-middle">Recipient Address</th>
                            <th class="text-center aligh-middle">Amount </th>
                            <th class="text-center aligh-middle">Energy </th>
                            <th class="text-center aligh-middle">Note </th>
                            <th class="text-center aligh-middle">Status </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($puzzlePieceCollects as $puzzlePieceCollect)
                        <tr>
                            <td class="text-center aligh-middle">{{ $puzzlePieceCollect->created_at ?? "-" }}</td>
                            <td class="text-center aligh-middle">
                                {{ $puzzlePieceCollect->reward->title ?? "-" }}
                            </td>
                            <td class="text-center aligh-middle">
                                <a href="{{ route('user.show',$puzzlePieceCollect->user_id) }}">
                                    {{ $puzzlePieceCollect->user->username ?? "-" }}
                                </a>
                            </td>
                            <td class="text-center aligh-middle">
                                <a href="{{ asset('img/'.$puzzlePieceCollect->proof_image.'') }}" target="_blank">
                                    <img src="{{ asset('img/'.$puzzlePieceCollect->proof_image.'') }}" alt="" class="img-fluid" width="50">
                                </a>
                            </td>
                            <td class="text-center aligh-middle">{{ $puzzlePieceCollect->recipient_name ?? "-" }}</td>
                            <td class="text-center aligh-middle">{{ $puzzlePieceCollect->recipient_address ?? "-" }}</td>

                            <td class="text-center align-middle">{{   number_format($puzzlePieceCollect->amount, 2, ',', '.') ?? "-" }}</td>
                            <td class="text-center aligh-middle">{{ number_format($puzzlePieceCollect->energy) ?? "-" }}</td>
                            <td class="text-center aligh-middle">{{ $puzzlePieceCollect->note ?? "-" }}</td>
                            <td class="text-center aligh-middle">
                                @if($puzzlePieceCollect->status == 'process')
                                <span class="badge text-uppercase badge-outline-success">process</span>
                                @elseif($puzzlePieceCollect->status == 'declined')
                                <span class="badge text-uppercase badge-outline-danger">declined</span>
                                @elseif($puzzlePieceCollect->status == 'requested')
                                <span class="badge text-uppercase badge-outline-secondary">requested</span>
                                @elseif($puzzlePieceCollect->status == 'done')
                                <span class="badge text-uppercase badge-outline-primary">done</span>
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
