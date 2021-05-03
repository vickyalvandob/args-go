<table class="table table-borderless table-striped ">
    <thead>
        <tr class="text-uppercase">
        <th class="text-center aligh-middle">Date / Time</th>
        <th class="text-center aligh-middle">Username</th>
        <th class="text-center aligh-middle">Amount </th>
        <th class="text-center aligh-middle">Tax </th>
        <th class="text-center aligh-middle">Charge </th>
        <th class="text-center aligh-middle">Note </th>
        <th class="text-center aligh-middle">Action </th>
      </tr>
    </thead>
    <tbody>
      @foreach($payouts_pending as $payout)
      <tr>
          <td class="text-center aligh-middle">{{ $payout->created_at->format("H:i, d F Y") }}</td>
          <td class="text-center aligh-middle">
            {{ $payout->user->username ?? "-" }}
        </td>
            <td class="text-center aligh-middle">{{   number_format($payout->amount, 2, ',', '.') ?? "-" }} <small>ARGS</small></td>
            <td class="text-center aligh-middle">{{   number_format($payout->tax, 2, ',', '.') ?? "-" }} <small>ARGS</small></td>
            <td class="text-center aligh-middle"> {{   number_format($payout->energy, 2, ',', '.') ?? "-" }} <small><i class="mdi mdi-flash"></i></small></td>
          <td class="text-center aligh-middle">{{ $payout->note ?? "-" }}</td>
          <td class="text-center aligh-middle">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#approved{{ $payout->id }}">
                approve
            </button>

            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#declined{{ $payout->id }}">
                decline
            </button>

          </td>
      </tr>
        <div class="modal fade" id="approved{{ $payout->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="{{ route('admin.payout.update',$payout->id) }}" enctype="multipart/form-data"  method="post">
                       @method('put')
                       @csrf
                        <div class="modal-body">
                            <div class="my-2 text-center card-box">
                                <h4> {{   number_format($payout->amount, 2, ',', '.') ?? "-" }} <small>ARGS</small></h4>
                                <img src="{{ asset('img/'.$payout->user->image.'') }}" height="30" width="30" class="img-shadow rounded-circle mr-1" alt=""> {{ $payout->user->username ?? "-" }}
                            </div>
                            <input type="hidden" name="status" value="approved">
                            <div class="form-group">
                                <label class="text-white">Proof Image</label>
                                <input type="file" name="proof_image" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="text-white">Note</label>
                                <textarea name="note" class="form-control" rows="4">{{ $payout->note }}</textarea>

                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block">approve</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="declined{{ $payout->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="{{ route('admin.payout.update',$payout->id) }}" enctype="multipart/form-data"  method="post">
                       @method('put')
                       @csrf
                        <div class="modal-body">
                            <div class="my-2 text-center card-box">
                                <h4> {{   number_format($payout->amount, 2, ',', '.') ?? "-" }} <small>ARGS</small></h4>
                                <img src="{{ asset('img/'.$payout->user->image.'') }}" height="30" width="30" class="img-shadow rounded-circle mr-1" alt=""> {{ $payout->user->username ?? "-" }}
                            </div>
                            <input type="hidden" name="status" value="declined">
                            <div class="form-group">
                                <label class="text-white">Note</label>
                                <textarea name="note" class="form-control" rows="4">{{ $payout->note }}</textarea>

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
    {{ $payouts_pending->links('pagination::bootstrap-4') }}
</div>
