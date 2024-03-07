@extends('layouts.layout')

@section('title', 'Danh sách nhân viên')

@section('content')
<main id="main-container">
    <!-- Page Content -->
    <!-- User Info -->
    <div class="bg-image bg-image-bottom" style="background-image: url('assets/media/photos/photo13@2x.jpg');">
        <div class="bg-black-op-75 py-30">
            <div class="content content-full text-center">
                <!-- Avatar -->
                <div class="mb-15">
                    <a class="img-link" href="be_pages_generic_profile.html">
                        <img class="img-avatar img-avatar96 img-avatar-thumb" src="assets/media/avatars/avatar15.jpg" alt="">
                    </a>
                </div>
                <!-- END Avatar -->

                <!-- Personal -->
                <h1 class="h3 text-white font-w700 mb-10">{{ Auth::user()->Name }}</h1>
                {{-- <h2 class="h5 text-white-op">
                    Product Manager <a class="text-primary-light" href="javascript:void(0)">@GraphicXspace</a>
                </h2> --}}
                <!-- END Personal -->

                <!-- Actions -->
                {{-- <a href="be_pages_generic_profile.html" class="btn btn-rounded btn-hero btn-sm btn-alt-secondary mb-5">
                    <i class="fa fa-arrow-left mr-5"></i> Back to Profile
                </a> --}}
                <!-- END Actions -->
            </div>
        </div>
    </div>
    <!-- END User Info -->

    <!-- Main Content -->
    <div class="content">
        <!-- User Profile -->

          <div class="block">

               <ul class="nav nav-tabs nav-tabs-block align-items-center" data-toggle="tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#btabswo-static-home">Thông tin </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#btabswo-static-profile">Đổi mật khẩu</a>
                    </li>
                </ul>
                <div class="block-content tab-content">
                    <div class="tab-pane active" id="btabswo-static-home" role="tabpanel">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <i class="fa fa-user-circle mr-5 text-muted"></i> Thông tin cá nhân
                        </h3>
                    </div>
                    <div class="block-content">
                        <form action="be_pages_generic_profile.edit.html" method="POST" enctype="multipart/form-data" onsubmit="return false;">
                            <div class="row items-push">
                                <div class="col-lg-12 offset-lg-1 m-0">
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <label for="profile-settings-username">Họ và tên</label>
                                            <input type="text" class="form-control form-control-lg" id="name-profile" name="profile-settings-username" placeholder="Enter your username.." value="{{ Auth::user()->Name }}" data-not-empty>
                                            <div class="invalid-feedback error-message"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <label for="profile-settings-name">Số điện thoại</label>
                                            <div>
                                                <label type="text" class="" id="phone-profile" name="phone-profile" placeholder="Enter your name.." value="">{{ Auth::user()->phone }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <label for="profile-settings-email">Email</label>
                                            <input type="email" class="form-control form-control-lg" id="email-profile" name="profile-settings-email" placeholder="Enter your email.." value="{{ Auth::user()->username }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <label for="profile-settings-email">Địa chỉ</label>
                                            <input type="email" class="form-control form-control-lg" id="address-profile" name="profile-settings-email" placeholder="Enter your email.." value="{{ Auth::user()->address }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <button type="button" class="btn btn-alt-primary" onclick="changeProfile()">Cập nhật</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>
                    <div class="tab-pane" id="btabswo-static-profile" role="tabpanel">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <i class="fa fa-asterisk mr-5 text-muted"></i> Change Password
                        </h3>
                    </div>
                    <div class="block-content">
                        <form action="be_pages_generic_profile.edit.html" method="post" onsubmit="return false;">
                            <div class="row items-push">
                                <div class="col-lg-12 offset-lg-1 m-0">
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <label for="profile-settings-password">Mật khẩu cũ</label>
                                            <input type="password" class="form-control form-control-lg" id="profile-settings-password" name="profile-settings-password" data-not-empty>
                                            <div class="invalid-feedback error-message"></div>

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <label for="profile-settings-password-new">Mật khẩu mới</label>
                                            <input type="password" class="form-control form-control-lg" id="profile-settings-password-new" name="profile-settings-password-new" data-not-empty>
                                            <div class="invalid-feedback error-message"></div>

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <label for="profile-settings-password-new-confirm">Xác nhận mật khẩu mới</label>
                                            <input type="password" class="form-control form-control-lg" id="profile-settings-password-new-confirm" name="profile-settings-password-new-confirm" data-not-empty>
                                            <div class="invalid-feedback error-message"></div>

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <button type="button" class="btn btn-alt-primary" onclick="changepassword()">Cập nhật</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        <!-- END User Profile -->
    </div>
    <!-- END Main Content -->
    <!-- END Page Content -->
</main>
@endsection
@push('js')
    <script src="{{ asset('assets/js/Admin/manage/employee/edit.js')}}"></script>
@endpush
