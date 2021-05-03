<table class="table table-borderless">
    <thead>
        <tr class="text-uppercase">
            <th class="text-center aligh-middle">Date / Time</th>
            <th class="text-center aligh-middle">Username</th>
            <th class="text-center aligh-middle">Image</th>
            <th class="text-center aligh-middle">Amount </th>
            <th class="text-center aligh-middle">Tax </th>
            <th class="text-center aligh-middle">Charge </th>
            <th class="text-center aligh-middle">Note </th>
            <th class="text-center aligh-middle">Status </th>
      </tr>
    </thead>
    <tbody>
        @foreach($payouts as $payout)
        <tr>
            <td class="text-center aligh-middle">{{ $payout->created_at->format("H:i, d F Y") }}</td>
            <td class="text-center aligh-middle">{{ $payout->user->username ?? "-" }}</td>
            <td class="text-center align-middle">
                @if($payout->proof_image != null)
                  <a href="{{ asset('img/'.$payout->proof_image.'') }}" target="_blank">
                      <img src="{{ asset('img/'.$payout->proof_image.'') }}" width="50" alt="">
                    </a>
                    @else
-
                    @endif
                </td>
            <td class="text-center aligh-middle">{{   number_format($payout->amount, 2, ',', '.') ?? "-" }} <small>ARGS</small></td>
            <td class="text-center aligh-middle">{{   number_format($payout->tax, 2, ',', '.') ?? "-" }} <small>ARGS</small></td>
            <td class="text-center aligh-middle"> {{   number_format($payout->energy, 2, ',', '.') ?? "-" }} <small><i class="mdi mdi-flash"></i></small></td>
            <td class="text-center aligh-middle">{{ $payout->note ?? "-" }}</td>
            <td class="text-center aligh-middle">
                @if($payout->status == 'approved')
                <span class="badge badge-success">approved</span>
                @elseif($payout->status == 'declined')
                <span class="badge badge-danger">declined</span>
                @elseif($payout->status == 'pending')
                <span class="badge badge-secondary">pending</span>
                @else
                -
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
  <div class="row justify-content-center history__paginate">
    {{ $payouts->links('pagination::bootstrap-4') }}
    </div>
