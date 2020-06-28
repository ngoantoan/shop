@extends('admin.layouts.master')
@section('title', 'Danh sách đơn hàng')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
       <div class="header-icon">
          <i class="fa fa-eye"></i>
       </div>
       <div class="header-title">
          <h1>Danh sách đơn hàng</h1>
       </div>
    </section>

    <div id="message_success" style="display:none;" class="alert alert-sm alert-success">Status Enabled</div>
    <div id="message_error" style="display:none;" class="alert alert-sm alert-danger">Status Disabled</div>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                <div class="panel-heading">
                    <div class="btn-group" id="buttonexport">
                        <a href="#">
                            <h4>Danh sách đơn hàng</h4>
                        </a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="table_id" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="info">
                                    <th>ID</th>
                                    <th>Ngày đặt</th>
                                    <th>Tên khách hàng</th>
                                    <th>Mail</th>
                                    <th>Sản phẩm</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Phương thức thanh toán</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{$order->id}}</td>
                                        <td>{{$order->created_at->format('d/m/Y')}}</td>
                                        <td>{{$order->name}}</td>
                                        <td>{{$order->user_email}}</td>
                                        <td>
                                            @foreach ($order->orders as $pro)
                                                {{$pro->product_code}}
                                                {{$pro->product_qty}}<br>
                                            @endforeach
                                        </td>
                                        <td>{{$order->grand_total}}</td>
                                        <td>{{$order->order_status}}</td>
                                        <td>{{$order->payment_method}}</td>
                                        <td>
                                            <a target="_blank" href="{{url('/admin/order/' . $order->id )}}" type="button" class="btn btn-primary btn-sm">Chi tiết</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection
