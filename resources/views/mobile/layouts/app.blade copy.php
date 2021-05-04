<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ $general->description }}">
    <meta name="author" content="{{ $general->title }}">

    <title>{{ $general->title }}</title>

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="{{ asset('img/'.$general->favicon.'') }}" sizes="180x180">
    <link rel="icon" href="{{ asset('img/'.$general->favicon.'') }}" sizes="32x32" type="image/png">
    <link rel="icon" href="{{ asset('img/'.$general->favicon.'') }}" sizes="16x16" type="image/png">
    <link rel="mask-icon" href="{{ asset('img/'.$general->favicon.'') }}" color="#ffffff">
    <link rel="icon" href="{{ asset('img/'.$general->favicon.'') }}">

    <!-- Elegant font icons -->
    <link href="{{ asset('oneuiux/finance') }}/assets/vendor/elegant_font/HTMLCSS/style.css" rel="stylesheet">

    <!-- Elegant font icons -->
    <link href="{{ asset('oneuiux/finance') }}/assets/vendor/materializeicon/material-icons.css" rel="stylesheet">

    <link href="{{ asset('greeva/vertical/dist') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    <!-- daterange picker -->
    <link href="{{ asset('oneuiux/finance') }}/assets/vendor/daterangepicker-master/daterangepicker.css" rel="stylesheet">

    <!-- Swiper Slider -->
    <link href="{{ asset('oneuiux/finance') }}/assets/vendor/swiper/css/swiper.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('oneuiux/finance') }}/assets/css/style-blue.css" rel="stylesheet" id="style">

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @stack('css')
</head>

