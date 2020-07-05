@extends('wayshop.layouts.master')
@section('title', 'Thay đổi mật khẩu')
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
                        <h2>Thay đổi mật khẩu</h2>
                        <form action="{{url('/change-password')}}" id="contactForm registerForm" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Mật khẩu củ" id="current_password" name="current_password" required data-error="Please Enter Old Password">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Mật khẩu mới" id="new_pwd" name="new_pwd" required data-error="Please Enter New Password">
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
