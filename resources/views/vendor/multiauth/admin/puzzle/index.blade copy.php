@extends('multiauth::layouts.app')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <h4 class="header-title">
            Puzzle <a href="#" data-toggle="modal" data-target="#create"><i class="fa fa-plus-circle"></i></a>
            </h4>


            <div class="modal fade" id="create" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="m-0"> Create Puzzle</h5>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.puzzle.store') }}" enctype="multipart/form-data" class="text-capitalize row" method="post">
                                @csrf
                                <div class="form-group col-md-6">
                                    <label class="control-label mb-10">title</label>
                                    <input type="text" class="form-control" name="title" placeholder="title">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>pieces</label>
                                    <select class="form-control" name="pieces" style="width:100%" data-toggle="select2">
                                        <option value="12">12</option>
                                        <option value="16">16</option>
                                    </select>
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
                    @foreach ($puzzles as $puzzle)
                    <tr @if ($puzzle->status == 'hide') class="bg-soft-danger" @endif>

                        <td class="text-center align-middle">
                            @php
                             $pieces = \App\PuzzlePiece::where('puzzle_id', $puzzle->id)->get();
                            @endphp



 <div class="row">
     @foreach ($pieces as $piece)
                            <div class="col-md-4">
                             <a href="{{ asset('img/'.$piece->image.'') }}" target="_blank">
                                 <img src="{{ asset('img/'.$piece->image.'') }}" width="50" alt="">
                             </a>
                            </div>
                            @endforeach
 </div>



                         </td>
                        <td class="text-center align-middle">
                            <a href="{{ route('admin.puzzle.show', $puzzle->id) }}">
                                {{ $puzzle->title ?? "-" }}
                            </a>
                        </td>


                        <td class="text-center align-middle">{{ number_format($puzzle->amount , 2, ',', '.') ?? "-" }}</td>
                        <td class="text-center align-middle">{{ number_format($puzzle->energy) ?? "-" }}</td>
                        <td class="text-center align-middle">
                            <a href="{{ route('admin.puzzle.show', $puzzle->id) }}" class="m-1"><i class="mdi mdi-eye"></i></a>
                            <a href="#"  data-toggle="modal" data-target="#edit{{ $puzzle->id }}" class="m-1"><i class="mdi mdi-circle-edit-outline"></i></a>
                            <a href="#" onclick="confirm1Tag({{ $puzzle->id }})" class="m-1"><i class="mdi mdi-delete"></i></a>
                            <form id="confirm1-form-{{ $puzzle->id }}" action="{{ route('admin.puzzle.destroy',[$puzzle->id]) }}" method="POST" style="display: none;">
                                @csrf @method('delete')
                            </form>
                        </td>

                    </tr>
                    <div class="modal fade" id="edit{{ $puzzle->id }}" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="m-0"> Edit Puzzle</h5>
                                 </div>
                                 <div class="modal-body">
                                    <form action="{{ route('admin.puzzle.update',$puzzle->id) }}" enctype="multipart/form-data" class="text-capitalize " method="post">
                                        @csrf
                                        @method('put')
                                         <div class="row text-capitalize">
                                            <div class="form-group col-md-12">
                                                <label class="control-label mb-10">title</label>
                                                <input type="text" class="form-control" name="title" value="{{ $puzzle->title }}"  placeholder="title">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>pieces</label>
                                                <select class="form-control" name="pieces" style="width:100%" data-toggle="select2">
                                                    <option value="12" @if ($puzzle->pieces == 12)
                                                        selected
                                                    @endif>12</option>
                                                    <option value="16" @if ($puzzle->pieces == 16)
                                                        selected
                                                    @endif>16</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="control-label mb-10">Amount</label>
                                                <input type="text" class="form-control" name="amount" value="{{ $puzzle->amount }}" placeholder="amount">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="control-label mb-10">energy</label>
                                                <input type="text" class="form-control" name="energy" value="{{ $puzzle->energy }}" placeholder="energy">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>status</label>
                                                <select class="form-control" name="status" style="width:100%" data-search="false">
                                                    <option value="">Select</option>
                                                    <option value="show" @if ($puzzle->status == "show")
                                                        selecter
                                                    @endif> Show </option>
                                                    <option value="hide" @if ($puzzle->status == "hide")
                                                        selecter
                                                    @endif> Hide </option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="control-label mb-10">image</label>
                                                <input type="file" class="form-control" name="image" placeholder="image">
                                                <small>Fill if you want to change</small>
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
</div>


@endsection
