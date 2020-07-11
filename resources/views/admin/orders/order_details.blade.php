@extends('admin.layouts.master')
@section('title', 'Chi tiết đơn hàng')
@section('content')
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
       <div class="header-icon">
          <i class="fa fa-eye"></i>
       </div>
       <div class="header-title">
          <h1>Chi tiết đơn hàng</h1>
          <small>ID: {{$orderDetails->id}}</small>
       </div>
    </section>
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

    <div id="message_success" style="display:none;" class="alert alert-sm alert-success">Status Enabled</div>
    <div id="message_error" style="display:none;" class="alert alert-sm alert-danger">Status Disabled</div>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group" id="buttonexport">
                            <a href="#">
                                <h4>Chi tiết đơn hàng</h4>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                    <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                        <div class="table-responsive">
                            <table id="table_id" class="table table-bordered table-striped table-hover">
                                <tbody>
                                    <tr>
                                        <td class="taskDesc">Ngày đặt hàng</td>
                                        <td class="taskStatus"> {{$orderDetails->created_at->format('d/m/Y')}}</td>
                                    </tr>
                                    <tr>
                                        <td class="taskDesc">Trạng thái</td>
                                        <td class="taskStatus"> {{$orderDetails->order_status}}</td>
                                    </tr>
                                    <tr>
                                        <td class="taskDesc">Tổng tiền</td>
                                        <td class="taskStatus"> {{$orderDetails->grand_total}} đ</td>
                                    </tr>
                                    <tr>
                                        <td class="taskDesc">Phí giao hàng</td>
                                        <td class="taskStatus"> {{$orderDetails->shipping_charges}}</td>
                                    </tr>
                                    <tr>
                                        <td class="taskDesc">Mã khuyến mãi</td>
                                        <td class="taskStatus"> {{$orderDetails->coupon_code}}</td>
                                    </tr>
                                    <tr>
                                        <td class="taskDesc">Số tiền giảm giá</td>
                                        <td class="taskStatus"> {{$orderDetails->coupon_amount}}</td>
                                    </tr>
                                    <tr>
                                        <td class="taskDesc">Phương thức thanh toán</td>
                                        <td class="taskStatus"> {{$orderDetails->payment_method}}</td>
                                    </tr>
                                    <tr>
                                        <td class="taskDesc">Trạng thái thanh toán</td>
                                        <td class="taskStatus">
                                            @if ($orderDetails->payment_status == 0)
                                                <span class="label label-danger">Thanh toán thất bại</span>
                                            @else
                                                <span class="label label-success">Thanh toán thành công</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @if ($orderDetails->payment_status == 1)
                                        <tr>
                                            <td class="taskDesc">Mã thanh toán</td>
                                            <td class="taskStatus">{{$orderDetails->transaction_id}}</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group" id="buttonexport">
                            <a href="#">
                                <h4>Địa chỉ thanh toán</h4>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                    <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                        <div class="table-responsive">
                            <table id="table_id" class="table table-bordered table-striped table-hover">
                                <tbody>
                                    <tr>
                                        <td class="taskDesc">Tên</td>
                                        <td class="taskStatus"> {{$orderDetails->name}}</td>
                                    </tr>
                                    <tr>
                                        <td class="taskDesc">Địa chỉ</td>
                                        <td class="taskStatus"> {{$orderDetails->address}}</td>
                                    </tr>
                                    <tr>
                                        <td class="taskDesc">Thành phố</td>
                                        <td class="taskStatus"> {{$orderDetails->city}} đ</td>
                                    </tr>
                                    <tr>
                                        <td class="taskDesc">Quận/Huyện</td>
                                        <td class="taskStatus"> {{$orderDetails->district}}</td>
                                    </tr>
                                    <tr>
                                        <td class="taskDesc">Quốc gia</td>
                                        <td class="taskStatus"> {{$orderDetails->country}}</td>
                                    </tr>
                                    <tr>
                                        <td class="taskDesc">Mã quốc gia</td>
                                        <td class="taskStatus"> {{$orderDetails->pincode}}</td>
                                    </tr>
                                    <tr>
                                        <td class="taskDesc">Số điện thoại</td>
                                        <td class="taskStatus"> {{$orderDetails->mobile}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group" id="buttonexport">
                            <a href="#">
                                <h4>Thông tin người dùng</h4>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                    <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                        <div class="table-responsive">
                            <table id="table_id" class="table table-bordered table-striped table-hover">
                                <tbody>
                                    <tr>
                                        <td class="taskDesc">Họ tên</td>
                                        <td class="taskStatus"> {{$orderDetails->name}}</td>
                                    </tr>
                                    <tr>
                                        <td class="taskDesc">Email</td>
                                        <td class="taskStatus"> {{$orderDetails->user_email}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group" id="buttonexport">
                            <a href="#">
                                <h4>Cập nhật trạng thái đơn hàng</h4>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="{{url('/admin/update-order-status')}}" method="post">
                            @csrf
                            <input type="hidden" name="order_id" value="{{$orderDetails->id}}">
                            <table style="width: 100%;">
                                <tr>
                                    <td>
                                        <select name="order_status" id="order_status" class="form-control">
                                            <option value="Mới" @if ($orderDetails->order_status == "Mới") selected @endif>Mới</option>
                                            <option value="Đang chờ xử lý" @if ($orderDetails->order_status == "Đang chờ xử lý") selected @endif>Đang chờ xử lý</option>
                                            <option value="Đang vận chuyển" @if ($orderDetails->order_status == "Đang vận chuyển") selected @endif>Đang vận chuyển</option>
                                            <option value="Đã giao hàng" @if ($orderDetails->order_status == "Đã giao hàng") selected @endif>Đã giao hàng</option>
                                            <option value="Đã hủy" @if ($orderDetails->order_status == "Đã hủy") selected @endif>Đã hủy</option>
                                            <option value="Đã thanh toán" @if ($orderDetails->order_status == "Đã thanh toán") selected @endif>Đã thanh toán</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="submit" value="Cập nhật trạng thái" class="btn btn-sm btn-success">
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>

                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group" id="buttonexport">
                            <a href="#">
                                <h4>Địa chỉ giao hàng</h4>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="table_id" class="table table-bordered table-striped table-hover">
                                <tbody>
                                    <tr>
                                        <td class="taskDesc">Họ tên</td>
                                        <td class="taskStatus"> {{$orderDetails->name}}</td>
                                    </tr>
                                    <tr>
                                        <td class="taskDesc">Địa chỉ</td>
                                        <td class="taskStatus"> {{$orderDetails->address}}</td>
                                    </tr>
                                    <tr>
                                        <td class="taskDesc">Thành phố</td>
                                        <td class="taskStatus"> {{$orderDetails->city}} đ</td>
                                    </tr>
                                    <tr>
                                        <td class="taskDesc">Quận/huyện</td>
                                        <td class="taskStatus"> {{$orderDetails->district}}</td>
                                    </tr>
                                    <tr>
                                        <td class="taskDesc">Quốc gia</td>
                                        <td class="taskStatus"> {{$orderDetails->country}}</td>
                                    </tr>
                                    <tr>
                                        <td class="taskDesc">Mã quốc gia</td>
                                        <td class="taskStatus"> {{$orderDetails->pincode}}</td>
                                    </tr>
                                    <tr>
                                        <td class="taskDesc">Số điện thoại</td>
                                        <td class="taskStatus"> {{$orderDetails->mobile}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group" id="buttonexport">
                            <a href="#">
                                <h4>Sản phẩm đã đặt</h4>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="table_id" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <th>Mã sản phẩm</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Size</th>
                                    <th>Màu</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                </thead>
                                <tbody>
                                    @foreach ($orderDetails->orders as $pro)
                                        <tr>
                                            <td>{{$pro->product_code}}</td>
                                            <td>{{$pro->product_name}}</td>
                                            <td>{{$pro->product_size}}</td>
                                            <td>{{$pro->product_color}}</td>
                                            <td>{{$pro->product_price}}</td>
                                            <td>{{$pro->product_qty}}</td>
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
