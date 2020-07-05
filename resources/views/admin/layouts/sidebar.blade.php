 <!-- =============================================== -->
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar -->
    <div class="sidebar">
        <!-- sidebar menu -->
        <ul class="sidebar-menu">
            <li class="active">
                <a href="{{url('/admin/dashboard')}}"><i class="fa fa-tachometer"></i><span>Dashboard</span>
                <span class="pull-right-container">
                </span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-image"></i><span>Banners</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{url('admin/add-banner')}}">Thêm Banner</a></li>
                    <li><a href="{{url('admin/banners')}}">Danh sách Banner</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-list"></i><span>Danh mục sản phẩm</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{url('admin/add-category')}}">Thêm danh mục</a></li>
                    <li><a href="{{url('admin/view-categories')}}">Danh sách danh mục</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-product-hunt"></i><span>Sản phẩm</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{url('admin/add-product')}}">Thêm sản phẩm</a></li>
                    <li><a href="{{url('admin/view-products')}}">Danh sách sản phẩm</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-gift"></i><span>Mã phiến mãi</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{url('admin/add-coupon')}}">Thêm mã phiến mãi</a></li>
                    <li><a href="{{url('admin/view-coupons')}}">Danh sách mã phiến mãi</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="{{url('admin/orders')}}">
                    <i class="pe-7s-cart"></i><span>Đơn hàng</span>
                </a>
            </li>
            <li class="treeview">
                <a href="{{url('admin/contacts')}}">
                    <i class="fa fa-commenting"></i><span>Liên hệ</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar -->
</aside>
<!-- =============================================== -->
