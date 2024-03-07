<nav id="sidebar">
    <!-- Sidebar Content -->
    <div class="sidebar-content">
        <!-- Side Header -->
        <div class="content-header content-header-fullrow px-15 mt-5" style="    display: flex; justify-content: center;align-items: center;">
            <div class="navbar-logo" logo-theme="theme1" style="max-width: 60%;">
                <a class="mobile-menu" id="mobile-collapse" href="#!">
                    <i class="feather icon-menu icon-toggle-right"></i>
                </a>
                <a href="/">
                    <img class="img-fluid p-5-px mt-5" src="{{ asset('assets/image/logo_123angels.svg') }}" alt="Theme-Logo">
                </a>
                <a class="mobile-options">
                    <i class="feather icon-more-horizontal"></i>
                </a>
            </div>
        </div>
        <!-- END Side Header -->

        <!-- Side User -->
        <div class="content-side content-side-full content-side-user px-10 align-parent">
            <!-- Visible only in mini mode -->
            <div class="sidebar-mini-visible-b align-v animated fadeIn">
                <img class="img-avatar img-avatar32" src="assets/media/avatars/avatar15.jpg" alt="">
            </div>
            <!-- END Visible only in mini mode -->

            <!-- Visible only in normal mode -->
            <div class="sidebar-mini-hidden-b text-center">
                <a class="img-link" href="javascript:void(0)">
                    <img class="img-avatar" src="assets/media/avatars/avatar15.jpg" alt="">
                </a>
                <ul class="list-inline mt-10">
                    <li class="list-inline-item">
                        <a class="link-effect text-dual-primary-dark font-size-sm font-w600 text-uppercase" href="javascript:void(0)">{{ Auth::user()->Name }}</a>
                    </li>
                    <li class="list-inline-item">
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <a class="link-effect text-dual-primary-dark" data-toggle="layout" data-action="sidebar_style_inverse_toggle" href="javascript:void(0)">
                            <i class="si si-drop"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a class="link-effect text-dual-primary-dark" href="{{ route('logout') }}" title="Đăng xuất">
                            <i class="si si-logout"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- END Visible only in normal mode -->
        </div>
        <!-- END Side User -->

        <!-- Side Navigation -->
        <div class="content-side content-side-full">
            <ul class="nav-main">
                <li>
                    <a class="" href="{{ route('Dashboard') }}"><i class="fa fa-dashboard"></i><span class="sidebar-mini-hide">Dashboard</span></a>
                </li>
                <li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span><span class="sidebar-mini-hidden">Quản lý</span></li>
                <li>
                    <a class="@if(isset($active) && $active == 'manage.branches') active @endif" href="{{ route('get-branches') }}"><i class="si si-cup"></i><span class="sidebar-mini-hide">Trường học</span></a>
                </li>
                {{--  <li>
                    <a class="" href="javascript:void(0)"><i class="si si-cup"></i><span class="sidebar-mini-hide">Tài Khoản</span></a>
                </li>  --}}
                <li>
                    <a class="@if(isset($active) && $active == 'manage.employee') active @endif" href="{{ route('get-employee') }}"><i class="si si-cup"></i><span class="sidebar-mini-hide">Nhân Viên</span></a>
                </li>
                <li>
                    <a class="@if(isset($active) && $active == 'manage.teacher') active @endif" href="{{ route('get-teachres') }}"><i class="si si-cup"></i><span class="sidebar-mini-hide">Giảng Viên</span></a>
                </li>
                <li>
                    <a class="@if(isset($active) && $active == 'manage.timekeeping') active @endif" href="{{ route('get-timekeeping') }}"><i class="si si-briefcase fa-2x"></i><span class="sidebar-mini-hide">Chấm Công</span></a>
                </li>
                <li>
                    <a class="" href="javascript:void(0)"><i class="si si-cup"></i><span class="sidebar-mini-hide">Bảng Lương</span></a>
                </li>
            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- Sidebar Content -->
</nav>
