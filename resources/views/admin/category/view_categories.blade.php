@extends('admin.layouts.master')
@section('title', 'Danh sách danh mục')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
       <div class="header-icon">
          <i class="fa fa-eye"></i>
       </div>
       <div class="header-title">
          <h1>Danh sách danh mục sản phẩm</h1>
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
    <div id="message_success_delete_category" style="display:none;" class="alert alert-sm alert-success">Xóa danh mục sản phẩm thành công</div>
    <div id="message_error_delete_category" style="display:none;" class="alert alert-sm alert-danger">Vui lòng xóa sản phẩm hoặc danh mục con trong danh mục này trước</div>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                <div class="panel-heading">
                    <div class="btn-group" id="buttonexport">
                        <a href="#">
                            <h4>Danh sách danh mục sản phẩm</h4>
                        </a>
                    </div>
                </div>
                <div class="panel-body">
                <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                    <div class="btn-group">
                        <div class="buttonexport" id="buttonlist">
                            <a class="btn btn-add" href="{{url('/admin/add-category')}}"> <i class="fa fa-plus"></i> Thêm danh mục
                            </a>
                        </div>

                    </div>
                    <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                    <div class="table-responsive">
                        <table id="table_id" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="info">
                                    <th>ID</th>
                                    <th>Tên danh mục</th>
                                    <th>ID danh mục cha</th>
                                    <th>Url</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{$category->id}}</td>
                                        <td>{{$category->name}}</td>
                                        <td>{{$category->parent_id}}</td>
                                        <td>{{$category->url}}</td>
                                        <td>
                                            <input type="checkbox" class="CategoryStatus btn btn-success" rel="{{$category->id}}" data-toggle="toggle" data-on="Enabled"
                                                data-of="Disabled" data-onstyle="success" data-ofstyle="danger" @if($category->status == "1") checked @endif>
                                            <div id="myElen" style="display:none;" class="alert alert-success">Status Enabled</div>
                                        </td>
                                        <td>
                                            <a href="{{url('/admin/edit-category/' . $category->id )}}" title="Sửa danh mục" type="button" class="btn btn-add btn-sm"><i class="fa fa-pencil"></i></a>
                                            <a href="#" onclick="deleteCategory({{$category->id}})" title="Xóa danh mục" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> </a>
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
