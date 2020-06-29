@extends('wayshop.layouts.master')
@section('content')
    <div class="cart-box-main">
        <div class="container">
            <h1 align="center">Danh sách đơn hàng của bạn</h1><br><br>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-bordered" style="width:100%;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Sản phẩm</th>
                                <th>Phương thức thanh toán</th>
                                <th>Tổng tiền</th>
                                <th>Ngày đặt hàng</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{$order->id}}</td>
                                    <td>
                                        @foreach ($order->orders as $pro)
                                                {{$pro->product_code}}
                                                ({{$pro->product_qty}})<br>
                                        @endforeach
                                    </td>
                                    <td>{{$order->payment_method}}</td>
                                    <td>{{number_format($order->grand_total)}} đ</td>
                                    <td>{{$order->created_at->format('d/m/Y')}}</td>
                                    <td><a href="{{url('/order/'.$order->id)}}">Chi tiết</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
