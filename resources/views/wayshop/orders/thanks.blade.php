@extends('wayshop.layouts.master')
@section('title', 'Thanh toán thành công')
@section('trang-chu','active')
@section('content')
    <div class="cart-box-main">
        <div class="container">
            <h1 align="center">Cảm ơn bạn đã mua hàng của chúng tôi!</h1><br><br>
            <div class="row">
                <div class="col-md-12">
                    <div align="center">
                        <h2>MÃ ĐƠN HÀNG CỦA BẠN ĐÃ ĐƯỢC TẠO</h2>
                        <P>Mã đơn hàng của bạn là {{Session::get('order_id')}} và tổng tiền là {{Session::get('grand_total')}} đ</P>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<?php
    Session::forget('order_id');
    Session::forget('grand_total');
?>
