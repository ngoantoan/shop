<header class="main-header">
    <a href="{{url('/admin/dashboard')}}" class="logo">
        <!-- Logo -->
        <span class="logo-mini">
            <img src="{{asset('public/admin_assets/dist/img/mini-logo.png')}}" alt="">
        </span>
        <span class="logo-lg">
            <img src="{{asset('public/admin_assets/dist/img/logo.png')}}" alt="">
        </span>
    </a>
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top">
       <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <!-- Sidebar toggle button-->
          <span class="sr-only">Toggle navigation</span>
          <span class="pe-7s-angle-left-circle"></span>
       </a>
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <!-- user -->
            <li class="dropdown dropdown-user">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="{{asset('public/admin_assets/dist/img/avatar5.png')}}" class="img-circle" width="45" height="45" alt="user"></a>
                <ul class="dropdown-menu" >
                    <li>
                        <a href="profile.html">
                        <i class="fa fa-user"></i> {{Auth::user()->name}}</a>
                    </li>
                    <li><a href="{{url('/logout')}}">
                        <i class="fa fa-sign-out"></i> Đăng xuất</a>
                    </li>
                </ul>
            </li>
        </ul>
       </div>
    </nav>
</header>
