@extends('admin.layouts.master')
@section('title', 'Thêm sản phẩm')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
           <i class="fa fa-product-hunt"></i>
        </div>
        <div class="header-title">
           <h1>Thêm sản phẩm</h1>
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
                        <form class="col-sm-8" action="{{url('/admin/add-product')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Dạnh mục</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <?php echo $categories_dropdown; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tên</label>
                                <input type="text" class="form-control" placeholder="Nhập tên sản phẩm" name="product_name" id="product_name" required>
                            </div>
                            <div class="form-group">
                                <label>Mã</label>
                                <input type="text" class="form-control" placeholder="Nhập mã sản phẩm" name="product_code" id="product_code" required>
                            </div>
                            <div class="form-group">
                                <label>Màu</label>
                                <input type="text" class="form-control" placeholder="Nhập màu sản phẩm" name="product_color" id="product_color" required>
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea name="product_description" id="product_description" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Giá</label>
                                <input type="text" class="form-control" placeholder="Enter Product Price" name="product_price" id="product_price" required>
                            </div>
                            <div class="form-group">
                                <label>Ảnh</label>
                                <div class="input-group">
                                    <input type="text" id="product_image" name="product_image" class="form-control" placeholder="Chọn ảnh" aria-describedby="basic-addon2">
                                    <span class="btn input-group-addon" id="buttonAddImage">Chọn hình</span>
                                </div>
                            </div>
                            <div class="reset-button">
                                <input type="submit" class="btn btn-success" value="Thêm sản phẩm">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        CKEDITOR.replace( 'product_description' );
        var buttonAddImage = document.getElementById( 'buttonAddImage' );
        buttonAddImage.onclick = function() {
            selectFileWithCKFinder( 'product_image' );
        };
    </script>
</div>
@endsection
