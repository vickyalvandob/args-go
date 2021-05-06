@extends('multiauth::layouts.app')
@section('content')

<div class="row">
@foreach ($puzzles as $puzzle)
        <div class="col-md-6">
            <div class="card-box">
                    @php
                    $puzzlePieces = \App\PuzzlePiece::where('puzzle_id', $puzzle->id)->get();
                @endphp
                <div class="row mb-3">
                    @if ($puzzle->pieces == 12)
                    @foreach ($puzzlePieces as $puzzlePiece)
                        <div class="col-md-3 p-1">
                            <div @if ($puzzlePiece->status == "hide") class="w3-opacity-max" @endif>
                                <a href="#"  data-toggle="modal" data-target="#editpuzzlePiece{{ $puzzlePiece->id }}">
                                    <img src="{{ asset('img/'.$puzzlePiece->image.'') }}" class="img-fluid img-shadow" alt="">
                                    </a>
                                    <div class="w3-display-topright">
                                       <span class="badge badge-primary"> {{ number_format($puzzlePiece->energy) }} <small><i class="mdi mdi-flash"></i></small></span>
                                    </div>
                            </div>

                            <div class="modal fade" id="editpuzzlePiece{{ $puzzlePiece->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body w3-round-xlarge">
                                            <div class="my-3 text-center">
                                                <img src="{{ asset('img/'.$puzzlePiece->image.'') }}" height="100" class="img-shadow" alt="">
                                            </div>
                                            <form action="{{ route('admin.puzzlePiece.update', $puzzlePiece->id) }}" enctype="multipart/form-data" class="text-capitalize " method="post">
                                                @csrf
                                                @method('put')
                                                <div class="form-group col-md-12">
                                                    <label class="control-label mb-10">title</label>
                                                    <input type="text" value="{{ $puzzlePiece->title }}" class="form-control" name="title" placeholder="Title">
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label class="control-label mb-10">energy</label>
                                                            <input type="number" min="1" value="{{ $puzzlePiece->energy }}" class="form-control" name="energy" placeholder="Qty">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="control-label mb-10">Qty</label>
                                                            <input type="number" value="{{ $puzzlePiece->qty }}" class="form-control" name="qty" placeholder="qty">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label class="control-label mb-10">status</label>
                                                    <select class="form-control" name="status" style="width:100%" data-toggle="select2">
                                                        <option value="">Select</option>
                                                        <option value="show" @if ($puzzlePiece->status == "show")
                                                            selected
                                                        @endif> Show </option>
                                                        <option value="hide" @if ($puzzlePiece->status == "hide")
                                                            selected
                                                        @endif> Hide </option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label class="control-label mb-10">image</label>
                                                    <input type="file" class="form-control" name="image" placeholder="image">
                                                    <small>Fill if you want to change</small>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <button type="submit" class="btn btn-primary w3-round-xlarge my-1 btn-block">save change</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach
                    @elseif ($puzzle->pieces == 16)
                        @foreach ($puzzlePieces as $puzzlePiece)
                            <div class="col-md-3 p-1">
                                <div @if ($puzzlePiece->status == "hide") class="w3-opacity-max" @endif>
                                    <a href="#"  data-toggle="modal" data-target="#editpuzzlePiece{{ $puzzlePiece->id }}">
                                        <img src="{{ asset('img/'.$puzzlePiece->image.'') }}" class="img-fluid img-shadow" alt="">
                                        </a>
                                        <div class="w3-display-topright">
                                           <span class="badge badge-primary"> {{ number_format($puzzlePiece->energy) }} <small><i class="mdi mdi-flash"></i></small></span>
                                        </div>
                                </div>

                                <div class="modal fade" id="editpuzzlePiece{{ $puzzlePiece->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body w3-round-xlarge">
                                                <div class="my-3 text-center">
                                                    <img src="{{ asset('img/'.$puzzlePiece->image.'') }}" height="100" class="img-shadow" alt="">
                                                </div>
                                                <form action="{{ route('admin.puzzlePiece.update', $puzzlePiece->id) }}" enctype="multipart/form-data" class="text-capitalize " method="post">
                                                    @csrf
                                                    @method('put')
                                                    <div class="form-group col-md-12">
                                                        <label class="control-label mb-10">title</label>
                                                        <input type="text" value="{{ $puzzlePiece->title }}" class="form-control" name="title" placeholder="Title">
                                                    </div>
                                                   <div class="col-md-12">
                                                       <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label class="control-label mb-6">energy</label>
                                                            <input type="number" min="1" value="{{ $puzzlePiece->energy }}" class="form-control" name="energy" placeholder="Qty">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="control-label mb-10">status</label>
                                                            <select class="form-control" name="status" style="width:100%" data-toggle="select2">
                                                                <option value="">Select</option>
                                                                <option value="show" @if ($puzzlePiece->status == "show")
                                                                    selected
                                                                @endif> Show </option>
                                                                <option value="hide" @if ($puzzlePiece->status == "hide")
                                                                    selected
                                                                @endif> Hide </option>
                                                            </select>
                                                        </div>
                                                       </div>
                                                   </div>
                                                    <div class="form-group col-md-12">
                                                        <label class="control-label mb-10">image</label>
                                                        <input type="file" class="form-control" name="image" placeholder="image">
                                                        <small>Fill if you want to change</small>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <button type="submit" class="btn btn-primary w3-round-xlarge my-1 btn-block">save change</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    @endif
                </div>

                <form action="{{ route('admin.puzzle.update', $puzzle->id) }}" enctype="multipart/form-data" class="row text-capitalize " method="post">
                    @csrf
                    @method('put')
                        <div class="form-group col-md-12">
                            <label class="control-label mb-10">title</label>
                            <input type="text" value="{{ $puzzle->title }}" class="form-control" name="title" placeholder="Title">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label mb-10">Claim</label>
                            <input type="text" class="form-control" name="amount" value="{{ $puzzle->amount }}" placeholder="Amount TTG">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label mb-10">Combine</label>
                            <input type="text" class="form-control" name="amount_combine" value="{{ $puzzle->amount_combine }}" placeholder="Amount TTG">
                        </div>
                        <div class="form-group col-md-12">
                            <label class="control-label mb-10">image</label>
                            <input type="file" class="form-control" name="image" placeholder="image">
                            <small>Fill if you want to change</small>
                        </div>
                        <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-primary w3-round-xlarge my-1 btn-block">save change</button>
                        </div>
                </form>
            </div>
        </div>
    @endforeach
</div>

@endsection
