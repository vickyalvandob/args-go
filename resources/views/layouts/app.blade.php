<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ $general->title }} </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="{{ $general->description }}" name="description" />
        <meta content="{{ $general->title }}" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="{{ asset('img/'.$general->logo_sm.'') }}">

        <link href="{{ asset('greeva/vertical/dist') }}/libs/jqvmap/jqvmap.min.css" rel="stylesheet" />
        <link href="{{ asset('greeva/vertical/dist') }}/assets/libs/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('greeva/vertical/dist') }}/assets/libs/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('greeva/vertical/dist') }}/assets/libs/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('greeva/vertical/dist') }}/assets/libs/datatables/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('greeva/vertical/dist') }}/assets/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('greeva/vertical/dist') }}/assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
        <link href="{{ asset('greeva/vertical/dist') }}/assets/libs/switchery/switchery.min.css" rel="stylesheet">
        <link href="{{ asset('greeva/vertical/dist') }}/assets/libs/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
        <link href="{{ asset('greeva/vertical/dist') }}/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" />
        <link href="{{ asset('greeva/vertical/dist') }}/assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet" />
        <link href="{{ asset('greeva/vertical/dist') }}/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" />
        <link href="{{ asset('greeva/vertical/dist') }}/assets/libs/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
        <link href="{{ asset('greeva/vertical/dist') }}/assets/libs/summernote/summernote-bs4.css" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('greeva/vertical/dist') }}/assets/libs/chartist/chartist.min.css"> <!-- ION Slider -->
        <link href="{{ asset('greeva/vertical/dist') }}/assets/libs/ion-rangeslider/ion.rangeSlider.css" rel="stylesheet" type="text/css"/>

        <link href="{{ asset('greeva/vertical/dist') }}/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('greeva/vertical/dist') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('greeva/vertical/dist') }}/assets/css/app.min.css" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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



        @if(isset($auth))

        @yield('content')

        @else

        <div id="wrapper">

            @include('layouts.topbar')

            @include('layouts.sidebar')

            <div class="content-page">
                <div class="content">

                    <div class="container-fluid">
                        <br>
                        @include('multiauth::message')
                        <br>
                        @yield('content')
                    </div>

                </div>

                <footer class="footer" style="background: none">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                &copy; {{ $general->title }}
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        @endif



        <!-- Vendor js -->
        <script src="{{ asset('greeva/vertical/dist') }}/assets/js/vendor.min.js"></script>

        <!-- Chart JS -->
        <script src="{{ asset('greeva/vertical/dist') }}/assets/libs/jquery-knob/jquery.knob.min.js"></script>
        <script src="{{ asset('greeva/vertical/dist') }}/assets/libs/chart-js/Chart.bundle.min.js"></script>
        <script src="{{ asset('greeva/vertical/dist') }}/assets/libs/jqvmap/jquery.vmap.min.js"></script>
        <script src="{{ asset('greeva/vertical/dist') }}/assets/libs/jqvmap/jquery.vmap.usa.js"></script>

        <!-- form js -->
        <script src="{{ asset('greeva/vertical/dist') }}/assets/libs/select2/select2.min.js"></script>
        <script src="{{ asset('greeva/vertical/dist') }}/assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
        <script src="{{ asset('greeva/vertical/dist') }}/assets/libs/switchery/switchery.min.js"></script>
        <script src="{{ asset('greeva/vertical/dist') }}/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
        <script src="{{ asset('greeva/vertical/dist') }}/assets/libs/jquery-mask-plugin/jquery.mask.min.js"></script>
        <script src="{{ asset('greeva/vertical/dist') }}/assets/libs/bootstrap-select/bootstrap-select.min.js"></script>
        <script src="{{ asset('greeva/vertical/dist') }}/assets/libs/moment/moment.min.js"></script>
        <script src="{{ asset('greeva/vertical/dist') }}/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
        <script src="{{ asset('greeva/vertical/dist') }}/assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js"></script>
        <script src="{{ asset('greeva/vertical/dist') }}/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
        <script src="{{ asset('greeva/vertical/dist') }}/assets/libs/bootstrap-daterangepicker/daterangepicker.js"></script>

        <!-- datatable js -->
        <script src="{{ asset('greeva/vertical/dist') }}/assets/libs/datatables/jquery.dataTables.min.js"></script>
        <script src="{{ asset('greeva/vertical/dist') }}/assets/libs/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="{{ asset('greeva/vertical/dist') }}/assets/libs/datatables/dataTables.responsive.min.js"></script>
        <script src="{{ asset('greeva/vertical/dist') }}/assets/libs/datatables/responsive.bootstrap4.min.js"></script>
        <script src="{{ asset('greeva/vertical/dist') }}/assets/libs/datatables/dataTables.buttons.min.js"></script>
        <script src="{{ asset('greeva/vertical/dist') }}/assets/libs/datatables/buttons.bootstrap4.min.js"></script>
        <script src="{{ asset('greeva/vertical/dist') }}/assets/libs/datatables/buttons.html5.min.js"></script>
        <script src="{{ asset('greeva/vertical/dist') }}/assets/libs/datatables/buttons.flash.min.js"></script>
        <script src="{{ asset('greeva/vertical/dist') }}/assets/libs/datatables/buttons.print.min.js"></script>
        <script src="{{ asset('greeva/vertical/dist') }}/assets/libs/datatables/dataTables.keyTable.min.js"></script>
        <script src="{{ asset('greeva/vertical/dist') }}/assets/libs/datatables/dataTables.select.min.js"></script>

        <script src="{{ asset('greeva/vertical/dist') }}/assets/libs/summernote/summernote-bs4.min.js"></script>

        <script src="{{ asset('greeva/vertical/dist') }}/assets/libs/chartist/chartist.min.js"></script>
        <script src="{{ asset('greeva/vertical/dist') }}/assets/libs/chartist/chartist-plugin-tooltip.min.js"></script>

        <!-- Ion Range Slider-->
        <script src="{{ asset('greeva/vertical/dist') }}/assets/libs/ion-rangeslider/ion.rangeSlider.min.js"></script>

        <!-- Range slider init js-->
        <script src="{{ asset('greeva/vertical/dist') }}/assets/js/pages/range-sliders.init.js"></script>
        <!-- Init js -->
        <script src="{{ asset('greeva/vertical/dist') }}/assets/js/pages/form-summernote.init.js"></script>
        <script src="{{ asset('greeva/vertical/dist') }}/assets/js/pages/datatables.init.js"></script>
        <script src="{{ asset('greeva/vertical/dist') }}/assets/js/pages/form-advanced.init.js"></script>
        <script src="{{ asset('greeva/vertical/dist') }}/assets/js/app.min.js"></script>

        <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
        <script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
        <script src="{{ asset('js/custom.js') }}"></script>

        @stack('js')
        @yield('script')

    </body>
</html>
