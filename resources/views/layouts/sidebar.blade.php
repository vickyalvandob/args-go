<div class="left-side-menu img-shadow bg-none">
    <div class="slimscroll-menu">
        <div id="sidebar-menu">
            <ul class="metismenu text-uppercase font-weight-bold" id="side-menu">
                <li class="menu-title">Navigation</li>
                <li>
                    <a href="{{ route('user.dashboard') }}">

                        <i class="mdi mdi-view-dashboard"></i>
                        <span> dashboard </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.puzzleCollect.index') }}" class="@if(Request::is('user/puzzleCollect') || Request::is('user/puzzleCollect/*') || Request::is('user/rewardCollect') || Request::is('user/rewardCollect/*') || Request::is('user/coinCollect') || Request::is('user/coinCollect/*') ) active @endif">

                        <i class="mdi mdi-gift-outline"></i>
                        <span> Collection </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.puzzlePieceSell.index') }}" class="@if(Request::is('user/puzzlePieceSell') || Request::is('user/puzzlePieceSell/*') || Request::is('user/rewardSell') || Request::is('user/rewardSell/*') || Request::is('user/weapon') || Request::is('user/weapon/*')) active @endif">

                        <i class="mdi mdi-shopping"></i>
                        <span> Mall </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.puzzleClaim.index') }}" class="@if(Request::is('user/puzzleClaim') || Request::is('user/puzzleClaim/*') || Request::is('user/rewardClaim') || Request::is('user/rewardClaim/*') || Request::is('user/coinClaim') || Request::is('user/coinClaim/*') ) active @endif">

                        <i class="mdi mdi-ticket"></i>
                        <span> Claim </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('user.weaponAttack.index') }}" class="@if(Request::is('user/weaponAttack') || Request::is('user/weaponAttack/*') || Request::is('user/antagonistAttack') || Request::is('user/antagonistAttack/*') ) active @endif">
                        <i class="mdi mdi-security"></i>
                        <span> Protect </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.transfer.index') }}">
                        <i class="mdi mdi-swap-horizontal"></i>
                        <span> Transfer </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.topUp.index') }}">
                        <i class="mdi mdi-wallet"></i>
                        <span> top Up </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.payout.index') }}"  >
                        <i class="mdi mdi-bank"></i>
                        <span> payout </span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>

    </div>
</div>
