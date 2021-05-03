<table class="table table-borderless">
    <thead>
        <tr class="text-uppercase">
            <th class="text-center aligh-middle">Date/Time</th>
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
        @foreach($topUps as $topUp)
        <tr>
            <td class="text-center aligh-middle">{{ $topUp->created_at->format("H:i, d F Y") }}</td>
            <td class="text-center aligh-middle">{{ $topUp->user->username ?? "-" }}</td>
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
                @if($topUp->status == 'approved')
                <span class="badge badge-success">approved</span>
                @elseif($topUp->status == 'declined')
                <span class="badge badge-danger">declined</span>
                @elseif($topUp->status == 'pending')
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
    {{ $topUps->links('pagination::bootstrap-4') }}
    </div>