<body class="ui-rounded">
    @include('sweet::alert')

    {{-- <div class="preloader bg-main-gradient">
        <div class="loading">
            <div class="lds-ripple"><div></div><div></div></div>
        </div>
    </div> --}}

    <!-- Page laoder -->
    <div class="container-fluid pageloader">
        <div class="row h-100">
            <div class="col-12 align-self-start text-center">
            </div>
            <div class="col-12 align-self-center text-center">
                <div class="loader-logo">
                    <div class="logo">1<span>UX</span><span>UI</span>
                        <div class="loader-roller">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </div>
                    <h4 class="logo-text"><span>OneUIUX</span><small>Mobile HTML</small></h4>
                </div>
            </div>
            <div class="col-12 align-self-end text-center">
                <p class="my-5">Please wait<br><small class="text-mute">A world of great designs is loading...</small></p>
            </div>
        </div>
    </div>
    <!-- Page laoder ends -->

    @if(isset($auth))
    @endif

    {{-- @include('mobile.layouts.navbar') --}}
    @include('mobile.layouts.sidebar')


    <!-- Begin page content -->
    <main class="flex-shrink-0 main-container pb-0">
        @include('multiauth::message')

       <div class="container-fluid">
        @yield('content')

       </div>

    </main>
    <!-- End of page content -->

    <!-- Footer -->
    <footer class="footer" style="background: none">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-center text-white">
                    &copy; {{ $general->title }}
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer ends -->

    <!-- sticky footer tabs -->
    <div class="footer-tabs footer-spaces border-top text-center">
        <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                    <i class="material-icons">home</i>
                    <small class="">Home</small>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="recurring-tab" data-toggle="tab" href="#recurring" role="tab" aria-controls="recurring" aria-selected="false">
                    <i class="material-icons">store</i>
                    <small class="">Shop</small>
                </a>
            </li>
            <li class="nav-item centerlarge">
                <a class="nav-link bg-default" data-toggle="modal" data-target="#addexpense">
                    <i class="mdi mdi-barcode-scan fa-2x"></i>
                    <small class="sr-only">Add Expense</small>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="recurring-tab" data-toggle="tab" href="#recurring" role="tab" aria-controls="recurring" aria-selected="false">
                    <i class="material-icons">account_balance_wallet</i>
                    <small class="">Expense</small>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                    <i class="material-icons">person</i>
                    <small class="">Account</small>
                </a>
            </li>
        </ul>
    </div>
    <!-- sticky footer tabs ends -->



    <!-- add expense -->
    <div class="modal fade" id="addexpense" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-default">
                    <input type="text" class="form-control form-control-lg f-30 text-white border-0 bg-none amount" placeholder="Enter Amout" autofocus>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <button class="btn btn-sm btn-outline-default px-2 mr-2 mb-2" type="button">
                            <i class="material-icons h6 my-0 mr-2">local_cafe</i>Coffee
                        </button>
                        <button class="btn btn-sm btn-outline-default px-2 mr-2 mb-2" type="button">
                            <i class="material-icons h6 my-0 mr-2">shopping_basket</i>Grocery
                        </button>
                        <button class="btn btn-sm btn-outline-default px-2 mr-2 mb-2" type="button">
                            <i class="material-icons h6 my-0 mr-2">settings_input_antenna</i>Internet
                        </button>
                        <button class="btn btn-sm btn-outline-default px-2 mr-2 mb-2" type="button">
                            <i class="material-icons h6 my-0 mr-2">restaurant</i>Food
                        </button>
                        <button class="btn btn-sm btn-outline-default px-2 mr-2 mb-2" type="button">
                            <i class="material-icons h6 my-0 mr-2">devices_other</i>Acces.
                        </button>
                        <button class="btn btn-sm btn-outline-default px-2 mr-2 mb-2" type="button">
                            <i class="material-icons h6 my-0 mr-2">movie_filter</i>Movie
                        </button>
                        <button class="btn btn-sm btn-outline-default px-2 mr-2 mb-2" type="button">
                            <i class="material-icons h6 my-0 mr-2">directions_car</i>Car
                        </button>
                        <button class="btn btn-sm btn-outline-default active px-2 mr-2 mb-2" type="button">
                            <i class="material-icons h6 my-0 mr-2">directions_car</i>Other
                        </button>
                    </div>
                    <div class="form-group">
                        <label class="text-mute small">Expense name</label>
                        <input type="text" class="form-control" placeholder="Expense name">
                    </div>
                    <div class="form-group">
                        <label class="text-mute small">Date</label>
                        <input type="text" class="form-control datepicker" placeholder="Select Date">
                    </div>
                    <div class="form-group">
                        <label class="text-mute small">Description</label>
                        <textarea class="form-control" placeholder="Note"></textarea>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-default default-shadow" data-dismiss="modal">Add Expense</button>
                </div>
            </div>
        </div>
    </div>
    <!-- add expense ends -->




    <!-- Required jquery and libraries -->
    <script src="{{ asset('oneuiux/finance') }}/assets/js/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('oneuiux/finance') }}/assets/js/popper.min.js"></script>
    <script src="{{ asset('oneuiux/finance') }}/assets/vendor/bootstrap-4.4.1/js/bootstrap.min.js"></script>

    <!-- cookie css -->
    <script src="{{ asset('oneuiux/finance') }}/assets/vendor/cookie/jquery.cookie.js"></script>

    <!-- Swiper slider  -->
    <script src="{{ asset('oneuiux/finance') }}/assets/vendor/swiper/js/swiper.min.js"></script>

    <!-- date range picker -->
    <script src="{{ asset('oneuiux/finance') }}/assets/vendor/daterangepicker-master/moment.min.js"></script>
    <script src="{{ asset('oneuiux/finance') }}/assets/vendor/daterangepicker-master/daterangepicker.js"></script>

    <!-- Swiper slider  -->
    <script src="{{ asset('oneuiux/finance') }}/assets/vendor/sparklines/jquery.sparkline.min.js"></script>

    <!-- Customized jquery file  -->
    <script src="{{ asset('oneuiux/finance') }}/assets/js/main.js"></script>
    <script src="{{ asset('oneuiux/finance') }}/assets/js/color-scheme-demo.js"></script>

    <script>
        "use strict"
        $(document).ready(function() {
            /* Swiper slider */
            var swiper = new Swiper('.swiper-categories', {
                slidesPerView: 'auto',
                spaceBetween: 0,
                pagination: false,
            });

            var swiper = new Swiper('.swiper-offers', {
                slidesPerView: 'auto',
                spaceBetween: 10,
                pagination: false,
            });

            /* swiper tavs  js */
            $('#recurring-tab[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                var swiper = new Swiper('.swiper-container', {
                    effect: 'coverflow',
                    grabCursor: true,
                    centeredSlides: true,
                    slidesPerView: 'auto',
                    spaceBetween: 10,
                    coverflowEffect: {
                        rotate: 30,
                        stretch: 0,
                        depth: 80,
                        modifier: 1,
                        slideShadows: true,
                    }

                });

            });

            /* swiper tavs  js */
            $('#addexpense').on('shown.bs.modal', function(e) {
                $('.amount').focusin();

                /* calander picker */
                var start = moment().subtract(29, 'days');
                var end = moment();

                /* calander single  picker ends */
                $('.datepicker').daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    drops: 'up',
                    minYear: 1901
                }, function(start, end, label) {});

            });

            /* toast message */
            setTimeout(function() {
                $('.toast').toast('show')
            }, 2000);

            /* sparklines */
            $("#sparklines1").sparkline([5, 6, 7, 9, 9, 5, 3, 2, 2, 4, 6, 7, 5, 6, 7, 9, 9, 5, 3, 2, 2, 4, 6, 7], {
                type: 'bar',
                height: '20px',
                barWidth: 2,
                barColor: '#e0eaff'
            });

        });

    </script>
</body>

</html>
