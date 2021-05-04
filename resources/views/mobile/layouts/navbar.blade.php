
    <header class="header fixed-top">
        <nav class="navbar">
            <div>
                <button class="menu-btn btn btn-link btn-44">
                    <span class="icon material-icons">menu</span>
                </button>
            </div>
            <div class="text-center">
                <a class="navbar-brand text-center" href="index.html">
                    <div class="logo" style="background: none;">
                        <img src="{{ asset('img/'.$general->logo_dark.'') }}" height="20" alt="">
                    </div>
                </a>
            </div>
            <div>
                <a href="{{ route('mobile.profile.index') }}" class=""><span class="avatar avatar-30"><img src="{{ asset('oneuiux/finance') }}/assets/img/user1.png" alt=""></span></a>
            </div>
        </nav>
    </header>
