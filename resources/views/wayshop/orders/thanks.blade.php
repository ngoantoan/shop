@extends('wayshop.layouts.master')
@section('content')
    <div class="cart-box-main">
        <div class="container">
            <h1 align="center">Thanks For Purchasing Us!</h1><br><br>
            <div class="row">
                <div class="col-md-12">
                    <div align="center">
                        <h2>YOUR COD ORDER HAS BEEN PLACED</h2>
                        <P>Your Order Number is {{Session::get('order_id')}} and total payable about is {{Session::get('grand_total')}} đ</P>
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
