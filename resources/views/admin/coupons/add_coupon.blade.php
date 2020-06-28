@extends('admin.layouts.master')
@section('title', 'Thêm mã khuyến mãi')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
           <i class="fa fa-product-hunt"></i>
        </div>
        <div class="header-title">
           <h1>Thêm mã khuyến mãi</h1>
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
        <!-- Main content -->
        <section class="content">
            <div class="row">
            <!-- Form controls -->
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group" id="buttonlist">
                        <a class="btn btn-add " href="{{url('/admin/view-coupons')}}">
                        <i class="fa fa-eye"></i>  Danh sách mã khuyến mãi </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form class="col-sm-6" action="{{url('/admin/add-coupon')}}" method="POST" enctype="multipart/form-data" name="add_coupon" id="add_coupon">
                            @csrf<div class="form-group">
                                <label>Mã khuyến mãi</label>
                                <input type="text" class="form-control" placeholder="Nhập mã khuyến mãi" name="coupon_code" id="coupon_code" required>
                            </div>
                            <div class="form-group">
                                <label>Số tiền</label>
                                <input type="text" class="form-control" placeholder="Nhập số tiền" name="coupon_amount" id="coupon_amount" required>
                            </div>
                            <div class="form-group">
                                <label>Loại khuyến mãi</label>
                                <select name="amount_type" id="amount_type" class="form-control">
                                    <option value="Percentage">Percentage</option>
                                    <option value="Fixed">Fixed</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Ngày hết hạn</label>
                                <input type="text" class="form-control" name="expiry_date" id="datepicker" required>
                            </div>
                            <div class="reset-button">
                                <input type="submit" class="btn btn-success" value="Thêm">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection
