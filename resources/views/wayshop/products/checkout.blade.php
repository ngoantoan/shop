@extends('wayshop.layouts.master')
@section('content')
    <div class="contact-box-main">
        <div class="container">
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
            <form action="{{url('/checkout')}}" id="contactForm registerForm" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="contact-form-right">
                            <h2>Bill To</h2>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Billing Name" id="billing_name" name="billing_name" @if (!empty($userDetails->name)) value="{{$userDetails->name}}" @endif required data-error="Please Enter Billing Name">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Billing Address" id="billing_address" name="billing_address" @if (!empty($userDetails->address)) value="{{$userDetails->address}}" @endif required data-error="Please Enter Billing Address">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Billing City" id="billing_city" name="billing_city" @if (!empty($userDetails->city)) value="{{$userDetails->city}}" @endif required data-error="Please Enter Billing City">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Billing District" id="billing_district" name="billing_district" @if (!empty($userDetails->district)) value="{{$userDetails->district}}" @endif required data-error="Please Enter Billing District">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <select name="billing_country" id="billing_country" class="form-control">
                                            <option value="">Select Country</option>
                                            @foreach ($countries as $country)
                                                <option value="{{$country->country_name}}" @if (!empty($userDetails->country) && $country->country_name == $userDetails->country) selected @endif>{{$country->country_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Billing Pincode" id="billing_pincode" name="billing_pincode" @if (!empty($userDetails->pincode)) value="{{$userDetails->pincode}}" @endif required data-error="Please Enter Billing Pincode">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Billing Mobile" id="billing_mobile" name="billing_mobile" @if (!empty($userDetails->mobile)) value="{{$userDetails->mobile}}" @endif required data-error="Please Enter Billing Mobile">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group" style="margin-left: 30px;">
                                        <input type="checkbox" class="form-check-input" id="billtoship">
                                        <label class="form-check-label" for="billtoship">Shipping Address Same As Billing Address</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12">
                        <div class="contact-form-right">
                            <h2>Ship To</h2>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Shipping Name" id="shipping_name" name="shipping_name" @if (!empty($shippingDetails->name)) value="{{$shippingDetails->name}}" @endif data-error="Please Enter Shipping Name">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Shipping Address" id="shipping_address" name="shipping_address" @if (!empty($shippingDetails->address)) value="{{$shippingDetails->address}}" @endif data-error="Please Enter Shipping Address">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Shipping City" id="shipping_city" name="shipping_city" @if (!empty($shippingDetails->city)) value="{{$shippingDetails->city}}" @endif data-error="Please Enter Shipping City">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Shipping District" id="shipping_district" name="shipping_district" @if (!empty($shippingDetails->district)) value="{{$shippingDetails->district}}" @endif data-error="Please Enter Shipping District">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <select name="shipping_country" id="shipping_country" class="form-control">
                                            <option value="">Select Country</option>
                                            @foreach ($countries as $country)
                                                <option value="{{$country->country_name}}" @if (!empty($shippingDetails->country) && $country->country_name == $shippingDetails->country) selected @endif>{{$country->country_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Shipping Pincode" id="shipping_pincode" name="shipping_pincode" @if (!empty($shippingDetails->pincode)) value="{{$shippingDetails->pincode}}" @endif data-error="Please Enter Shipping Pincode">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Shipping Mobile" id="shipping_mobile" name="shipping_mobile" @if (!empty($shippingDetails->mobile)) value="{{$shippingDetails->mobile}}" @endif data-error="Please Enter Shipping Mobile">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="submit-button text-center">
                                        <button class="btn hvr-hover" type="submit">Checkout</button>
                                        <div id="msgSubmit" class="h3 text-center hidden"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
