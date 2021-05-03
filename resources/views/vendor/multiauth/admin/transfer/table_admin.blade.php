<table class="table table-borderless table-striped dt-responsive nowrap"
    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead class="text-uppercase">
        <tr>
            <th class="text-center align-middle">Date/Time</th>
            <th class="text-center align-middle">Username</th>
            <th class="text-center align-middle">Amount</th>
            <th class="text-center align-middle">Tax</th>
            <th class="text-center align-middle">Charge</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transfers_admin as $transfer_admin)
        <tr>

            <td class="text-center aligh-middle">{{ $transfer_admin->created_at->format("H:i, d F Y") }}</td>
            <td class="text-center align-middle">
                {{ $transfer_admin->user->username ?? '-' }}
            </td>
            <td class="text-center align-middle">{{ number_format($transfer_admin->amount, 2, ',', '.') ?? "-" }}<small class="ml-1">{{ $transfer_admin->type ?? "-" }}</small></td>
            <td class="text-center align-middle">{{ number_format($transfer_admin->tax, 2, ',', '.') ?? "-" }}<small class="ml-1">{{ $transfer_admin->type ?? "-" }}</small></td>
            <td class="text-center align-middle">
                @if ($transfer_admin->energy > 0)
                <span class="d-block">{{ number_format($transfer_admin->energy, 2, ',', '.') ?? "-" }}<small class="ml-1"><i class="mdi mdi-flash"></i></small></span>
                @endif
                @if ($transfer_admin->ttg > 0)
               <span class="d-block"> {{ number_format($transfer_admin->ttg, 2, ',', '.') ?? "-" }}<small class="ml-1">TTG</small></span>
                @endif
            </td>

        </tr>
        @endforeach
    </tbody>
</table>
<div class="row justify-content-center table__admin__paginate">
    {{ $transfers_admin->links('pagination::bootstrap-4') }}
</div>
