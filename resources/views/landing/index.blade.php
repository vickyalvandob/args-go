
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="author" content="{{ config('app.name', 'Laravel') }}" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('greeva/Landing') }}/images/favicon.ico">
        <link rel="stylesheet" href="{{ asset('greeva/Landing') }}/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" type="text/css" href="{{ asset('greeva/Landing') }}/css/materialdesignicons.min.css" />
        <link rel="stylesheet" type="text/css" href="{{ asset('greeva/Landing') }}/css/pe-icon-7-stroke.css" />
        <link rel="stylesheet" type="text/css" href="{{ asset('greeva/Landing') }}/css/owl.carousel.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('greeva/Landing') }}/css/owl.theme.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('greeva/Landing') }}/css/owl.transitions.css">
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

        <!-- Custom  sCss -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="{{ asset('greeva/Landing') }}/css/style.css" />
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
        @stack('css')
        <style>

h1,
h2,
h3,
h4,
h5,
h6 {
    font-family: "NexaLight", sans-serif;
    letter-spacing: 1px;
}

a {
  text-decoration: none !important;
  font-family: "NexaLight", sans-serif;
    outline: none;
}

p {
    line-height: 1.8;
    font-family: "NexaLight", sans-serif;
    font-size: 20px;
}

            .swiper-container {
width: 100%;
height: 100%;
}

