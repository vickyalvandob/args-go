<table class="table table-borderless table-sm table-striped "
    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
        <tr class="text-uppercase">
            <th class="text-center align-middle">Date/Time</th>
            <th class="text-center align-middle">Username</th>
            <th class="text-center align-middle">recipient</th>
            <th class="text-center align-middle">Amount</th>
            <th class="text-center align-middle">Tax</th>
            <th class="text-center align-middle">Charge</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transfers_user as $transfer_user)
        <tr>

            <td class="text-center aligh-middle">{{ $transfer_user->created_at->format("H:i, d F Y") }}</td>
            <td class="text-center align-middle">
                {{ $transfer_user->user->username ?? '-' }}
            </td>
            <td class="text-center align-middle">
                {{ $transfer_user->recipient->username ?? '-' }}
            </td>
            <td class="text-center align-middle">{{ number_format($transfer_user->amount, 2, ',', '.') ?? "-" }}<small class="ml-1">{{ $transfer_user->type ?? "-" }}</small></td>
            <td class="text-center align-middle">{{ number_format($transfer_user->tax, 2, ',', '.') ?? "-" }}<small class="ml-1">{{ $transfer_user->type ?? "-" }}</small></td>
            <td class="text-center align-middle">
                @if ($transfer_user->energy > 0)
                <span class="d-block">{{ number_format($transfer_user->energy, 2, ',', '.') ?? "-" }}<small class="ml-1"><i class="mdi mdi-flash"></i></small></span>
                @endif
                @if ($transfer_user->ttg > 0)
               <span class="d-block"> {{ number_format($transfer_user->ttg, 2, ',', '.') ?? "-" }}<small class="ml-1">TTG</small></span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="row justify-content-center table__admin__paginate">
    {{ $transfers_user->links('pagination::bootstrap-4') }}
</div>
