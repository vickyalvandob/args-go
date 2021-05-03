@php
$payout_req = \App\Payout::where('status','pending')->count();
$topUp_req = \App\TopUp::where('status','pending')->count();
$coinClaim_req = \App\CoinClaim::where('status','pending')->count();
$rewardClaim_req = \App\RewardClaim::where('status','pending')->count();
$puzzleClaim_req = \App\PuzzleClaim::where('status','pending')->count();
$claim_req = $puzzleClaim_req + $rewardClaim_req  + $coinClaim_req;
@endphp

<div class="left-side-menu bg-none">
    <div class="slimscroll-menu">
        <div id="sidebar-menu">
            <ul class="metismenu text-uppercase font-weight-bold" id="side-menu">
                <li class="menu-title text-white-50">Feature</li>
                <li>
                    <a href="{{ route('admin.home') }}" class="@if(Request::is('admin/home') ) active @endif">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span> dashboard </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.puzzleCollect.index') }}" class="@if(Request::is('admin/puzzleCollect') || Request::is('admin/puzzleCollect/*') || Request::is('admin/coinCollect') || Request::is('admin/coinCollect/*') || Request::is('admin/rewardCollect') || Request::is('admin/rewardCollect/*')) active @endif">
                        <i class="mdi mdi-gift-outline"></i>
                        <span> Collect </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.weaponAttack.index') }}" class="@if(Request::is('admin/weaponAttack') || Request::is('admin/weaponAttack/*') || Request::is('admin/antagonistAttack') || Request::is('admin/antagonistAttack/*') ) active @endif">
                        <i class="mdi mdi-security"></i>
                        <span> Protect </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.puzzlePieceSell.index') }}" class="@if(Request::is('admin/puzzlePieceSell') || Request::is('admin/puzzlePieceSell/*') || Request::is('admin/rewardSell') || Request::is('admin/rewardSell/*') || Request::is('admin/weaponBuy') || Request::is('admin/weaponBuy/*') ) active @endif">
                        <i class="mdi mdi-shopping"></i>
                        <span> Mall </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.puzzleClaim.index') }}" class="@if(Request::is('admin/puzzleClaim') || Request::is('admin/puzzleClaim/*') || Request::is('admin/coinClaim') || Request::is('admin/coinClaim/*') || Request::is('admin/rewardClaim') || Request::is('admin/rewardClaim/*') ) active @endif">
                        <i class="mdi mdi-ticket"></i>
                        <span> Claim @if($claim_req > 0) <span class="badge badge-primary ml-2">{{ $claim_req }}</span> @endif</span> </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.transfer.index') }}" class="@if(Request::is('admin/transfer') || Request::is('admin/transfer/*') ) active @endif">
                        <i class="mdi mdi-swap-horizontal"></i>
                        <span> transfer </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.topUp.index') }}" class="@if(Request::is('admin/topUp') || Request::is('admin/topUp/*')) active @endif">
                       <i class="mdi mdi-bank-plus"></i>
                        <span> Top Up  @if($topUp_req > 0) <span class="badge badge-primary ml-2">{{ $topUp_req }}</span> @endif</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.payout.index') }}" class="@if(Request::is('admin/payout') || Request::is('admin/payout/*')) active @endif">
                       <i class="mdi mdi-bank-minus"></i>
                        <span> payout  @if($payout_req > 0) <span class="badge badge-primary ml-2">{{ $payout_req }}</span> @endif</span>
                    </a>
                </li>
                <li class="menu-title text-white-50">Management</li>
                <li>
                    <a href="{{ route('admin.user.index') }}" class="@if(Request::is('admin/user') || Request::is('admin/user/*') ) active @endif">
                        <i class="mdi mdi-account-outline"></i>
                        <span> user </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.coin.index') }}" class="@if(Request::is('admin/coin') || Request::is('admin/coin/*') ) active @endif">
                        <i class="mdi mdi-coin"></i>
                        <span> coin </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.puzzle.index') }}" class="@if(Request::is('admin/puzzle') || Request::is('admin/puzzle/*') ) active @endif">
                        <i class="mdi mdi-puzzle"></i>
                        <span> puzzle </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.reward.index') }}" class="@if(Request::is('admin/reward') || Request::is('admin/reward/*') ) active @endif">
                        <i class="mdi mdi-ticket"></i>
                        <span> reward </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.weapon.index') }}" class="@if(Request::is('admin/weapon') || Request::is('admin/weapon/*') ) active @endif">
                        <i class="mdi mdi-target"></i>
                        <span> weapon </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.antagonist.index') }}" class="@if(Request::is('admin/antagonist') || Request::is('admin/antagonist/*') ) active @endif">
                        <i class="mdi mdi-ghost"></i>
                        <span> antagonist </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.general.index') }}" class="@if(Request::is('admin/general') || Request::is('admin/general/*') ) active @endif">
                        <i class="mdi mdi-settings"></i>
                        <span> general </span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