.swiper-slide {
/* Center slide text vertically */
display: -webkit-box;
display: -ms-flexbox;
display: -webkit-flex;
display: flex;
-webkit-box-pack: center;
-ms-flex-pack: center;
-webkit-justify-content: center;
justify-content: center;
-webkit-box-align: center;
-ms-flex-align: center;
-webkit-align-items: center;
align-items: center;
}
         </style>
    </head>

    <body>
        @include('sweet::alert')

        <div class="preloader bg-main-gradient">
            <div class="loading">
                <div class="lds-ripple"><div></div><div></div></div>
            </div>
        </div>

        <nav class="navbar navbar-expand-lg fixed-top navbar-custom sticky sticky-dark">
            <div class="container-fluid">
                <!-- LOGO -->
                <a class="logo text-uppercase" href="{{ route('home') }}">
                    <img src="{{ asset('img/'.$general->logo_light.'') }}" alt="" class="logo-light" height="35" />
                    <img src="{{ asset('img/'.$general->logo_dark.'') }}" alt="" class="logo-dark" height="35" />
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="mdi mdi-menu"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mx-auto navbar-center" id="mySidenav">
                        <li class="nav-item active">
                            <a href="#about" class="nav-link">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a href="#why" class="nav-link">Why Us</a>
                        </li>
                        <li class="nav-item">
                            <a href="#product" class="nav-link">Our Product</a>
                        </li>
                        <li class="nav-item">
                            <a href="#partner" class="nav-link">Our Partner</a>
                        </li>
                        <li class="nav-item">
                            <a href="#faq" class="nav-link">FAQ</a>
                        </li>
                        <li class="nav-item">
                            <a href="#contact" class="nav-link">Contact Us</a>
                        </li>
                    </ul>
                    @guest
                    <a href="{{ route('login') }}" class="btn btn-sm btn-warning w3-orange px-3 w3-text-white border-0 btn-rounded m-1 navbar-btn"><strong>Login</strong></a>
                    <a href="{{ route('register') }}" class="btn btn-sm btn-warning w3-orange px-3 w3-text-white border-0 btn-rounded m-1 navbar-btn"><strong>Register</strong></a>
                    @endguest
                    @auth
                    <a href="{{ route('user.dashboard') }}" class="btn btn-sm btn-warning w3-orange px-3 w3-text-white border-0 btn-rounded m-1 navbar-btn"><strong>dashboard</strong></a>
                    @endauth
                </div>
            </div>
        </nav>
        <!-- Navbar End -->


        <!-- home start -->
        <section class="bg-home bg-main" id="home">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="home-title">
                        <h2 class="mb-3 text-white">{{ $general->header_title }}</h2>
                            <p class="text-white mb-3"><strong>{{ $general->header_description }}</strong></p>
                            <div class="search-form mt-3">
                                <a  href="{{ route('login') }}" class="btn btn-custom btn-rounded px-4 " style="position: relative;z-index:99"><strong>  Join Now  <i class="mdi mdi-arrow-right ml-1"> </i></strong></a>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6 offset-lg-1">
                        <div class="home-img mt-3 mt-lg-0">
                            <img src="{{ asset('img/'.$general->header_image.'') }}" alt="" class="img-fluid mx-auto d-block">
                        </div>
                    </div>
                </div>
                <!-- row end -->
            </div>
            <!-- container-fluid end -->
            <div class="bg-pattern-effect">
                <img src="{{ asset('img/wave.svg') }}" alt="">
            </div>

        </section>
        <!-- home end -->

        <!-- Services start -->
        <section class="section">
            <div class="container-fluid">
                <div class="row justify-content-between">
                    <div class="col-md-5 d-none d-md-block">
                        <img src="{{ asset('img/banner-2.png') }}" alt="" class="img-fluid" style="margin-top:-200px">
                    </div>
                    <div class="col-md-6">
                        <span class="bg-light w3-large text-dark w3-padding font-weight-bold w3-round-large d-inline-block my-1">Ingin memulai bisnis atau jualan online ???</span>
                        <div class="">
                            <span class=" bg-light w3-large text-dark w3-padding font-weight-bold w3-round-large d-inline-block my-1">Tapi..... Bingung mau berbisnis atau jualan apa ???</span>
                        </div>
                        <div class="">
                            <span class="bg-light w3-large text-dark w3-padding font-weight-bold w3-round-large d-inline-block my-1">Ingin Berbisnis atau jualan tanpa harus keluar rumah ????</span>
                        </div>
                        <span class="bg-light w3-large text-dark w3-padding font-weight-bold w3-round-large d-inline-block my-1">Tidak punya modal untuk stock barang, gaji pegawai, dan lain nya  ???</span>
                        <br>
                        <br>
                       <div class=" text-center text-md-left">
                        <a  href="{{ route('login') }}" class="btn btn-custom btn-rounded px-4" style="position: relative;z-index:99"><strong>  Join Now  <i class="mdi mdi-arrow-right ml-1"> </i></strong></a>
                       </div>
                    </div>
                </div>


            </div>
            <!-- container-fluid end -->
            <div class="bg-pattern-effect" >
                <img src="{{ asset('img/wave2.svg') }}" alt="">
            </div>
        </section>
        <!-- Services end -->


        <!-- testimonial start -->
        <section class="section bg-main">
            <div class="container-fluid text-center font-weight-bold">
                <img src="{{ asset('img/'.$general->logo_light.'') }}" alt="" class="logo-light" height="70" />
                <br><br>
                <p
                    class="text-white mb-4"><strong>Program Reseller untuk para pembina online tanpa harus riber dan di lengkapi dengan ribuan produk dan ribuan design yang unik dan menarik.</strong>
                </p>
                <p class="text-white">Hanya dengan 3 Langkah mudah :</p> <br>
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ asset('img/step1.png') }}" alt="" style="max-height: 150px" class="img-fluid mb-2">
                            <p class="text-white"> Pilih Product yang anda inginkan</p>
                        </div>
                        <div class="col-md-4">
                            <img src="{{ asset('img/step2.png') }}" alt="" style="max-height: 150px" class="img-fluid mb-2">
                            <p class="text-white">Upload Ditoko/ Social media anda</p>
                        </div>
                        <div class="col-md-4">
                            <img src="{{ asset('img/step3.png') }}" alt="" style="max-height: 150px" class="img-fluid mb-2">
                            <p class="text-white">Lakukan pesanan di member area</p>
                        </div>
                    </div>
                </div>
                <br>
                <p class="text-white">Product akan kami packing dan kirim ke Customer Anda dengan nama dan Brand Anda sendiri</p>
                <a  href="{{ route('login') }}" class="btn btn-custom btn-rounded px-4"><strong>Join Now  <i class="mdi mdi-arrow-right ml-1"> </i></strong></a>
            </div>

            <img src="{{ asset('img/wave.svg') }}" alt="" style="margin-bottom:-150px">
        </section>

        <section class="section" id="about">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="title text-center pt-3">
                            <h2 class="text-uppercase mb-3">About Redis.id</h2>
                            <p>REDIS.ID merupakan “Platform” untuk para Reseller,  dimana mereka dapat memilih ribuan produk serta ribuan design untuk mereka pasarkan, tanpa perlu :</p>

                        </div>
                    </div>
                  </div>

                  {{-- row --}}
                  <div class="row justify-content-around text-center">

                    {{-- card about --}}
                    <div class="col-lg-3 col-sm-6">
                      <div class="card-body">
                        <div class="services-icon  mb-3">
                          <img src="{{ asset('img/about1.png') }}" alt="">
                        </div>
                        <h4 class="mb-3">Menyetok barang</h4>
                      </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                      <div class="card-body">
                        <div class="services-icon mb-3">
                          <img src="{{ asset('img/about2.png') }}" alt="">
                        </div>
                        <h4 class="mb-3">Menghire pegawai</h4>
                      </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                      <div class="card-body">
                        <div class="services-icon mb-3">
                          <img src="{{ asset('img/about3.png') }}" alt="">
                        </div>
                        <h4 class="mb-3">Packing Barang</h4>
                      </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                      <div class="card-body">
                        <div class="services-icon mb-3">
                          <img src="{{ asset('img/about4.png') }}" alt="">
                        </div>
                        <h4 class="mb-3">Mengirim Barang</h4>
                      </div>
                    </div>
                    {{-- end card-about --}}

                  </div>
                  <!-- row end -->

                  <div class="title text-center mb-5">
                    <p>Segala kebutuhan para Reseller telah tersedia di dalam Platform “REDIS.ID”.</p>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    @foreach ($products as $product)
                                    <div class="swiper-slide">
                                        <img class="img-fluid  w3-round-xxlarge m-2" src="{{ asset('img/'.$product->image.'') }}" alt="Card image cap">
                                    </div>
                                    @endforeach
                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                        </div>
                    </div>

                    <p>Saatnya memulai bisnis dengan cara yang mudah dan terjangkau</p>
                    <h4><strike>  <span class="font-30 w3-xxlarge w3-text-orange">Rp. 349.000,-</span>  /tahun</strike></h4>
                    <h4> <span class="font-40 w3-xxlarge w3-text-orange">Rp. 149.000,-</span>  /tahun</h4>


                    <div class="row justify-content-center">
                        <div class="col-md-9">
                            <div class="p-4">
                                <img src="{{ asset('images/asset3.png') }}" class="img-fluid" alt="">
                            </div>
                            <p>Dan dapatkan segala kemudahan dan kenyamanan dalam berbisnis baik secara online
                                ataupun offline dengan dukungan dari banyak team support yang siap membantu
                                Senin – Minggu (08:00 – 21:00).</p>
                              <br>
                              <button type="button" class="btn btn-custom btn-orange px-4 btn-rounded"><strong>Join Now</strong></button>
                        </div>
                    </div>

                  </div>

                <!-- container-fluid end -->
                </div>

                    <img src="{{ asset('img/wave2.svg') }}" alt="" style="margin-bottom:-150px">
        </section>

        <section class="section bg-main text-center" id="why">
            <div class="container-fluid">
                <h2 class="text-uppercase text-white mb-3">Why Redis.ID</h2>
                <div class="row justify-content-around text-center text-white">
                    @foreach ($whys as $why)
                    <div class="col-md-4">
                        <div class="card-body">
                            <img src="{{ asset('img/'.$why->image.'') }}" class="img-fluid mb-2" alt="">
                            <h4 class="text-white">{{ $why->title }}</h4>
                        </div>
                    </div>
                    @endforeach
                <div class="col-md-12 mt-4">
                    <a href="#contact" class="btn btn-custom btn-rounded px-4"><strong>Contact Us now!</strong></a>
                </div>
                </div>
            </div>

            <img src="{{ asset('img/wave.svg') }}" alt="" style="margin-bottom:-150px">
        </section>

        <section class="section text-center" id="product">
            <div class="container-fluid">
               <div class="py-2">
                <h2 class="text-uppercase mb-3">Our Product</h2>
                <div class="row justify-content-center">
                    @if (count($products) > 0)
                    @foreach ($products as $product)
                    <div class="col-md-4 p-md-3">
                        <div class="card w3-round-xxlarge shadow" style="min-height: 500px">
                            <div class="card-body w3-round-xxlarge shadow d-flex flex-column ">

                                <div class="text-center my-auto">
                                    <a href="{{ route('user.product.show',$product->id) }}">
                                        <h5 class="card-title mb-0">{{ $product->name }}</h5>

                                    </a>
                                    <br>
                                    <a href="{{ route('user.product.show',$product->id) }}">

                                        <img class="img-fluid w3-round-xxlarge img-shadow" src="{{ asset('img/'.$product->image.'') }}" alt="Card image cap" style="max-height: 250px">

                                    </a>
                                    <br>
                                    <br>
                                   @if ($product->variant_status == 'active')

                                   @php
                                   $min_price = \App\ProductVariant::where('product_id', $product->id)->min('price');
                                   $max_price = \App\ProductVariant::where('product_id', $product->id)->max('price');
                                   $min_low_price = \App\ProductVariant::where('product_id', $product->id)->min('low_price');
                                   $max_low_price = \App\ProductVariant::where('product_id', $product->id)->max('low_price');
                                   $min_high_price = \App\ProductVariant::where('product_id', $product->id)->min('high_price');
                                   $max_high_price = \App\ProductVariant::where('product_id', $product->id)->max('high_price');
                                    @endphp
                                    <h4 class="font-weight-bold mb-1">
                                         @if ($min_price == $max_price)
                                        {{ number_format($max_price , 2, ',', '.') ?? ""  }} <small>{{ $general->currency }} </small>
                                          @else
                                            {{ number_format($min_price , 2, ',', '.') ?? ""  }} - {{ number_format($max_price , 2, ',', '.') ?? ""  }} <small>{{ $general->currency }} </small>
                                          @endif </h4>
                                          <small>{{ number_format($product->point) }} <small>pt</small></small> <br><br>
                                   <table class="table table-sm table-borderless">
                                    <tr>
                                        <th class="text-left align-middle text-uppercase">low price</th>
                                        <td class="text-right align-middle text-uppercase font-weight-bold">
                                            {{ number_format($min_low_price , 2, ',', '.') ?? ""  }} <small>{{ $general->currency }} </small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-left align-middle text-uppercase">high Price</th>
                                        <td class="text-right align-middle text-uppercase font-weight-bold">
                                            {{ number_format($max_high_price , 2, ',', '.') ?? ""  }} <small>{{ $general->currency }} </small>
                                        </td>
                                    </tr>

                                </table>

                                   @else
                                   <h4 class="font-weight-bold mb-1">
                                    {{ number_format($product->price , 2, ',', '.') ?? ""  }} <small>{{ $general->currency }} </small></h4>
                                    <small>{{ number_format($product->point) }} <small>pt</small></small> <br><br>

                                   <table class="table table-sm table-borderless">


                                    <tr>
                                        <th class="text-left align-middle text-uppercase">low price</th>
                                        <td class="text-right align-middle text-uppercase font-weight-bold">

                                            {{ number_format($product->low_price , 2, ',', '.') ?? ""  }} <small>{{ $general->currency }} </small>

                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-left align-middle text-uppercase">high Price</th>
                                        <td class="text-right align-middle text-uppercase font-weight-bold">

                                            {{ number_format($product->high_price , 2, ',', '.') ?? ""  }} <small>{{ $general->currency }} </small>

                                        </td>
                                    </tr>

                                </table>
                                   @endif
                                <a class="font-weight-bold w3-hover-text-orange w3-text-amber" href="#" data-toggle="modal" data-target=".add-cart{{ $product->id }}">   <button type="button"  class="btn btn-warning w3-orange mr-1 w3-round-xxlarge w3-text-white  waves-effect waves-light"><i class="mdi mdi-cart-plus"></i></button> Add to cart</a>
                                   <div class="modal fade add-cart{{ $product->id }}" role="dialog">
                                       <div class="modal-dialog modal-dialog-centered">
                                           <div class="modal-content">
                                               <div class="modal-header">
                                                   <h5 class="modal-title"><i class="mdi mdi-cart mr-1"></i> add to cart</h5>
                                                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                               </div>
                                               <div class="modal-body text-center">

                                                <a href="{{ route('user.product.show',$product->id) }}">
                                                    <h5 class="card-title mb-0">{{ $product->name }}</h5>

                                                </a>
                                                <br>
                                                <a href="{{ route('user.product.show',$product->id) }}">

                                                    <img class="img-fluid w3-round-xxlarge img-shadow" src="{{ asset('img/'.$product->image.'') }}" alt="Card image cap" style="max-height: 150px">

                                                </a>
                                                <br>
                                                <br>
                                                @if ($product->variant_status == 'active')
                                                @php
                                                $productVariants = \App\ProductVariant::where('product_id', $product->id)->get();
                                                 @endphp
                                                <div class="swiper-container">
                                                    <div class="swiper-wrapper">
                                                        @foreach ($productVariants as $productVariant)
                                                        <div class="swiper-slide">

                                                            <form action="{{ route('user.cart.store') }}" enctype="multipart/form-data" class="text-capitalize" method="post">
                                                                @csrf
                                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                                <input type="hidden" name="product_variant_id" value="{{ $productVariant->id }}">

                                                                  <table class="table table-borderless table-sm">
                                                                    <tr>
                                                                       <td class="align-middle text-uppercase font-weight-bold" colspan="2">
                                                                           <strong>{{ $productVariant->name }}</strong>
                                                                        <h3 class="font-weight-bold mb-1">
                                                                          {{ number_format($productVariant->price , 2, ',', '.') ?? ""  }} <small>{{ $general->currency }} </small>

                                                                        </h3>
                                                                        <small>{{ number_format($product->point) }} <small class="text-lowercase">pt</small></small>
                                                                       </td>
                                                                   </tr>
                                                                   <tr>
                                                                      <th class="align-middle text-uppercase">low price</th>
                                                                       <td class="align-middle text-uppercase font-weight-bold">
                                                                           {{ number_format($productVariant->low_price , 2, ',', '.') ?? ""  }} <small>{{ $general->currency }} </small>
                                                                       </td>
                                                                   </tr>
                                                                   <tr>
                                                                      <th class="align-middle text-uppercase">high Price</th>
                                                                       <td class="align-middle text-uppercase font-weight-bold">
                                                                           {{ number_format($productVariant->high_price , 2, ',', '.') ?? ""  }} <small>{{ $general->currency }} </small>
                                                                       </td>
                                                                   </tr>
                                                                   <tr>
                                                                   <th class="align-middle text-uppercase">weight</th>
                                                                    <td class="align-middle text-uppercase font-weight-bold">
                                                                        {{ number_format($productVariant->weight) ?? ""  }} <small class="text-lowercase">gr</small>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                 <th class="align-middle text-uppercase">stock</th>
                                                                  <td class="align-middle text-uppercase font-weight-bold">
                                                                      {{ number_format($productVariant->stock) ?? ""  }} <small class="text-lowercase">pcs </small>
                                                                  </td>
                                                              </tr>
                                                               </table>
                                                                 <div class="row justify-content-center">
                                                                     <div class="col-md-7">
                                                                      <div class="form-row align-items-center">
                                                                          <div class="col">
                                                                              <input type="number" name="qty" required placeholder="qty" min="1" class="form-control w3-round-xxlarge mb-2" value="{{ old('qty') }}">
                                                                          </div>
                                                                          <div class="col-2">
                                                                              <button type="submit" class="btn btn-warning w3-orange w3-round-xxlarge w3-text-white waves-effect waves-light mb-2"><i class="mdi mdi-cart-plus "></i> </button>
                                                                          </div>
                                                                      </div>
                                                                     </div>
                                                                 </div>
                                                          </form>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="swiper-pagination"></div>
                                                </div>
                                                 @else
                                                 <form action="{{ route('user.cart.store') }}" enctype="multipart/form-data" class="text-capitalize p-md-4" method="post">
                                                  @csrf
                                                  <input type="hidden" name="product_id" value="{{ $product->id }}">

                                                    <table class="table table-borderless table-sm">
                                                      <tr>
                                                         <td class="align-middle text-uppercase font-weight-bold" colspan="2">
                                                          <h3 class="font-weight-bold mb-1">
                                                            {{ number_format($product->price , 2, ',', '.') ?? ""  }} <small>{{ $general->currency }} </small>

                                                          </h3>
                                                          <small>{{ number_format($product->point) }} <small class="text-lowercase">pt</small></small>
                                                         </td>
                                                     </tr>
                                                     <tr>
                                                        <th class="align-middle text-uppercase">low price</th>
                                                         <td class="align-middle text-uppercase font-weight-bold">
                                                             {{ number_format($product->low_price , 2, ',', '.') ?? ""  }} <small>{{ $general->currency }} </small>
                                                         </td>
                                                     </tr>
                                                     <tr>
                                                        <th class="align-middle text-uppercase">high Price</th>
                                                         <td class="align-middle text-uppercase font-weight-bold">
                                                             {{ number_format($product->high_price , 2, ',', '.') ?? ""  }} <small>{{ $general->currency }} </small>
                                                         </td>
                                                     </tr>
                                                     <tr>
                                                     <th class="align-middle text-uppercase">weight</th>
                                                      <td class="align-middle text-uppercase font-weight-bold">
                                                          {{ number_format($product->weight) ?? ""  }} <small class="text-lowercase">gr</small>
                                                      </td>
                                                  </tr>
                                                  <tr>
                                                   <th class="align-middle text-uppercase">stock</th>
                                                    <td class="align-middle text-uppercase font-weight-bold">
                                                        {{ number_format($product->stock) ?? ""  }} <small class="text-lowercase">pcs </small>
                                                    </td>
                                                </tr>
                                                 </table>
                                                   <div class="row justify-content-center">
                                                       <div class="col-md-6">
                                                        <div class="form-row align-items-center">
                                                            <div class="col">
                                                                <input type="number" name="qty" required placeholder="qty" min="1" class="form-control w3-round-xxlarge mb-2" value="{{ old('qty') }}">
                                                            </div>
                                                            <div class="col-2">
                                                                <button type="submit" class="btn btn-warning w3-orange w3-round-xxlarge w3-text-white waves-effect waves-light mb-2"><i class="mdi mdi-cart-plus "></i> </button>
                                                            </div>
                                                        </div>
                                                       </div>
                                                   </div>
                                            </form>
                                                 @endif






                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="col-md-12">
                        <div class="card-box">
                            <h4 class="text-center text-uppercase">
                                not available
                            </h4>
                        </div>
                    </div>
                    @endif
                </div>
               </div>
            </div>

            <img src="{{ asset('img/wave2.svg') }}" alt="" style="margin-bottom:-150px">
        </section>


        <section class="section bg-main" id="partner">
            <div class="container-fluid">

                <div class="pb-4">
                    <h2 class="text-uppercase text-white text-center mb-4">Our PARTNER</h2>
                    <div class="row justify-content-center">
                       <div class="col-md-8">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    @foreach ($partners as $partner)
                                    <div class="swiper-slide">
                                        <div class="row">
                                            <div class="col-md-4 text-center align-middle">
                                                <img src="{{ asset('img/'.$partner->image.'') }}" class="img-fluid w3-round-xlarge img-shadow">
                                            </div>
                                            <div class="col-md-8 p-2">
                                                <h3 class="text-white">{{ $partner->name }}</h3>
                                            <p class="text-white text-justify">{{ $partner->description }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <!-- Add Arrows -->
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                       </div>
                    </div>
                    <!-- row end -->

                </div>

                <div class="pt-4 text-center">
                    <h2 class="text-uppercase text-white mb-4">MEDIA PARTNER</h2>
                    <div class="row">
                       @foreach ($mediaPartners as $mediaPartner)
                       <div class="col-lg-3 col-sm-6">
                        <div class="client-images">
                            <img src="{{ asset('img/'.$mediaPartner->image.'') }}" alt="logo-img" class="mx-auto img-fluid d-block img-shadow">
                        </div>
                    </div>
                       @endforeach

                    </div>
                    <!-- row end -->
                </div>
            </div>

            <img src="{{ asset('img/wave.svg') }}" alt="" style="margin-bottom:-150px">
        </section>


        <section class="section" id="faq">

            <div class="container-fluid">


                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-center">
                            <i class="h1 mdi mdi-comment-multiple-outline w3-text-orange"></i>
                            <h3>Frequently Asked Questions</h3>
                        </div>
                    </div><!-- end col -->
                </div><!-- end row -->

                <div class="row mt-4">
                    <div class="col-lg-12">
                        <div id="accordion" class="mb-3">

                            @foreach ($faqs as $faq)
                            <div class="card m-2 img-shadow w3-round-xlarge">
                                <div class="card-header bg-white w3-round-xlarge" id="heading{{ $loop->iteration }}">
                                    <h5 class="m-0">
                                        <a class="text-dark" data-toggle="collapse" href="#collapse{{ $loop->iteration }}" aria-expanded="true">
                                            <i class="mdi mdi-help-circle mr-1 w3-text-orange"></i>
                                           {{ $faq->title }}
                                        </a>
                                    </h5>
                                </div>

                                <div id="collapse{{ $loop->iteration }}" class="collapse @if ($loop->iteration == '1')
                                    show
                                @endif" aria-labelledby="heading{{ $loop->iteration }}" data-parent="#accordion">
                                    <div class="card-body">
                                       <p class="text-justify">
                                           {{ $faq->description }}

                                       </p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <!-- FAQ Question-->




                        </div> <!-- end #accordion -->
                    </div> <!-- end col -->

                </div> <!-- end row -->
            </div>
        </section>



        <!-- contact us start -->
        <section class="section pb-lg-0" id="contact">
            <div class="container-fluid">
                <div class="row justify-content-between">

                    <div class="col-lg-8">
                        <div class="card w3-round-large">

                            <div class="card-body w3-round-large">
                                <h3 class="text-uppercase">contact <span class="w3-text-orange">us</span></h3>
                                <p>Feel free to contact us any time, we will get back to you as soon as we can!</p>
                                <br>
                                <form action="{{ route('message') }}" enctype="multipart/form-data" class="text-capitalize row" method="post">
                                    @csrf
                                    <div class="form-group col-md-6">
                                        <label>name</label>
                                        <input type="text" name="name" placeholder="name" required class="form-control" value="{{ old('name') }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>email</label>
                                        <input type="email" name="email" placeholder="email" required class="form-control" value="{{ old('email') }}">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>message</label>
                                        <textarea name="description" class="form-control" rows="4" required placeholder="Your message..">{{ old('description') }}</textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <button class="btn btn-custom btn-block btn-rounded btn-block" type="submit"><i class="mdi mdi-send"></i> send</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-3 text-center text-md-left">
                        <h3 class="text-uppercase">contact <span class="w3-text-orange">info</span></h3>
                        <br>
                        <h4 class="my-2"> <i class="mdi mdi-phone w3-xxlarge mr-1"></i> {{ $general->phone }}</h4>
                        <h4 class="my-2"> <i class="mdi mdi-email w3-xxlarge mr-1"></i> {{ $general->email }}</h4>
                        <h4 class="my-2"> <i class="mdi mdi-city w3-xxlarge mr-1"></i> {{ $general->address }}</h4>
                        <h4 class="my-2"> <i class="mdi mdi-clock w3-xxlarge mr-1"></i> {{ $general->work_time }}</h4>
                    </div>
                </div>
                <!-- row end -->
            </div>
            <!-- container-fluid end -->
        </section>
        <!-- contact us end -->



        <div class="footer-alt py-3 bg-white">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0"><strong>2020 © {{ $general->title }}</strong></p>
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

        <script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
        <script src="{{ asset('js/custom.js') }}"></script>

 <!-- Initialize Swiper -->
 <script>
    var swiper = new Swiper('.swiper-container', {
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
  </script>

        @stack('js')
    </body>

</html>
