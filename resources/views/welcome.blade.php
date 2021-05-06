
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $general->title }} </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="{{ $general->description }}" name="description" />
        <meta content="{{ $general->title }}" name="author" />
        <meta name="author" content="{{ $general->title }}" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('img/'.$general->logo_sm.'') }}">
        <link rel="stylesheet" href="{{ asset('greeva/Landing') }}/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" type="text/css" href="{{ asset('greeva/Landing') }}/css/materialdesignicons.min.css" />
        <link rel="stylesheet" type="text/css" href="{{ asset('greeva/Landing') }}/css/pe-icon-7-stroke.css" />
        <link rel="stylesheet" type="text/css" href="{{ asset('greeva/Landing') }}/css/owl.carousel.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('greeva/Landing') }}/css/owl.theme.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('greeva/Landing') }}/css/owl.transitions.css">

        <!-- Custom  sCss -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="{{ asset('greeva/Landing') }}/css/style.css" />
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
        @stack('css')
    </head>

    <body class="bg-main-gradient3">

        @include('sweet::alert')

        <div class="preloader bg-main-gradient3">
            <div class="loading">
                <div class="lds-ripple"><div></div><div></div></div>
            </div>
        </div>

        <nav class="navbar navbar-expand-lg fixed-top navbar-custom sticky sticky-dark">
            <div class="container-fluid">
                <!-- LOGO -->
                <a class="logo text-uppercase" href="{{ route('home') }}">
                    <img src="{{ asset('img/'.$general->logo_light.'') }}" alt="" class="logo-light" height="24" />
                    <img src="{{ asset('img/'.$general->logo_light.'') }}" alt="" class="logo-dark" height="24" />
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="mdi mdi-menu"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav ml-auto navbar-center" id="mySidenav">
                        <li class="nav-item">
                            <a href="{{ $general->social ?? '#' }}" target="_blank" class="nav-link btn m-1 btn-outline-light btn-rounded px-3"> <i class="mdi mdi-headphones mr-1"></i> service </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Navbar End -->
      <!-- testimonial start -->
      <section class="section">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <img src="{{ asset('img/icon4.svg') }}" alt="" class="img-shadow img-fluid" />
                    </div>
                </div>
                <div class="form-group mb-3 text-center">
                    <button class="btn btn-outline-light btn-block w3-round-xlarge" type="submit" style="background: none!important;" > Login </button>
                </div>
                <div class="form-group mb-3 text-center">
                    <a href="{{ route('loginbygoogle') }}"class="btn btn-danger btn-block w3-round-xlarge"> <i class="mdi mdi-google"></i>  Login By Google</a><br>
                </div>

            </div>
        </section>


        <div class="footer-alt py-3 mb-5" style="background: none">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0">© {{ $general->title }}  All right reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('greeva/Landing') }}/js/jquery.min.js"></script>
        <script src="{{ asset('greeva/Landing') }}/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('greeva/Landing') }}/js/jquery.easing.min.js"></script>
        <script src="{{ asset('greeva/Landing') }}/js/scrollspy.min.js"></script>
        <script src="{{ asset('greeva/Landing') }}/js/owl.carousel.min.js"></script>
        <script src="{{ asset('greeva/Landing') }}/js/app.js"></script>
        <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
        <script src="{{ asset('js/custom.js') }}"></script>
        @stack('js')

    </body>

</html>
