<table class="table table-borderless table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
      <tr>
        <th class="text-center aligh-middle">Date</th>
        <th class="text-center aligh-middle">User</th>
          <th class="text-center aligh-middle">Type</th>
        <th class="text-center aligh-middle">Amount </th>
        <th class="text-center aligh-middle">Charge </th>
        <th class="text-center aligh-middle">Note </th>
        <th class="text-center aligh-middle">Action </th>
      </tr>
    </thead>
    <tbody>
      @foreach($payout_pending as $payout)
      <tr>
          <td class="text-center aligh-middle">{{ $payout->created_at }}</td>
          <td class="text-center aligh-middle">
              {{ $payout->user->username ?? "-" }}
            </td>
             <td class="text-center aligh-middle">{{ $payout->type ?? "-" }}</td>
             <td class="text-center aligh-middle">{{   number_format($payout->amount, 2, ',', '.') ?? "-" }}</td>
             <td class="text-center aligh-middle"> {{   number_format($payout->charge, 2, ',', '.') ?? "-" }}</td>
          <td class="text-center aligh-middle">{{ $payout->note ?? "-" }}</td>
          <td class="text-center aligh-middle">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#accepted{{ $payout->id }}">
              Accept
            </button>

            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#rejected{{ $payout->id }}">
              Reject
            </button>

          </td>
      </tr>
<div class="modal fade" id="accepted{{ $payout->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">

<form action="{{ route('admin.payout.update',$payout->id) }}" method="post">
{{csrf_field()}}
<div class="modal-body p-3">
    <input type="hidden" name="status" value="accepted">
    <h3 class="modal-title my-4 text-secondary text-center"><strong><span class="text-success">Accepted</span>, are you sure ? </strong></h3>
    <label class="text-secondary">Note</label>
    <textarea name="note" class="form-control" rows="4">{{ $payout->note }}</textarea>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-success">Accept</button>
</div>
</form>
</div>
</div>
</div>

<div class="modal fade" id="rejected{{ $payout->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">

<form action="{{ route('admin.payout.update',$payout->id) }}" method="post">
{{csrf_field()}}
<div class="modal-body p-3">
    <input type="hidden" name="status" value="rejected">
    <h3 class="modal-title my-4 text-secondary text-center"><strong><span class="text-danger">Rejected</span>, are you sure ? </strong></h3>
    <label class="text-secondary">Note</label>
    <textarea name="note" class="form-control" rows="4">{{ $payout->note }}</textarea>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-danger">Reject</button>
</div>
</form>
</div>
</div>
</div>
      @endforeach
    </tbody>
  </table>
<div class="row justify-content-center request__paginate">
    {{ $payout_pending->links('pagination::bootstrap-4') }}
</div>
