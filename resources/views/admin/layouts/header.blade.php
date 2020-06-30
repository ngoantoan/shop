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
       <!-- searchbar-->
       <a href="#search"><span class="pe-7s-search"></span></a>
       <div id="search">
         <button type="button" class="close">×</button>
         <form>
           <input type="search" value="" placeholder="Search.." />
           <button type="submit" class="btn btn-add">Search...</button>
        </form>
     </div>
     <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <!-- user -->
            <li class="dropdown dropdown-user">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="{{asset('public/admin_assets/dist/img/avatar5.png')}}" class="img-circle" width="45" height="45" alt="user"></a>
                <ul class="dropdown-menu" >
                    <li>
                        <a href="profile.html">
                        <i class="fa fa-user"></i> User Profile</a>
                    </li>
                    <li><a href="#"><i class="fa fa-inbox"></i> Inbox</a></li>
                    <li><a href="{{url('/logout')}}">
                        <i class="fa fa-sign-out"></i> Signout</a>
                    </li>
                </ul>
            </li>
        </ul>
       </div>
    </nav>
</header>
