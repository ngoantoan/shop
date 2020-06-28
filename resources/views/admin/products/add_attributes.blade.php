@extends('admin.layouts.master')
@section('title', 'Thêm thuộc tính sản phẩm')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
           <i class="fa fa-product-hunt"></i>
        </div>
        <div class="header-title">
           <h1>Thêm thuộc tính sản phẩm</h1>
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
                            <form class="col-sm-6" action="{{url('/admin/add-attributes/'. $productDetails->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Tên sản phẩm : </label> {{$productDetails->name}}
                                </div>
                                <div class="form-group">
                                    <label>Mã sản phẩm : </label> {{$productDetails->code}}
                                </div>
                                <div class="form-group">
                                    <label>Màu sản phẩm : </label> {{$productDetails->color}}
                                </div>
                                <div class="form-group">
                                    <div class="field_wrapper">
                                        <div style="display:flex;">
                                            <input type="text" name="sku[]" id="sku" placeholder="SKU" class="form-control" style="width: 120px;margin-right:5px;"/>
                                            <input type="text" name="size[]" id="size" placeholder="Size" class="form-control" style="width: 120px;margin-right:5px;"/>
                                            <input type="text" name="price[]" id="price" placeholder="Price" class="form-control" style="width: 120px;margin-right:5px;"/>
                                            <input type="text" name="stock[]" id="stock" placeholder="Stock" class="form-control" style="width: 120px;margin-right:5px;"/>
                                            <a href="javascript:void(0)" class="add_button" title="Add Field">Add</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="reset-button">
                                    <input type="submit" class="btn btn-success" value="Thêm thuộc tính">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- View Attributes -->
        <section class="content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group" id="buttonexport">
                            <a href="#">
                                <h4>Danh sách thuộc tính</h4>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                    <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                        <div class="table-responsive">
                            <table id="table_id" class="table table-bordered table-striped table-hover">
                                <form action="{{url('/admin/edit-attribute/'. $productDetails->id)}}" method="POST">
                                    @csrf
                                    <thead>
                                        <tr class="info">
                                            <th>ID</th>
                                            <th>SKU</th>
                                            <th>Size</th>
                                            <th>Price</th>
                                            <th>Stock</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($productDetails['attributes'] as $attribute)
                                            <tr>
                                                <td style="display:none;"><input type="hidden" name="attr[]" value="{{$attribute->id}}">{{$attribute->id}}</td>
                                                <td>{{$attribute->product_id}}</td>
                                                <td><input type="text" name="sku[]" value="{{$attribute->sku}}" style="text-align: center;"></td>
                                                <td><input type="text" name="size[]" value="{{$attribute->size}}" style="text-align: center;"></td>
                                                <td><input type="text" name="price[]" value="{{$attribute->price}}" style="text-align: center;"></td>
                                                <td><input type="text" name="stock[]" value="{{$attribute->stock}}" style="text-align: center;"></td>
                                                <td class="center">
                                                    <div class="btn-group">
                                                        <input type="submit" value="update" class="btn btn-success" style="height:30px;padding-top:4px;">
                                                        <a href="{{url('/admin/delete-attribute/'. $attribute->id)}}" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> </a>
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
        <!-- /.View Attributes -->
        <!-- /.content -->
</div>
@endsection
