<div class="sidebar">
    <div class="row no-gutters">
        <div class="col pl-3 align-self-center">
            <a class="navbar-brand" href="{{ route('mobile.home') }}">
                <div class="logo" style="background: none">
                    <img src="{{ asset('img/'.$general->logo_light.'') }}" height="20" alt="">
                </div>
            </a>
        </div>
        <div class="col-auto align-self-center">
            <a href="{{ route('mobile.home') }}" class="btn btn-link text-white p-2"><i class="material-icons">power_settings_new</i></a>
        </div>
    </div>
    <div class="list-group main-menu my-4">
        <a href="index.html" class="list-group-item list-group-item-action active"><i class="material-icons">home</i>Home</a>
        <a href="analytics.html" class="list-group-item list-group-item-action"><i class="material-icons">view_day</i>Analytics</a>
        <a href="connection.html" class="list-group-item list-group-item-action"><i class="material-icons">insert_emoticon</i>Connections</a>
        <a href="notification.html" class="list-group-item list-group-item-action"><i class="material-icons">notifications</i>Notification <span class="badge badge-dark text-white">2</span></a>
        <a href="setting.html" class="list-group-item list-group-item-action"><i class="material-icons">account_circle</i>Setting</a>
        <a href="aboutus.html" class="list-group-item list-group-item-action"><i class="material-icons">business</i>About</a>
    </div>
</div>
