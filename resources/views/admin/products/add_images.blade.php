@extends('admin.layouts.master')
@section('title', 'Thêm ảnh cho sản phẩm')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
           <i class="fa fa-product-hunt"></i>
        </div>
        <div class="header-title">
           <h1>Thêm ảnh cho sản phẩm</h1>
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
                            <a class="btn btn-add " href="{{url('/admin/view-products')}}">
                            <i class="fa fa-eye"></i>  Danh sách sản phẩm </a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form class="col-sm-6" action="{{url('/admin/add-images/'. $productDetails->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Tên sản phẩm : </label> {{$productDetails->name}}
                                </div>
                                <div class="form-group">
                                    <label>Mã sản phẩm :</label> {{$productDetails->code}}
                                </div>
                                <div class="form-group">
                                    <label>Màu sản phẩm : </label> {{$productDetails->color}}
                                </div>
                                <div class="form-group">
                                    <label>Ảnh </label>
                                    <div class="input-group">
                                        <input type="text" id="image" name="image" class="form-control" placeholder="Chọn ảnh" aria-describedby="basic-addon2">
                                        <span class="btn input-group-addon" id="buttonAddImage">Chọn hình</span>
                                    </div>
                                </div>
                                <div class="reset-button">
                                    <input type="submit" class="btn btn-success" value="Thêm ảnh">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                            <div class="btn-group" id="buttonexport">
                                    <h4>Danh sách ảnh</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="table_id" class="table table-bordered table-striped table-hover">
                                    <form action="{{url('/admin/edit-images/'. $productDetails->id)}}" method="POST">
                                        @csrf
                                        <thead>
                                            <tr class="info">
                                                <th>ID</th>
                                                <th>ID sản phẩm</th>
                                                <th>Ảnh</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($productImages as $productImage)
                                                <tr>
                                                    <td>{{$productImage->id}}</td>
                                                    <td>{{$productImage->product_id}}</td>
                                                    <td><img src="{{$productImage->image}}" style="width: 80px;"></td>
                                                    <td class="center">
                                                        <div class="btn-group">
                                                            <a href="{{url('/admin/delete-alt-image/'. $productImage->id)}}" title="Xóa ảnh" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </form>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script>
            var buttonAddImage = document.getElementById( 'buttonAddImage' );
            buttonAddImage.onclick = function() {
                selectFileWithCKFinder( 'image' );
            };
        </script>
</div>
@endsection
