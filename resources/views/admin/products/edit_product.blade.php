@extends('admin.layouts.master')
@section('title', 'Sửa sản phẩm')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
           <i class="fa fa-product-hunt"></i>
        </div>
        <div class="header-title">
           <h1>Sửa sản phẩm</h1>
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
                        <form class="col-sm-6" action="{{url('/admin/edit-product/'. $productDetails->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Danh mục</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <?php echo $categories_dropdown; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input type="text" class="form-control" placeholder="Nhập tên sản phẩm" name="product_name" id="product_name" value="{{$productDetails->name}}" required>
                            </div>
                            <div class="form-group">
                                <label>Mã sản phẩm</label>
                                <input type="text" class="form-control" placeholder="Nhập mã sản phẩm" name="product_code" id="product_code" value="{{$productDetails->code}}" required>
                            </div>
                            <div class="form-group">
                                <label>Màu sản phẩm</label>
                                <input type="text" class="form-control" placeholder="Nhập màu sản phẩm" name="product_color" id="product_color" value="{{$productDetails->color}}" required>
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea name="product_description" id="product_description" class="form-control">{{$productDetails->description}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Giá</label>
                                <input type="text" class="form-control" placeholder="Nhập giá" name="product_price" id="product_price" value="{{$productDetails->price}}" required>
                            </div>
                            <div class="form-group">
                                <label>Ảnh</label>
                                <input type="file" name="image">
                                <input type="hidden" name="current_image" value="{{$productDetails->image}}">
                                @if (!empty($productDetails->image))
                                    <img src="{{asset('/uploads/products/'. $productDetails->image)}}" alt="" style="width: 100px;margin-top: 10px;">
                                @endif
                            </div>
                            <div class="reset-button">
                                <input type="submit" class="btn btn-success" value="Sửa sản phẩm">
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
