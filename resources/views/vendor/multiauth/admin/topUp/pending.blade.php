<table class="table table-borderless table-striped ">
    <thead>
        <tr class="text-uppercase">
        <th class="text-center aligh-middle">Date/Time</th>
        <th class="text-center aligh-middle">Username</th>
        <th class="text-center aligh-middle">Image</th>
        <th class="text-center aligh-middle">Amount </th>
        <th class="text-center aligh-middle">Tax </th>
        <th class="text-center aligh-middle">Charge </th>
        <th class="text-center aligh-middle">Note </th>
        <th class="text-center aligh-middle">Action </th>
      </tr>
    </thead>
    <tbody>
      @foreach($topUps_pending as $topUp)
      <tr>
          <td class="text-center aligh-middle">{{ $topUp->created_at->format("H:i, d F Y") }}</td>
          <td class="text-center aligh-middle">
            {{ $topUp->user->username ?? "-" }}
        </td>
        <td class="text-center align-middle">
            @if($topUp->proof_image != null)
              <a href="{{ asset('img/'.$topUp->proof_image.'') }}" target="_blank">
                  <img src="{{ asset('img/'.$topUp->proof_image.'') }}" width="50" alt="">
                </a>
                @else
-
                @endif
            </td>
            <td class="text-center aligh-middle">{{   number_format($topUp->amount, 2, ',', '.') ?? "-" }} <small>ARGS</small></td>
            <td class="text-center aligh-middle">{{   number_format($topUp->tax, 2, ',', '.') ?? "-" }} <small>ARGS</small></td>
            <td class="text-center aligh-middle"> {{   number_format($topUp->energy, 2, ',', '.') ?? "-" }} <small><i class="mdi mdi-flash"></i></small></td>
          <td class="text-center aligh-middle">{{ $topUp->note ?? "-" }}</td>
          <td class="text-center aligh-middle">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#approved{{ $topUp->id }}">
                approve
            </button>

            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#declined{{ $topUp->id }}">
                decline
            </button>

          </td>
      </tr>
        <div class="modal fade" id="approved{{ $topUp->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="{{ route('admin.topUp.update',$topUp->id) }}" enctype="multipart/form-data"  method="post">
                       @method('put')
                       @csrf
                        <div class="modal-body">
                            <div class="my-2 text-center card-box">
                                <h4> {{   number_format($topUp->amount, 2, ',', '.') ?? "-" }} <small>ARGS</small></h4>
                                <img src="{{ asset('img/'.$topUp->user->image.'') }}" height="30" width="30" class="img-shadow rounded-circle mr-1" alt=""> {{ $topUp->user->username ?? "-" }}
                            </div>
                            <input type="hidden" name="status" value="approved">
                            <div class="form-group">
                                <label class="text-white">Note</label>
                                <textarea name="note" class="form-control" rows="4">{{ $topUp->note }}</textarea>

                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block">approve</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="declined{{ $topUp->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="{{ route('admin.topUp.update',$topUp->id) }}" enctype="multipart/form-data"  method="post">
                       @method('put')
                       @csrf
                        <div class="modal-body">
                            <div class="my-2 text-center card-box">
                                <h4> {{   number_format($topUp->amount, 2, ',', '.') ?? "-" }} <small>ARGS</small></h4>
                                <img src="{{ asset('img/'.$topUp->user->image.'') }}" height="30" width="30" class="img-shadow rounded-circle mr-1" alt=""> {{ $topUp->user->username ?? "-" }}
                            </div>
                            <input type="hidden" name="status" value="declined">
                            <div class="form-group">
                                <label class="text-white">Note</label>
                                <textarea name="note" class="form-control" rows="4">{{ $topUp->note }}</textarea>

                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-danger btn-block">decline</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      @endforeach
    </tbody>
  </table>
<div class="row justify-content-center request__paginate">
    {{ $topUps_pending->links('pagination::bootstrap-4') }}
</div>
