@extends('wayshop.layouts.master')
@section('title', 'Thay đổi địa chỉ')
@section('trang-chu','active')
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
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-lg-6 col-sm-12">
                    <div class="contact-form-right">
                        <h2>Thay đổi địa chỉ</h2>
                        <form action="{{url('/change-address')}}" id="contactForm registerForm" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="{{$userDetails->name}}" placeholder="Your Name" id="name" name="name" required data-error="Please Enter Your Name">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="{{$userDetails->address}}" placeholder="Your Address" id="address" name="address" required data-error="Please Enter Your Address">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="{{$userDetails->city}}" placeholder="Your City" id="city" name="city" required data-error="Please Enter Your City">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="{{$userDetails->district}}" placeholder="Your District" id="district" name="district" required data-error="Please Enter Your District">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <select name="country" id="country" class="form-control">
                                            <option value="1">Select Country</option>
                                            @foreach ($countries as $country)
                                                <option value="{{$country->country_name}}" @if ($country->country_name == $userDetails->country) selected @endif>{{$country->country_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="{{$userDetails->pincode}}" placeholder="Your Pincode" id="pincode" name="pincode" required data-error="Please Enter Your Pincode">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="{{$userDetails->mobile}}" placeholder="Your Mobile" id="mobile" name="mobile" required data-error="Please Enter Your Mobile">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="submit-button text-center">
                                        <button class="btn hvr-hover" id="submit" type="submit">Lưu</button>
                                        <div class="h3 text-center hidden" id="msgSubmit"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>
@endsection
