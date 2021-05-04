@extends('mobile.layouts.app')

@section('content')

  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">


        <div class="row">
            <div class="col-md-12 p-4 text-center">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <h4><i class="mdi mdi-bank"></i></h4>
                            </div>
                            <div class="col-4">
                                <h4><i class="mdi mdi-swap-horizontal"></i></h4>
                            </div>
                            <div class="col-4">
                                <h4><i class="mdi mdi-history"></i></h4>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="container">
            <div class="row m-3 text-center">
                <div class="col-3 p-2">
                    <a class="icons icon-60 shadow-sm bg-white">
                        <i class="material-icons text-default">local_cafe</i>
                    </a>
                    <p class="small mt-2 mb-0 text-mute">Coffee</p>
                    <p class="small text-success">-8%</p>
                </div>
                <div class="col-3 p-2">
                    <a class="icons icon-60 shadow-sm bg-white">
                        <i class="material-icons text-default">local_cafe</i>
                    </a>
                    <p class="small mt-2 mb-0 text-mute">Coffee</p>
                    <p class="small text-success">-8%</p>
                </div>
                <div class="col-3 p-2">
                    <a class="icons icon-60 shadow-sm bg-white">
                        <i class="material-icons text-default">local_cafe</i>
                    </a>
                    <p class="small mt-2 mb-0 text-mute">Coffee</p>
                    <p class="small text-success">-8%</p>
                </div>
                <div class="col-3 p-2">
                    <a class="icons icon-60 shadow-sm bg-white">
                        <i class="material-icons text-default">local_cafe</i>
                    </a>
                    <p class="small mt-2 mb-0 text-mute">Coffee</p>
                    <p class="small text-success">-8%</p>
                </div>
                <div class="col-3 p-2">
                    <a class="icons icon-60 shadow-sm bg-white">
                        <i class="material-icons text-default">local_cafe</i>
                    </a>
                    <p class="small mt-2 mb-0 text-mute">Coffee</p>
                    <p class="small text-success">-8%</p>
                </div>
                <div class="col-3 p-2">
                    <a class="icons icon-60 shadow-sm bg-white">
                        <i class="material-icons text-default">local_cafe</i>
                    </a>
                    <p class="small mt-2 mb-0 text-mute">Coffee</p>
                    <p class="small text-success">-8%</p>
                </div>
            </div>
        </div>
        <div class="container mb-4 px-2">
            <div class="swiper-container swiper-offers">
                <div class="swiper-wrapper">
                    <div class="swiper-slide w-auto p-2">
                        <div class="card shadow-sm w-250 border-0">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body">
                                        <h4>10% Off</h4>
                                        <h6 class="mb-1 text-mute">Dominooz</h6>
                                        <p>Code: <span class="badge badge-success">OfferTX01</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide w-auto p-2">
                        <div class="card shadow-sm w-250 border-0">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body">
                                        <h4>20% Off</h4>
                                        <h6 class="mb-1 text-mute">AmericanExpress</h6>
                                        <p>Code: <span class="badge badge-success">OfferTC09</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide w-auto p-2">
                        <div class="card shadow-sm w-250 border-0">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body">
                                        <h4>50% Off</h4>
                                        <h6 class="mb-1 text-mute">Pizza</h6>
                                        <p>Code: <span class="badge badge-success">OfferPZZ1</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <div class="tab-pane fade" id="recurring" role="tabpanel" aria-labelledby="recurring-tab">
        <div class="container mb-3">
            <h5 class="page-subtitle">Current Recurring<br>
                <span class="text-mute small mt-2">From your Credit Cards</span>
            </h5>
        </div>
        <div class="container px-0">
            <div class="swiper-container swipercards">
                <div class="swiper-wrapper pb-4">
                    <div class="swiper-slide shadow card w-300 overflow-hidden bg-default border-0 ">
                        <div class="card-header border-0">
                            <h4 class="text-italic mb-1">Fizza</h4>
                            <p class="text-mute small">Credit Card</p>
                        </div>
                        <div class="card-body">
                            <h4 class="font-weight-normal mt-3">**** **** **** 9858</h4>
                            <h6>Maxartkiller Banks<span class="float-right">12/20</span></h6>
                        </div>
                    </div>
                    <div class="swiper-slide shadow card w-300 overflow-hidden bg-dark-blue text-white border-0 ">
                        <div class="card-header border-0">
                            <h4 class="text-italic mb-1">MasterCords</h4>
                            <p class="text-mute small">Credit Card</p>
                        </div>
                        <div class="card-body">
                            <h4 class="font-weight-normal mt-3">**** **** **** 9858</h4>
                            <h6>Maxartkiller Banks<span class="float-right">12/20</span></h6>
                        </div>
                    </div>
                    <div class="swiper-slide shadow card w-300 overflow-hidden bg-purple text-white border-0 ">
                        <div class="card-header border-0">
                            <h4 class="text-italic mb-1">AmericanExports</h4>
                            <p class="text-mute small">Credit Card</p>
                        </div>
                        <div class="card-body">
                            <h4 class="font-weight-normal mt-3">**** **** **** 9858</h4>
                            <h6>Maxartkiller Banks<span class="float-right">12/20</span></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container text-center">
            <button class="btn btn-outline-default"><i class="material-icons">speaker_phone</i> Checkout</button>
        </div>
        <div class="container">
            <h6 class="page-subtitle">Recent Transactions</h6>
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="media">
                        <figure class="icons icon-40 mr-2 bg-light-default">
                            <i class="material-icons">restaurant</i>
                        </figure>
                        <div class="media-body">
                            <h6 class="mb-1">Food bill paid</h6>
                            <p class="mb-0 text-mute small">$ 320</p>
                        </div>
                    </div>
                </div>
                <div class="card-body border-top">
                    <div class="media">
                        <figure class="icons icon-40 mr-2 bg-light-default">
                            <i class="material-icons">shopping_cart</i>
                        </figure>
                        <div class="media-body">
                            <h6 class="mb-1">Flipskart Shpopping</h6>
                            <p class="mb-0 text-mute small">$ 500</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <h6 class="page-subtitle">Current Recurring</h6>
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <div class="media">
                        <figure class="icons icon-40 mr-2 bg-light-default">
                            <i class="material-icons">home</i>
                        </figure>
                        <div class="media-body">
                            <h6 class="mb-1">Home Loan EMI | HSBCbank</h6>
                            <p class="mb-0">$ 320 <small class="text-mute float-right">Next Due: 5 Jan 2020</small></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <div class="media">
                        <figure class="icons icon-40 mr-2 bg-light-default">
                            <i class="material-icons">directions_car</i>
                        </figure>
                        <div class="media-body">
                            <h6 class="mb-1">Car Loan EMI | Fineserve</h6>
                            <p class="mb-0">$ 320 <small class="text-mute float-right">Next Due: 5 Jan 2020</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <h6 class="page-subtitle">Send Money</h6>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="media mb-4">
                        <figure class="avatar avatar-50 mr-3">
                            <img src="{{ asset('oneuiux/finance') }}/assets/img/user1.png" alt="Generic placeholder image">
                        </figure>
                        <div class="media-body">
                            <h6 class="mt-1 mb-1">John Doe <span class="status vm bg-success"></span></h6>
                            <p class="small text-mute">New Jersey, UK</p>
                        </div>
                        <button class="btn btn-outline-default pr-2">Send <i class="material-icons ml-2">send</i></button>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="media mb-4">
                        <figure class="avatar avatar-50 mr-3">
                            <img src="{{ asset('oneuiux/finance') }}/assets/img/user2.png" alt="Generic placeholder image">
                        </figure>
                        <div class="media-body">
                            <h6 class="mt-1 mb-1">Astha Shrestha <span class="status vm bg-success"></span></h6>
                            <p class="small text-mute">New Jersey, UK</p>
                        </div>
                        <button class="btn btn-outline-default pr-2">Send <i class="material-icons ml-2">send</i></button>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="media mb-4">
                        <figure class="avatar avatar-50 mr-3">
                            <img src="{{ asset('oneuiux/finance') }}/assets/img/user3.png" alt="Generic placeholder image">
                        </figure>
                        <div class="media-body">
                            <h6 class="mt-1 mb-1">Naveen Sayeed <span class="status vm bg-success"></span></h6>
                            <p class="small text-mute">New Jersey, UK</p>
                        </div>
                        <button class="btn btn-outline-default pr-2">Send <i class="material-icons ml-2">send</i></button>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="media mb-4">
                        <figure class="avatar avatar-50 mr-3">
                            <img src="{{ asset('oneuiux/finance') }}/assets/img/user4.png" alt="Generic placeholder image">
                        </figure>
                        <div class="media-body">
                            <h6 class="mt-1 mb-1">Naveen Sayeed <span class="status vm bg-success"></span></h6>
                            <p class="small text-mute">New Jersey, UK</p>
                        </div>
                        <button class="btn btn-outline-default pr-2">Send <i class="material-icons ml-2">send</i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="favorite" role="tabpanel" aria-labelledby="favorite-tab">
        <div class="container">
            <h5 class="page-subtitle">Activity</h5>
        </div>
        <div class="container-fluid px-0">
            <div class="list-group list-group-flush my-0 w-100 border-top border-bottom">
                <div class="list-group-item">
                    <div class="row">
                        <a class="col-auto" data-toggle="modal" data-target="#statusmodal">
                            <figure class="avatar avatar-40">
                                <img src="{{ asset('oneuiux/finance') }}/assets/img/user4.png" alt="">
                            </figure>
                        </a>
                        <div class="col pl-0 align-self-center">
                            <h6 class="mb-1 font-weight-normal"><b>Ankit Trivedi</b>, <b>John MAcMillan</b> and <b>36 others</b> are started following you </h6>
                            <p class="small text-mute">2 Days ago</p>
                        </div>
                    </div>
                </div>
                <div class="list-group-item bg-light text-center py-2 text-mute">This month</div>
                <a class="list-group-item" data-toggle="modal" data-target="#statusmodal">
                    <div class="row">
                        <div class="col-auto">
                            <figure class="avatar avatar-40">
                                <img src="{{ asset('oneuiux/finance') }}/assets/img/user3.png" alt="">
                            </figure>
                        </div>
                        <div class="col pl-0 align-self-center">
                            <h6 class="mb-1 font-weight-normal"><b>Williums</b> Liked your picture you posted</h6>
                            <p class="small text-mute">last week</p>
                        </div>
                    </div>
                </a>
                <a class="list-group-item" data-toggle="modal" data-target="#statusmodal">
                    <div class="row">
                        <div class="col-auto">
                            <figure class="avatar avatar-40">
                                <img src="{{ asset('oneuiux/finance') }}/assets/img/user4.png" alt="">
                            </figure>
                        </div>
                        <div class="col pl-0 align-self-center">
                            <h6 class="mb-1 font-weight-normal"><b>johnson</b> Followed you and he also folled many of your groups and community</h6>
                            <p class="small text-mute">2 Week ago</p>
                        </div>
                    </div>
                </a>
                <a class="list-group-item" data-toggle="modal" data-target="#statusmodal">
                    <div class="row">
                        <div class="col-auto">
                            <figure class="avatar avatar-40">
                                <img src="{{ asset('oneuiux/finance') }}/assets/img/user1.png" alt="">
                            </figure>
                        </div>
                        <div class="col pl-0 align-self-center">
                            <h6 class="mb-1 font-weight-normal"><b>Maxartkillers</b> Liked your picture you posted</h6>
                            <p class="small text-mute">2 Week ago</p>
                        </div>
                    </div>
                </a>
                <a class="list-group-item" data-toggle="modal" data-target="#statusmodal">
                    <div class="row">
                        <div class="col-auto">
                            <figure class="avatar avatar-40">
                                <img src="{{ asset('oneuiux/finance') }}/assets/img/user2.png" alt="">
                            </figure>
                        </div>
                        <div class="col pl-0 align-self-center">
                            <h6 class="mb-1 font-weight-normal"><b>Silvasaa </b> is now your follower please feel free to follow back</h6>
                            <p class="small text-mute">3 Week ago</p>
                        </div>
                    </div>
                </a>
                <div class="list-group-item bg-light text-center py-2 text-mute">Earlier</div>
                <a class="list-group-item">
                    <div class="row">
                        <div class="col-auto">
                            <figure class="avatar avatar-40">
                                <img src="{{ asset('oneuiux/finance') }}/assets/img/user4.png" alt="">
                            </figure>
                        </div>
                        <div class="col pl-0 align-self-center">
                            <h6 class="mb-1 font-weight-normal"><b>Alic Boddy</b> Liked your picture you posted</h6>
                            <p class="small text-mute">1 month ago</p>
                        </div>
                    </div>
                </a>
                <a class="list-group-item">
                    <div class="row">
                        <div class="col-auto">
                            <figure class="avatar avatar-40">
                                <img src="{{ asset('oneuiux/finance') }}/assets/img/user3.png" alt="">
                            </figure>
                        </div>
                        <div class="col pl-0 align-self-center">
                            <h6 class="mb-1 font-weight-normal"><b>John</b> Liked your picture you posted</h6>
                            <p class="small text-mute">2 month ago</p>
                        </div>
                    </div>
                </a>

            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="container text-center my-4">
            <figure class="avatar avatar-180 rounded-circle shadow  mx-auto">
                <img src="{{ asset('oneuiux/finance') }}/assets/img/user1.png" alt="">
            </figure>
        </div>
        <div class="container-fluid text-center mb-4">
            <h4>Maxartkiller</h4>
            <p class="text-mute">Vennanya, USA.</p>
        </div>
        <div class="container mb-4">
            <ul class="nav nav-pills nav-fill justift-content-center mb-4" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link  active" id="account-tab" data-toggle="tab" href="#account" role="tab" aria-controls="account" aria-selected="false">Account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="myorders-tab" data-toggle="tab" href="#myorders" role="tab" aria-controls="myorders" aria-selected="true">Transactions</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
                    <h6 class="page-subtitle">Personal Details</h6>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="text-mute">Birth Date</label>
                                <p>25/10/1981</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="text-mute">Gender</label>
                                <p>Male</p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="text-mute">Email Address</label>
                                <p>info@maxartkiller.com</p>
                            </div>
                        </div>
                    </div>
                    <h6 class="page-subtitle"><span>About</span></h6>
                    <p class="text-mute">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ut labore et dolore magna aliqua.</p>
                </div>
                <div class="tab-pane fade " id="myorders" role="tabpanel" aria-labelledby="myorders-tab">
                    <h6 class="page-subtitle">Recent Transactions</h6>
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <div class="media">
                                <figure class="icons icon-40 mr-2 bg-light-default">
                                    <i class="material-icons">restaurant</i>
                                </figure>
                                <div class="media-body">
                                    <h6 class="mb-1">Food bill paid</h6>
                                    <p class="mb-0 text-mute small">$ 320</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-top">
                            <div class="media">
                                <figure class="icons icon-40 mr-2 bg-light-default">
                                    <i class="material-icons">shopping_cart</i>
                                </figure>
                                <div class="media-body">
                                    <h6 class="mb-1">Flipskart Shpopping</h6>
                                    <p class="mb-0 text-mute small">$ 500</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-top">
                            <div class="media">
                                <figure class="avatar avatar-40 mr-2 bg-light-default">
                                    <img src="{{ asset('oneuiux/finance') }}/assets/img/user1.png" alt="">
                                </figure>
                                <div class="media-body">
                                    <h6 class="mb-1">Money transferred to Maxartkiller</h6>
                                    <p class="mb-0 text-mute small">$ 500</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-top">
                            <div class="media">
                                <figure class="avatar avatar-40 mr-2 bg-light-default">
                                    <img src="{{ asset('oneuiux/finance') }}/assets/img/user3.png" alt="">
                                </figure>
                                <div class="media-body">
                                    <h6 class="mb-1">Money transferred to John</h6>
                                    <p class="mb-0 text-mute small">$ 150</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-top">
                            <div class="media">
                                <figure class="icons icon-40 mr-2 bg-light-default">
                                    <i class="material-icons">restaurant</i>
                                </figure>
                                <div class="media-body">
                                    <h6 class="mb-1">Food bill paid</h6>
                                    <p class="mb-0 text-mute small">$ 320</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-top">
                            <div class="media">
                                <figure class="icons icon-40 mr-2 bg-light-default">
                                    <i class="material-icons">shopping_cart</i>
                                </figure>
                                <div class="media-body">
                                    <h6 class="mb-1">Flipskart Shpopping</h6>
                                    <p class="mb-0 text-mute small">$ 500</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-top">
                            <div class="media">
                                <figure class="avatar avatar-40 mr-2 bg-light-default">
                                    <img src="{{ asset('oneuiux/finance') }}/assets/img/user1.png" alt="">
                                </figure>
                                <div class="media-body">
                                    <h6 class="mb-1">Money transferred to Maxartkiller</h6>
                                    <p class="mb-0 text-mute small">$ 500</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-top">
                            <div class="media">
                                <figure class="avatar avatar-40 mr-2 bg-light-default">
                                    <img src="{{ asset('oneuiux/finance') }}/assets/img/user3.png" alt="">
                                </figure>
                                <div class="media-body">
                                    <h6 class="mb-1">Money transferred to John</h6>
                                    <p class="mb-0 text-mute small">$ 150</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="toast bottom-center position-fixed mb-5" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
    <div class="toast-header">
        <div class="avatar avatar-20 mr-2">
            <div class="background">
                <img src="{{ asset('oneuiux/finance') }}/assets/img/team3.jpg" class="rounded mr-2" alt="...">
            </div>
        </div>
        <strong class="mr-auto">Maxartkiller</strong>
        <small>Just now</small>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body">
        Hello, Welcome to our website.
    </div>
</div>

@endsection
