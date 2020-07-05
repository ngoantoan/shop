<!-- Start Main Top -->
<div class="main-top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="text-slid-box">
                    <div id="offer-box" class="carouselTicker">
                        <ul class="offer-box">
                            <li>
                                <i class="fab fa-opencart"></i> Off 10%! Shop Now Man
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> 50% - 80% off on Fashion
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> 20% off Entire Purchase Promo code: offT20
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> Off 50%! Shop Now
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> Off 10%! Shop Now Man
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> 50% - 80% off on Fashion
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> 20% off Entire Purchase Promo code: offT20
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> Off 50%! Shop Now
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="our-link">
                    <ul>
                        @if (empty(Auth::check()))
                            <li><a href="{{url('/login-register')}}"><i class="fa fa-user"></i> Đăng nhập</a></li>
                        @else
                            <li><a href="{{url('/account')}}"><i class="fa fa-user"></i> {{Auth::user()->name}}</a></li>
                            <li><a href="{{url('/user-logout')}}"><i class="fa fa-lock"></i> Đăng xuất</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Main Top -->

<!-- Start Main Top -->
<header class="main-header">
    <!-- Start Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
        <div class="container">
            <!-- Start Header Navigation -->
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
                <a class="navbar-brand" href="{{url('/')}}"><img src="{{asset('public/front_assets/images/logo.png')}}" class="logo" alt=""></a>
            </div>
            <!-- End Header Navigation -->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                    <li class="nav-item active"><a class="nav-link" href="{{url('/')}}">Trang chủ</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{url('#')}}">Giới thiệu</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{url('/contact-us')}}">Liên hệ</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->

            <!-- Start Atribute Navigation -->
            <div class="attr-nav">
                <ul>
                    <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
                    <li class="side-menu">
                        <a href="javascript:void(0)">
                            <i class="fa fa-shopping-bag"></i>
                            <span class="badge">
                                @if (Session::get('countCart'))
                                    {{Session::get('countCart')}}
                                @endif
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- End Atribute Navigation -->
        </div>
        <!-- Start Side Menu -->
        <div class="side">
            <a href="#" class="close-side"><i class="fa fa-times"></i></a>
            <li class="cart-box">
                <ul class="cart-list">
                    <?php
                        $total = 0;
                        if (Session::get('userCart')) {
                            $carts = Session::get('userCart');
                            foreach ($carts as $cart) {
                                $total += ($cart->price * $cart->quantity);
                                ?>
                                    <li>
                                        <a href="#" class="photo"><img src="{{$cart->image}}" class="cart-thumb" alt="Image" /></a>
                                        <h6><a href="{{url('/products/'. $cart->product_id)}}">{{$cart->product_name}} </a></h6>
                                        <p>{{$cart->quantity}} - <span class="price">{{number_format($cart->price)}} đ</span></p>
                                    </li>
                                <?php
                            }
                        }
                    ?>

                    <li class="total">
                        <a href="{{url('/cart')}}" class="btn btn-default hvr-hover btn-cart">Giỏ hàng</a>
                        <span class="float-right"><strong>Tổng</strong>: <small id="totalHeader">{{number_format($total)}}</small> đ</span>
                    </li>
                </ul>
            </li>
        </div>
        <!-- End Side Menu -->
    </nav>
    <!-- End Navigation -->
</header>
<!-- End Main Top -->

<!-- Start Top Search -->
<div class="top-search">
    <div class="container">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-search"></i></span>
            <input type="text" class="form-control" placeholder="Search">
            <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
        </div>
    </div>
</div>
<!-- End Top Search -->
