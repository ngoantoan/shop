@extends('admin.layouts.master')
@section('title', 'Thêm Banner')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
           <i class="fa fa-product-hunt"></i>
        </div>
        <div class="header-title">
           <h1>Thêm Banner</h1>
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
                        <a class="btn btn-add " href="{{url('/admin/banners')}}">
                        <i class="fa fa-eye"></i>  Danh sách banner </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form class="col-sm-8" action="{{url('/admin/add-banner')}}" method="POST"  enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Tên</label>
                                <input type="text" class="form-control" placeholder="Nhập tên" name="banner_name" id="banner_name" required>
                            </div>
                            <div class="form-group">
                                <label>Text Style</label>
                                <input type="text" class="form-control" placeholder="Text Style" name="text_style" id="text_style" required>
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea name="banner_content" id="banner_content" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Link</label>
                                <input type="text" class="form-control" placeholder="Link" name="banner_link" id="banner_link" required>
                            </div>
                            <div class="form-group">
                                <label>Sắp xếp</label>
                                <input type="text" class="form-control" placeholder="Sắp xếp" name="sort_order" id="sort_order" required>
                            </div>
                            <div class="form-group">
                                <label>Ảnh Banner</label>
                                <div class="input-group">
                                    <input type="text" id="banner_image" name="banner_image" class="form-control" placeholder="Chọn ảnh" aria-describedby="basic-addon2">
                                    <span class="btn input-group-addon" id="buttonAddImage">Chọn hình</span>
                                </div>
                            </div>
                            <div class="reset-button">
                                <input type="submit" class="btn btn-success" value="Thêm banner">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        CKEDITOR.replace( 'banner_content' );
        var buttonAddImage = document.getElementById( 'buttonAddImage' );
        buttonAddImage.onclick = function() {
            selectFileWithCKFinder( 'banner_image' );
        };
    </script>
</div>
@endsection
