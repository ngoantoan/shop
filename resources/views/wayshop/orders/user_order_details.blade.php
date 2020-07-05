@extends('wayshop.layouts.master')
@section('title', 'Chi tiết đơn hàng')
@section('trang-chu','active')
@section('content')
    <div class="cart-box-main">
        <div class="container">
            <h1 align="center">Chi tiết đơn hàng</h1><br><br>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-bordered" style="width:100%;">
                        <thead>
                            <tr>
                                <th>Mã sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Size</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Trạng thái đơn hàng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderDetails->orders as $pro)
                                <tr>
                                    <td>{{$pro->product_code}}</td>
                                    <td>{{$pro->product_name}}</td>
                                    <td>{{$pro->product_size}}</td>
                                    <td>{{number_format($pro->product_price)}} đ</td>
                                    <td>{{$pro->product_qty}}</td>
                                    <td>{{$orderDetails->order_status}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
