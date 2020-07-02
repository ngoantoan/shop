@extends('admin.layouts.master')
@section('title', 'Danh sách Banner')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
       <div class="header-icon">
          <i class="fa fa-eye"></i>
       </div>
       <div class="header-title">
          <h1>Danh sách Banner</h1>
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
                            <h4>Danh sách Banner</h4>
                        </a>
                    </div>
                </div>
                <div class="panel-body">
                <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                    <div class="btn-group">
                        <div class="buttonexport" id="buttonlist">
                            <a class="btn btn-add" href="{{url('/admin/add-banner')}}"> <i class="fa fa-plus"></i> Thêm Banner
                            </a>
                        </div>

                    </div>
                    <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                    <div class="table-responsive">
                        <table id="table_id" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="info">
                                    <th>ID</th>
                                    <th>Tên</th>
                                    <th>Sắp xếp</th>
                                    <th>Ảnh</th>
                                    <th>Trang thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($banners as $banner)
                                    <tr>
                                        <td>{{$banner->id}}</td>
                                        <td>{!!$banner->name!!}</td>
                                        <td>{{$banner->sort_order}}</td>
                                        <td>
                                            @if (!empty($banner->image))
                                                <img src="{{$banner->image}}" alt="{{$banner->name}}" style="width: 150px;">
                                            @endif
                                        </td>
                                        <td>
                                            <input type="checkbox" class="BannerStatus btn btn-success" rel="{{$banner->id}}" data-toggle="toggle" data-on="Enabled"
                                                data-of="Disabled" data-onstyle="success" data-ofstyle="danger" @if($banner->status == "1") checked @endif>
                                            <div id="myElen" style="display:none;" class="alert alert-success">Status Enabled</div>
                                        </td>
                                        <td>
                                            <a href="{{url('/admin/edit-banner/' . $banner->id )}}" type="button" title="Sửa banner" class="btn btn-add btn-sm"><i class="fa fa-pencil"></i></a>
                                            <a href="{{url('/admin/delete-banner/' . $banner->id )}}" type="button" onclick="return(confirm('Bạn có chắt muốn xóa banner này?'))" title="Xóa banner" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> </a>
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
