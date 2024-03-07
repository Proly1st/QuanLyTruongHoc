@extends('layouts.layout')

@section('title')

@section('content')
<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content pt-0">
        <!-- Default Table Style -->
        <div class="col-sm-12 row">
            <div class="col-sm-6">
                <h2 class="content-heading pt-4">Danh sách trường học</h2>
            </div>
        </div>
        <!-- Dynamic Table Full Pagination -->
        <div class="block">
            <ul class="nav nav-tabs nav-tabs-block align-items-center" data-toggle="tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#btabswo-static-home">Đang hoạt động</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#btabswo-static-profile">Tạm ngưng</a>
                </li>
            </ul>
            <div class="block-content tab-content">
                <div class="tab-pane active" id="btabswo-static-home" role="tabpanel">
                    <div class="block-header text-right">
                        <button type="button" class="btn btn-primary min-width-125 ml-auto" onclick="openModalCreateBranch()">Thêm mới</button>
                   </div>
                    <div class="block-content block-content-full">
                        <div class="col-sm-12 col-md-12 col-xl-12 p-0">
                            <div class="table-responsive">
                                <table id="table-branch" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">STT</th>
                                            <th class="text-center">Tên trường học</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">SĐT</th>
                                            <th class="text-center">Địa chỉ</th>
                                            <th class="text-center">Chức năng</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="tab-pane" id="btabswo-static-profile" role="tabpanel">
                    <div class="block-header text-right">
                        <button type="button" class="btn btn-primary min-width-125 ml-auto" onclick="openModalCreateBranch()">Thêm mới</button>
                   </div>
                    <div class="block-content block-content-full">
                        <div class="col-sm-12 col-md-12 col-xl-12 p-0">
                            <div class="table-responsive">
                                <table id="table-branch-off" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">STT</th>
                                            <th class="text-center">Tên trường học</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">SĐT</th>
                                            <th class="text-center">Địa chỉ</th>
                                            <th class="text-center">Chức năng</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- END Dynamic Table Full Pagination -->
    </div>
    <!-- END Page Content -->
</main>
@include('Admin.manage.branch.create')
@include('Admin.manage.branch.edit')
@include('Admin.manage.branch.qrcode')
<!-- END Main Container -->
@endsection
@push('js')
    <script src="{{ asset('assets/js/Admin/manage/branch/index.js')}}"></script>
@endpush
