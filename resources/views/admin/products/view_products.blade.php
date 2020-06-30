@extends('admin.layouts.master')
@section('title', 'Danh sách sản phẩm')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
       <div class="header-icon">
          <i class="fa fa-users"></i>
       </div>
       <div class="header-title">
          <h1>Danh sách sản phẩm</h1>
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
                            <h4>Danh sách sản phẩm</h4>
                        </a>
                    </div>
                </div>
                <div class="panel-body">
                <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                    <div class="btn-group">
                        <div class="buttonexport" id="buttonlist">
                            <a class="btn btn-add" href="{{url('/admin/add-product')}}"> <i class="fa fa-plus"></i> Thêm sản phẩm
                            </a>
                        </div>

                    </div>
                    <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                    <div class="table-responsive">
                        <table id="table_id" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="info">
                                    <th>ID</th>
                                    <th>Tên sản phẩm</th>
                                    <th>ID danh mục</th>
                                    <th>Mã sản phẩm</th>
                                    <th>Màu sản phẩm</th>
                                    <th>Ảnh</th>
                                    <th>Giá</th>
                                    <th>Trạng thái</th>
                                    <th>Sản phẩm nổi bật</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{$product->id}}</td>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->category_id}}</td>
                                        <td>{{$product->code}}</td>
                                        <td>{{$product->color}}</td>
                                        <td>
                                            @if (!empty($product->image))
                                                <img src="{{asset('public//uploads/products/'.$product->image)}}" alt="" style="width: 50px;">
                                            @endif
                                        </td>
                                        <td>{{$product->price}}</td>
                                        <td>
                                            <input type="checkbox" class="ProductStatus btn btn-success" rel="{{$product->id}}" data-toggle="toggle" data-on="Enabled"
                                                data-of="Disabled" data-onstyle="success" data-ofstyle="danger" @if($product->status == "1") checked @endif>
                                            <div id="myElen" style="display:none;" class="alert alert-success">Status Enabled</div>
                                        </td>
                                        <td>
                                            <input type="checkbox" class="FeaturedStatus btn btn-success" rel="{{$product->id}}" data-toggle="toggle" data-on="Enabled"
                                                data-of="Disabled" data-onstyle="success" data-ofstyle="danger" @if($product->featured_products == "1") checked @endif>
                                        </td>
                                        <td>
                                            <a href="{{url('/admin/add-images/' . $product->id )}}" type="button" class="btn btn-info btn-sm" title="Add Image"><i class="fa fa-image"></i></a>
                                            <a href="{{url('/admin/add-attributes/' . $product->id )}}" type="button" class="btn btn-warning btn-sm" title="Add Attributes"><i class="fa fa-list"></i></a>
                                            <a href="{{url('/admin/edit-product/' . $product->id )}}" type="button" class="btn btn-add btn-sm" title="Edit Product"><i class="fa fa-pencil"></i></a>
                                            <a href="{{url('/admin/delete-product/' . $product->id )}}" type="button" class="btn btn-danger btn-sm" title="Delete Product"><i class="fa fa-trash-o"></i> </a>
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
