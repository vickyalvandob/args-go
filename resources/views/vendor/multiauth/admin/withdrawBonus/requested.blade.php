<table class="table table-borderless table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
      <tr>
        <th class="text-center aligh-middle">Date</th>
          <th class="text-center aligh-middle">User</th>
          <th class="text-center aligh-middle">Type</th>
        <th class="text-center aligh-middle">Amount </th>
        <th class="text-center aligh-middle">Charge </th>
        <th class="text-center aligh-middle">Note </th>
        <th class="text-center aligh-middle">Status </th>
      </tr>
    </thead>
    <tbody>
      @foreach($withdrawBonuss as $withdrawBonus)
      <tr>
          <td class="text-center aligh-middle">{{ $withdrawBonus->created_at }}</td>
           <td class="text-center aligh-middle">{{ $withdrawBonus->user->username ?? "-" }}</td>
                         <td class="text-center aligh-middle">{{ $withdrawBonus->type ?? "-" }}</td>
                         <td class="text-center aligh-middle">{{   number_format($withdrawBonus->amount, 2, ',', '.') ?? "-" }}</td>
                         <td class="text-center aligh-middle"> {{   number_format($withdrawBonus->charge, 2, ',', '.') ?? "-" }}</td>
                      <td class="text-center aligh-middle">{{ $withdrawBonus->note ?? "-" }}</td>
          <td class="text-center aligh-middle">
              @if($withdrawBonus->status == 'accepted')
                <span class="badge badge-success">Accepted</span>
              @elseif($withdrawBonus->status == 'rejected')
              <span class="badge badge-danger">Rejected</span>
              @else
              <span class="badge badge-secondary">Pending</span>
              @endif
          </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div class="row justify-content-center requested__paginate">
    {{ $withdrawBonuss->links('pagination::bootstrap-4') }}
</div>
