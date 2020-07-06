@extends('wayshop.layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

        </div>
    </div>
</div>
<div class="shop-box-inner">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Xác nhận địa chỉ email của bạn') }}</div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        {{ __('Trước khi tiếp tục, vui lòng kiểm tra email của bạn để biết liên kết xác minh.') }}
                        {{ __('Nếu bạn không nhận được email') }}, <a href="{{ route('verification.resend') }}" style="color:red;">{{ __('nhấn vào đây để yêu cầu gửi lại') }}</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
