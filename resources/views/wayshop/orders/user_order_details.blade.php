@extends('wayshop.layouts.master')
@section('content')
    <div class="cart-box-main">
        <div class="container">
            <h1 align="center">User Orders</h1><br><br>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-bordered" style="width:100%;">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Ordered Products</th>
                                <th>Payment Method</th>
                                <th>Grand Total</th>
                                <th>Created On</th>
                                <th>Order Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderDetails->orders as $pro)
                                <tr>
                                    <td>{{$pro->product_code}}</td>
                                    <td>{{$pro->product_name}}</td>
                                    <td>{{$pro->product_size}}</td>
                                    <td>{{$pro->product_price}} vnđ</td>
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
