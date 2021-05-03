<div class="navbar-custom img-shadow bg-main-gradient3" >
    <ul class="list-unstyled topnav-menu float-right mb-0">
        <li class="dropdown d-none d-lg-block">
            <a class="nav-link dropdown-toggle mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <i class="mdi mdi-wallet"></i>
                <span>{{  number_format(Auth::user()->balance , 2, ',', '.') ?? "-" }} <small>{{ $general->currency }}</small></span>
            </a>
        </li>
        <li class="dropdown d-none d-lg-block">
            <a class="nav-link dropdown-toggle mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <i class="mdi mdi-coins"></i>
                <span>{{  number_format(Auth::user()->coin_gast , 2, ',', '.') ?? "-" }} <small>GAST</small></span>
            </a>
        </li>
        <li class="dropdown d-none d-lg-block">
            <a class="nav-link dropdown-toggle mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <i class="mdi mdi-coin"></i>
                <span>{{  number_format(Auth::user()->coin_ttg , 2, ',', '.') ?? "-" }} <small>TTG</small></span>
            </a>
        </li>
        <li class="dropdown d-none d-lg-block">
            <a class="nav-link dropdown-toggle mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <i class="mdi mdi-flash"></i>
                    <span>{{  number_format(Auth::user()->energy) ?? "-" }} <small>/ {{  number_format(Auth::user()->energy_quota) ?? "-" }}</small></span>
            </a>
        </li>
        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <img src="{{ asset('img/'.Auth::user()->image.'') }}" height="128" width="128" alt="user-image" class="rounded-circle">
                <span class="pro-user-name ml-1">
                    {{ Auth::user()->name }} <i class="mdi mdi-chevron-down"></i>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown " style="overflow: auto">
                <a href="#"  class="dropdown-item notify-item">
                    <i class="mdi mdi-wallet"></i>
                    <span>{{  number_format(Auth::user()->balance , 2, ',', '.') ?? "-" }} <small>{{ $general->currency }}</small></span>
                </a>
                <a href="#"  class="dropdown-item notify-item">
                    <i class="mdi mdi-coins"></i>
                    <span>{{  number_format(Auth::user()->coin_gast , 2, ',', '.') ?? "-" }} <small>GAST</small></span>
                </a>
                <a href="#"  class="dropdown-item notify-item">
                    <i class="mdi mdi-coin"></i>
                    <span>{{  number_format(Auth::user()->coin_ttg , 2, ',', '.') ?? "-" }} <small>TTG</small></span>
                </a>
                <a href="#"  class="dropdown-item notify-item">
                    <i class="mdi mdi-flash"></i>
                    <span>{{  number_format(Auth::user()->energy) ?? "-" }}</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('user.profile.index') }}"  class="dropdown-item notify-item">
                    <i class="mdi mdi-account"></i>
                    <span>Profile</span>
                </a>
                <a href="{{ route('user.password.index') }}"  class="dropdown-item notify-item">
                    <i class="mdi mdi-lock"></i>
                    <span>Password</span>
                </a>
                <a  href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();" class="dropdown-item notify-item">
                    <i class="dripicons-power"></i>
                    <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
    <ul class="list-unstyled menu-left mb-0">
        <li class="float-left">
            <a href="{{ route('home') }}" class="logo">
                <span class="logo-lg">
                    <img src="{{ asset('img/'.$general->logo_light.'') }}" alt="" height="24">
                </span>
                <span class="logo-sm">
                    <img src="{{ asset('img/'.$general->logo_sm.'') }}" alt="" height="22">
                </span>
            </a>
        </li>
        <li class="float-left">
            <a class="button-menu-mobile navbar-toggle">
                <div class="lines">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </a>
        </li>

    </ul>
</div>
<!-- end Topbar -->
