@extends('wayshop.layouts.master')
@section('title', $productDetails->name)
@section('trang-chu','active')
@section('content')
<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>{{$productDetails->name}}</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active">{{$productDetails->name}} </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->

<!-- Start Shop Detail  -->
<div class="shop-detail-box-main">
    @if (Session::has('flash_message_error'))
        <div class="alert alert-sm alert-danger alert-block" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>{!! session('flash_message_error') !!}</strong>
        </div>
    @endif

    @if (Session::has('flash_message_success'))
        <div class="alert alert-sm alert-success alert-block" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>{!! session('flash_message_success') !!}</strong>
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-5 col-md-6">
                <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        @foreach ($productsAltImages as $key => $images)
                            <div class="carousel-item {{$key==0 ? 'active' : ''}}"> <img class="d-block w-100" src="{{$images->image}}" alt="First slide"> </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carousel-example-1" role="button" data-slide="prev">
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                    <span class="sr-only">Previous</span>
                </a>
                    <a class="carousel-control-next" href="#carousel-example-1" role="button" data-slide="next">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                    <span class="sr-only">Next</span>
                </a>
                    <ol class="carousel-indicators">
                        @foreach ($productsAltImages as $key => $images)
                            <li data-target="#carousel-example-1" data-slide-to="0" class="{{$key==0 ? 'active' : ''}}">
                                <img class="d-block w-100 img-fluid" src="{{$images->image}}" alt="Image" />
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>
            <div class="col-xl-7 col-lg-7 col-md-6">
                {{-- <form action="{{url('/add-cart')}}" method="post" name="addCart">
                    @csrf --}}
                    <div class="single-product-details">
                        <input type="hidden" id="product_id" name="product_id" value="{{$productDetails->id}}">
                        <input type="hidden" id="product_name" name="product_name" value="{{$productDetails->name}}">
                        <input type="hidden" id="product_color" name="product_color" value="{{$productDetails->color}}">
                        <input type="hidden" id="product_code" name="product_code" value="{{$productDetails->code}}">
                        <input type="hidden" id="product_price" name="product_price" value="{{$productDetails->price}}">
                        <h2>{{$productDetails->name}}</h2>
                        <h5 id="getPrice">Giá : {{number_format($productDetails->price)}} đ</h5>
                        <h5 style="color: #000;">SKU: {{$productDetails->code}}</h5>
                        <h5 style="color: #000;">Màu: {{$productDetails->color}}</h5>
                        <h4>Mô tả:</h4>
                        <p>{!! $productDetails->description !!}</p>
                        <ul>
                            <li>
                                <div class="form-group size-st">
                                    <label class="size-label">Size <small class="errorSize" style="color: red;"></small></label>
                                    <select id="selSize" name="size" class="selectpicker show-tick form-control">
                                        <option value="0">Size</option>
                                        @foreach ($productDetails['attributes'] as $sizes)
                                            <option value="{{$productDetails->id}}-{{$sizes->size}}">{{$sizes->size}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </li>
                            <li>
                                <div class="form-group quantity-box">
                                    <label class="control-label">Số lượng <small class="errorQuantity" style="color: red;"></small></label>
                                    <input class="form-control" id="quantity" name="quantity" value="1" min="1" max="20" type="number">
                                </div>
                            </li>
                        </ul>

                        <div class="price-box-bar">
                            <div class="cart-and-bay-btn float-right">
                                <button class="btn hvr-hover" data-fancybox-close="" onclick="return submitAddtocart();" type="submit" style="color:white;">Thêm vào giỏ hàng</button>
                            </div>
                        </div>
                    </div>
                {{-- </form> --}}
            </div>
        </div>

        <div class="row my-5">
            <div class="col-lg-12">
                <div class="title-all text-center">
                    <h1>Sản phẩm nổi bật</h1>
                </div>
                <div class="featured-products-box owl-carousel owl-theme">
                    @foreach ($featuredProducts as $featuredProduct)
                        <div class="item">
                            <div class="products-single fix">
                                <div class="box-img-hover">
                                    <img src="{{$featuredProduct->image}}" class="img-fluid" alt="Image">
                                    <div class="mask-icon">
                                        <ul>
                                            <li><a href="{{url('/products/'. $featuredProduct->id)}}" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                        </ul>
                                        <a class="cart" href="{{url('/products/'. $featuredProduct->id)}}">Chi tiết</a>
                                    </div>
                                </div>
                                <div class="why-text">
                                    <h4>{{$featuredProduct->name}}</h4>
                                    <h5> {{number_format($featuredProduct->price)}} đ</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
<!-- End Cart -->
@endsection
