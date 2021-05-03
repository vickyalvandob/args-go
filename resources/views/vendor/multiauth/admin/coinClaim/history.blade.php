<table class="table table-borderless">
    <thead>
        <tr class="text-uppercase">
            <th class="text-center align-middle">Date/Time</th>
            <th class="text-center align-middle">Username</th>
            <th class="text-center align-middle">Proof Image</th>
            <th class="text-center align-middle">Amount</th>
            <th class="text-center align-middle">Note</th>
            <th class="text-center align-middle">Status</th>
      </tr>
    </thead>
    <tbody>
        @foreach($coinClaims as $coinClaim)
        <tr>
            <td class="text-center align-middle">{{ $coinClaim->created_at->format("H:i, d F Y") ?? "-" }}</td>
                            <td class="text-center align-middle">{{ $coinClaim->user->username ?? "-" }}</td>
                            <td class="text-center align-middle">
                                @if($coinClaim->proof_image != null)
                                <a href="{{ asset('img/'.$coinClaim->proof_image.'') }}">
                                    <img src="{{ asset('img/'.$coinClaim->proof_image.'') }}" width="50" alt="">
                                </a>
                                @else
                                -
                                @endif
                            </td>
                            <td class="text-center align-middle">{{ number_format($coinClaim->amount , 2, ',', '.') ?? "-" }}</td>
                            <td class="text-center align-middle">{{ $coinClaim->note ?? "-" }}</td>
                            <td class="text-center align-middle">
                                @if ($coinClaim->status == "approved")
                                <span class="badge badge-success">{{ $coinClaim->status }}</span>
                                @elseif ($coinClaim->status == "declined")
                                <span class="badge badge-danger">{{ $coinClaim->status }}</span>
                                @elseif ($coinClaim->status == "pending")
                                <span class="badge badge-secondary">{{ $coinClaim->status }}</span>
                                @else
                                -
                                @endif
                            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
  <div class="row justify-content-center history__paginate">
    {{ $coinClaims->links('pagination::bootstrap-4') }}
    </div>
