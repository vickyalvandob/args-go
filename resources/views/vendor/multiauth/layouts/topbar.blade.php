<div class="navbar-custom bg-main-gradient2 img-shadow">
    <ul class="list-unstyled topnav-menu float-right mb-0">


        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <img src="{{ asset('img/'.$general->logo_sm.'') }}" height="128" width="128" alt="user-image" class="img-shadow rounded-circle">
                <span class="pro-user-name ml-1">
                    {{ auth('admin')->user()->name }} <i class="mdi mdi-chevron-down"></i>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                <a  href="{{ route('admin.password.change') }}" class="dropdown-item notify-item">
                    <i class="dripicons-lock"></i>
                    <span>Change Password</span>
                </a>
                <a  href="/admin/logout" onclick="event.preventDefault();
                document.getElementById('admin-logout-form').submit();" class="dropdown-item notify-item">
                    <i class="dripicons-power"></i>
                    <span>Logout</span>
                </a>
                <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
    <ul class="list-unstyled menu-left mb-0">
        <li class="float-left">
            <a href="{{ route('admin.home') }}" class="logo">
                <span class="logo-lg">
                    <img src="{{ asset('img/'.$general->logo_light.'') }}" alt="" class="img-shadow" height="24">
                </span>
                <span class="logo-sm">
                    <img src="{{ asset('img/'.$general->logo_sm.'') }}" alt="" class="img-shadow" height="22">
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
