@extends('wayshop.layouts.master')
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
                            <div class="carousel-item {{$key==0 ? 'active' : ''}}"> <img class="d-block w-100" src="{{asset('uploads/products/'. $images->image)}}" alt="First slide"> </div>
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
                                <img class="d-block w-100 img-fluid" src="{{asset('uploads/products/'. $images->image)}}" alt="" />
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>
            <div class="col-xl-7 col-lg-7 col-md-6">
                <form action="{{url('/add-cart')}}" method="post" name="addCart">
                    @csrf
                    <div class="single-product-details">
                        <input type="hidden" name="product_id" value="{{$productDetails->id}}">
                        <input type="hidden" name="product_name" value="{{$productDetails->name}}">
                        <input type="hidden" name="product_color" value="{{$productDetails->color}}">
                        <input type="hidden" name="product_code" value="{{$productDetails->code}}">
                        <input type="hidden" id="price" name="product_price" value="{{$productDetails->price}}">
                        <h2>Product Name : {{$productDetails->name}}</h2>
                        <h5 id="getPrice">Product Price : {{number_format($productDetails->price)}} đ</h5>

                        <h4>Short Description:</h4>
                        <p>{!! $productDetails->description !!}</p>
                        <ul>
                            <li>
                                <div class="form-group size-st">
                                    <label class="size-label">Size</label>
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
                                    <label class="control-label">Quantity</label>
                                    <input class="form-control" name="quantity" value="0" min="0" max="20" type="number">
                                </div>
                            </li>
                        </ul>

                        <div class="price-box-bar">
                            <div class="cart-and-bay-btn float-right">
                                <button class="btn hvr-hover" data-fancybox-close="" type="submit" style="color:white;">Add to cart</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row my-5">
            <div class="col-lg-12">
                <div class="title-all text-center">
                    <h1>Featured Products</h1>
                </div>
                <div class="featured-products-box owl-carousel owl-theme">
                    @foreach ($featuredProducts as $featuredProduct)
                        <div class="item">
                            <div class="products-single fix">
                                <div class="box-img-hover">
                                    <img src="{{asset('uploads/products/'.$featuredProduct->image)}}" class="img-fluid" alt="Image">
                                    <div class="mask-icon">
                                        <ul>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                        </ul>
                                        <a class="cart" href="#">Add to Cart</a>
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
