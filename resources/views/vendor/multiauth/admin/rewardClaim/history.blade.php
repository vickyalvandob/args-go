<table class="table table-borderless">
    <thead>
        <tr class="text-uppercase">
            <th class="text-center align-middle">Date/Time</th>
            <th class="text-center align-middle">Username</th>
            <th class="text-center align-middle">Reward</th>
            <th class="text-center align-middle">Image</th>
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
        @foreach($rewardClaims as $rewardClaim)
        <tr>
            <td class="text-center align-middle">{{ $rewardClaim->created_at->format("H:i, d F Y") ?? "-" }}</td>
                            <td class="text-center align-middle">{{ $rewardClaim->user->username ?? "-" }}</td>
                            <td class="text-center align-middle">{{ $rewardClaim->reward->title ?? "-" }}</td>
                            <td class="text-center align-middle">
                                @if($rewardClaim->proof_image != null)
                                <a href="{{ asset('img/'.$rewardClaim->proof_image.'') }}">
                                    <img src="{{ asset('img/'.$rewardClaim->proof_image.'') }}" width="50" alt="">
                                </a>
                                @else
                                -
                                @endif
                            </td>

                            <td class="text-center align-middle">{{ $rewardClaim->recipient_name ?? "-" }}</td>
                            <td class="text-center align-middle">{{ $rewardClaim->recipient_address ?? "-" }}</td>
                            <td class="text-center align-middle">{{ $rewardClaim->recipient_phone ?? "-" }}</td>
                            <td class="text-center align-middle">{{ number_format($rewardClaim->qty , 2, ',', '.') ?? "-" }}</td>
                            <td class="text-center align-middle">{{ number_format($rewardClaim->amount , 2, ',', '.') ?? "-" }}</td>
                            <td class="text-center align-middle">{{ $rewardClaim->note ?? "-" }}</td>
                            <td class="text-center align-middle">
                                @if ($rewardClaim->status == "approved")
                                <span class="badge badge-success">{{ $rewardClaim->status }}</span>
                                @elseif ($rewardClaim->status == "declined")
                                <span class="badge badge-danger">{{ $rewardClaim->status }}</span>
                                @elseif ($rewardClaim->status == "requested")
                                <span class="badge badge-secondary">{{ $rewardClaim->status }}</span>
                                @else
                                -
                                @endif
                            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
  <div class="row justify-content-center history__paginate">
    {{ $rewardClaims->links('pagination::bootstrap-4') }}
    </div>
