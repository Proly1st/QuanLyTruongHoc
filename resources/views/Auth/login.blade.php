<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="login page create with argon design system - Free Design Bootstrap 4 clean code">
		<meta name="author" content="Hmairi Halim">
        <meta name="csrf-token" content="{{ csrf_token() }}">

		<title>123 Angels Chấp cánh tương lai cho bé</title>
		<!-- Favicon -->
		<link href="{{ asset('assets/image/logo_123angels.svg') }}" rel="icon" type="image/svg">
		<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
		<!-- Icons -->
		<link href="{{ asset('assets/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
		<!-- Argon CSS -->
		<link type="text/css" href="{{ asset('assets/css/argon.css?v=1.0.1') }}" rel="stylesheet">
		<link type="text/css" href="{{ asset('assets/css/style.css?v=1.0.1') }}" rel="stylesheet">
        <link type="text/css" href="{{ asset('assets/css/login.css?v=1.0.1') }}" rel="stylesheet">

	</head>
	<body>
		<div class="container-fluid px-4 py-5 mx-auto" style="width: 97%;">
            <div class="card card0">
                <div class="d-flex flex-lg-row flex-column-reverse">
                    <div class=" card1">
                        <div class="row justify-content-center my-auto">
                            <div class="col-md-8 col-10 my-5">
                                <div class="row justify-content-center px-3 mb-3">
                                    <img id="logo" src="{{ asset('assets/image/logo_123angels.svg') }}">
                                </div>
                                <form class="form-horizontal">
                                    {{ csrf_field() }}

                                    <h3 class="mb-5 text-center heading"></h3>
                                    <h6 class="msg-info text-center text-danger" id="text-error"></h6>
                                    <div class="form-group"> <input type="text" class="form-control" id="username" name="username" placeholder="Nhập số điện thoại"> </div>
                                    <div class="form-group"> <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu"> </div>
                                    <div class="row" style="margin-top: 5rem">
                                        <div class="custom-control custom-checkbox col-6">
                                            <input id="my-input" class="custom-control-input" type="checkbox" name="" value="true">
                                            <label for="my-input" class="custom-control-label">Lưu đăng nhập</label>
                                        </div>
                                        <div class="col-sm-6" >
                                            <a href="{{ route('forgot') }}" style="color: #4774b5">Quên mật khẩu</a>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center my-3 px-3"> <button type="button" onclick="login()" class="btn-block btn-color">Đăng nhặp</button> </div>
                                </form>
                            </div>
                        </div>
                        <div class="bottom text-center mb-1">
                            <p href="#" style="color: #110a69" class="sm-text mx-auto mb-3">SẢN PHẨM ĐƯỢC PHÁT TRIỂN BỞI TRONG HIEP PXL</p>
                        </div>
                    </div>
                    <div class="card2">
                        <div id="image">

                        </div>
                    </div>
                </div>
            </div>
        </div>
	</section>
</body>
    <script src="{{ asset('assets/js/codebase.core.min.js') }}"></script>
    <script src="{{ asset('assets/js/codebase.app.min.js') }}"></script>
    <script src="{{ asset('assets/js/Admin/manage/index.js') }}"></script>
    <script src="{{ asset('assets/js/Admin/manage/validate.js') }}"></script>

    <script src="{{ asset('assets/js/Admin/manage/login.js') }}"></script>

</html>
