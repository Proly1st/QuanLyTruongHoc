@extends('layouts.layout')

@section('title', 'Danh sách giảng viên')

@section('content')
<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content pt-0">
        <!-- Default Table Style -->
        <div class="col-sm-12 row">
            <div class="col-sm-6">
                <h2 class="content-heading pt-4">Danh sách giảng viên</h2>
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
                        <button type="button" class="btn btn-primary min-width-125 ml-auto" onclick="openModalCreateTeachres()">Thêm mới</button>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="col-sm-12 col-md-12 col-xl-12 p-0">
                            <div class="table-responsive">
                                <table id="table-teacher" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">STT</th>
                                            <th class="text-center">Họ & Tên</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center" style="width: 15%;">SĐT</th>
                                            <th class="text-center" style="width: 15%;">Chức năng</th>
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
                    <div class="col-sm-12 col-md-12 col-xl-12 p-0">
                        <div class="table-responsive">
                            <table id="table-teacher-off" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">STT</th>
                                        <th class="text-center">Họ & Tên</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center" style="width: 15%;">SĐT</th>
                                        <th class="text-center" style="width: 15%;">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Dynamic Table Full Pagination -->
    </div>
    <!-- END Page Content -->
</main>
@include('Admin.manage.teachers.create')
@include('Admin.manage.teachers.edit')

<!-- END Main Container -->
@endsection
@push('js')
    <script src="{{ asset('assets/js/Admin/manage/teachers/index.js')}}"></script>
@endpush
