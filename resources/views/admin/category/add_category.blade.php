@extends('admin.layouts.master')
@section('title', 'Thêm danh mục sản phẩm')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
           <i class="fa fa-product-hunt"></i>
        </div>
        <div class="header-title">
           <h1>Thêm danh mục sản phẩm</h1>
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
                        <a class="btn btn-add " href="{{url('/admin/view-categories')}}">
                        <i class="fa fa-eye"></i>  Danh sách danh mục sản phẩm </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form class="col-sm-6" action="{{url('/admin/add-category')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Tên danh mục</label>
                                <input type="text" class="form-control" placeholder="Nhập tên danh mục" name="category_name" id="category_name" required>
                            </div>
                            <div class="form-group">
                                <label>Danh mục cha</label>
                                <select name="parent_id" id="parent_id" class="form-control">
                                    <option value="0">Danh mục cha</option>
                                    @foreach ($levels as $level)
                                        <option value="{{$level->id}}">{{$level->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Url</label>
                                <input type="text" class="form-control" placeholder="Url" name="category_url" id="category_url" required>
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea name="category_description" id="category_description" class="form-control"></textarea>
                            </div>
                            <div class="reset-button">
                                <input type="submit" class="btn btn-success" value="Thêm danh mục">
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
