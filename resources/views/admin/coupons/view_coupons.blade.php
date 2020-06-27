@extends('admin.layouts.master')
@section('title', 'View Coupons')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
       <div class="header-icon">
          <i class="fa fa-eye"></i>
       </div>
       <div class="header-title">
          <h1>View Coupons</h1>
          <small>Coupons</small>
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
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                <div class="panel-heading">
                    <div class="btn-group" id="buttonexport">
                        <a href="#">
                            <h4>View Coupons</h4>
                        </a>
                    </div>
                </div>
                <div class="panel-body">
                <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                    <div class="btn-group">
                        <div class="buttonexport" id="buttonlist">
                            <a class="btn btn-add" href="{{url('/admin/add-coupon')}}"> <i class="fa fa-plus"></i> Add Coupon
                            </a>
                        </div>

                    </div>
                    <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                    <div class="table-responsive">
                        <table id="table_id" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="info">
                                    <th>Coupon ID</th>
                                    <th>Coupon Code</th>
                                    <th>Amount</th>
                                    <th>Amount Type</th>
                                    <th>Expity Date</th>
                                    <th>Created Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coupons as $coupon)
                                    <tr>
                                        <td>{{$coupon->id}}</td>
                                        <td>{{$coupon->coupon_code}}</td>
                                        <td>
                                            {{$coupon->amount}}
                                            @if ($coupon->amount_type == "Percentage") % @else vnđ @endif
                                        </td>
                                        <td>{{$coupon->amount_type}}</td>
                                        <td>{{$coupon->expiry_date}}</td>
                                        <td>{{$coupon->created_at}}</td>
                                        <td>
                                            <input type="checkbox" class="CouponStatus btn btn-success" rel="{{$coupon->id}}" data-toggle="toggle" data-on="Enabled"
                                                data-of="Disabled" data-onstyle="success" data-ofstyle="danger" @if($coupon->status == "1") checked @endif>
                                            <div id="myElen" style="display:none;" class="alert alert-success">Status Enabled</div>
                                        </td>
                                        <td>
                                            <a href="{{url('/admin/edit-coupon/' . $coupon->id )}}" type="button" class="btn btn-add btn-sm"><i class="fa fa-pencil"></i></a>
                                            <a href="{{url('/admin/delete-coupon/' . $coupon->id )}}" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> </a>
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
