<table class="table table-borderless table-striped ">
    <thead>
      <tr class="text-uppercase">
        <th class="text-center align-middle">Date/Time</th>
            <th class="text-center align-middle">Username</th>
            <th class="text-center align-middle">Reward</th>
            <th class="text-center align-middle">Name</th>
            <th class="text-center align-middle">Address</th>
            <th class="text-center align-middle">Phone</th>
            <th class="text-center align-middle">qty</th>
            <th class="text-center align-middle">Amount</th>
            <th class="text-center align-middle">Note</th>
            <th class="text-center align-middle">Status</th>
      </tr>
    </thead>
    <tbody>
      @foreach($rewardClaims_pending as $rewardClaim)
      <tr>
        <td class="text-center align-middle">{{ $rewardClaim->created_at->format("H:i, d F Y") ?? "-" }}</td>
        <td class="text-center align-middle">{{ $rewardClaim->user->username ?? "-" }}</td>
        <td class="text-center align-middle">{{ $rewardClaim->reward->title ?? "-" }}</td>
        <td class="text-center align-middle">{{ $rewardClaim->recipient_name ?? "-" }}</td>
        <td class="text-center align-middle">{{ $rewardClaim->recipient_address ?? "-" }}</td>
        <td class="text-center align-middle">{{ $rewardClaim->recipient_phone ?? "-" }}</td>
        <td class="text-center align-middle">{{ number_format($rewardClaim->qty , 2, ',', '.') ?? "-" }}</td>
        <td class="text-center align-middle">{{ number_format($rewardClaim->amount , 2, ',', '.') ?? "-" }}</td>
        <td class="text-center align-middle">{{ $rewardClaim->note ?? "-" }}</td>
          <td class="text-center aligh-middle">
            <button type="button" class="btn m-1 btn-success" data-toggle="modal" data-target="#approved{{ $rewardClaim->id }}">
                approve
            </button>

            <button type="button" class="btn m-1 btn-danger" data-toggle="modal" data-target="#declined{{ $rewardClaim->id }}">
                decline
            </button>

          </td>
      </tr>
        <div class="modal fade" id="approved{{ $rewardClaim->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="{{ route('admin.rewardClaim.update',$rewardClaim->id) }}" enctype="multipart/form-data"  method="post">
                       @method('put')
                       @csrf
                        <div class="modal-body">
                            <div class="my-2 text-center card-box">
                                <h4> {{   number_format($rewardClaim->amount, 2, ',', '.') ?? "-" }} <small>ARGS</small></h4>
                                <img src="{{ asset('img/'.$rewardClaim->user->image.'') }}" height="30" width="30" class="img-shadow rounded-circle mr-1" alt=""> {{ $rewardClaim->user->username ?? "-" }}
                            </div>
                            <input type="hidden" name="status" value="approved">
                            <div class="form-group">
                                <label class="text-white">Proof Image</label>
                                <input type="file" name="proof_image" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="text-white">Note</label>
                                <textarea name="note" class="form-control" rows="4">{{ $rewardClaim->note }}</textarea>

                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block">approve</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="declined{{ $rewardClaim->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="{{ route('admin.rewardClaim.update',$rewardClaim->id) }}" enctype="multipart/form-data"  method="post">
                       @method('put')
                       @csrf
                        <div class="modal-body">
                            <div class="my-2 text-center card-box">
                                <h4> {{   number_format($rewardClaim->amount, 2, ',', '.') ?? "-" }} <small>ARGS</small></h4>
                                <img src="{{ asset('img/'.$rewardClaim->user->image.'') }}" height="30" width="30" class="img-shadow rounded-circle mr-1" alt=""> {{ $rewardClaim->user->username ?? "-" }}
                            </div>
                            <input type="hidden" name="status" value="declined">
                            <div class="form-group">
                                <label class="text-white">Note</label>
                                <textarea name="note" class="form-control" rows="4">{{ $rewardClaim->note }}</textarea>

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
    {{ $rewardClaims_pending->links('pagination::bootstrap-4') }}
</div>
