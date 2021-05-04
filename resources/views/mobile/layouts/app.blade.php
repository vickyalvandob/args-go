<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title>Finwallapp - Mobile HTML template</title>

    <!-- manifest meta -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="manifest" href="{{ asset('finwallet') }}/manifest.json" />

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="{{ asset('finwallet') }}/img/favicon180.png" sizes="180x180">
    <link rel="icon" href="{{ asset('finwallet') }}/img/favicon32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="{{ asset('finwallet') }}/img/favicon16.png" sizes="16x16" type="image/png">

    <!-- Material icons-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('greeva/vertical/dist') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">

    <!-- swiper CSS -->
    <link href="{{ asset('finwallet') }}/vendor/swiper/css/swiper.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('finwallet') }}/css/style-dark-blue.css" rel="stylesheet" id="style">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @stack('css')
</head>

<body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="homepage">
    <!-- screen loader -->
    <div class="container-fluid h-100 loader-display">
        <div class="row h-100">
            <div class="align-self-center col">
                <div class="logo-loading">
                    <div class="icon icon-100 mb-4 rounded-circle">
                        <img src="{{ asset('finwallet') }}/img/favicon144.png" alt="" class="w-100">
                    </div>
                   {{-- <img src="{{ asset('img/'.$general->logo_light.'') }}" alt=""> --}}
                    <div class="loader-ellipsis">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- Begin page content -->
    <main class="flex-shrink-0 main has-footer">

        <div class="container text-center mb-5">
            <img src="{{ asset('img/'.$general->logo_light.'') }}" height="30" alt="">
        </div>

        <div class="main-container ">
            <!-- page content start -->
            @yield('content')
        </div>
    </main>

    <!-- footer-->
    <div class="footer">
        <div class="row no-gutters justify-content-center">
            <div class="col-auto">
                <a href="{{ asset('finwallet') }}/index.html" class="active">
                    <i class="material-icons">home</i>
                    <p>Home</p>
                </a>
            </div>
            <div class="col-auto">
                <a href="analytics.html" class="">
                    <i class="material-icons">insert_chart_outline</i>
                    <p>Analytics</p>
                </a>
            </div>
            <div class="col-auto">
                <a href="wallet.html" class="">
                    <i class="mdi mdi-barcode-scan fa-2x"></i>
                    <p>Wallet</p>
                </a>
            </div>
            <div class="col-auto">
                <a href="shop.html" class="">
                    <i class="material-icons">shopping_bag</i>
                    <p>Shop</p>
                </a>
            </div>
            <div class="col-auto">
                <a href="profile.html" class="">
                    <i class="material-icons">account_circle</i>
                    <p>Profile</p>
                </a>
            </div>
        </div>
    </div>

    <!-- Required jquery and libraries -->
    <script src="{{ asset('finwallet') }}/js/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('finwallet') }}/js/popper.min.js"></script>
    <script src="{{ asset('finwallet') }}/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- cookie js -->
    <script src="{{ asset('finwallet') }}/js/jquery.cookie.js"></script>

    <!-- Swiper slider  js-->
    <script src="{{ asset('finwallet') }}/vendor/swiper/js/swiper.min.js"></script>

    <!-- Customized jquery file  -->
    <script src="{{ asset('finwallet') }}/js/main.js"></script>
    <script src="{{ asset('finwallet') }}/js/color-scheme-demo.js"></script>

    <!-- PWA app service registration and works -->
    <script src="{{ asset('finwallet') }}/js/pwa-services.js"></script>

    <!-- page level custom script -->
    <script src="{{ asset('finwallet') }}/js/app.js"></script>
</body>

</html>
