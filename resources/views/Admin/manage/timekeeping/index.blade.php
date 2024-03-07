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
                <h2 class="content-heading pt-4">Danh sách chấm công</h2>
            </div>
        </div>
        <!-- Dynamic Table Full Pagination -->
        <div class="block">
            <div class="block-header text-right">
                <a href="{{ route('excel') }}" class="btn btn-primary min-width-125 ml-auto" >Xuất Excel</a>
            </div>
            <div class="block-content block-content-full">
                {{-- <div class="col-sm-12 col-md-12 col-xl-12 p-0">
                    <div class="table-responsive">
                        <table id="table-timekeeping" class="table table-bordered">
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
                </div> --}}
                <div class="col-sm-12 col-md-12 col-xl-12 pt-2">
                    <div class="">
                        <table id="table-timekeeping" class="table table-bordered js-dataTable-full">
                            <thead>
                            <tr>
                                <th class="text-center">STT</th>
                                <th class="text-center">Họ & Tên</th>
                                <th class="text-center">giờ vào</th>
                                <th class="text-center" style="width: 15%;">giờ ra</th>
                                <th class="text-center" style="width: 15%;">Thời gian</th>
                                <th class="text-center" style="width: 15%;">Địa chỉ</th>
                                <th class="text-center" style="width: 15%;">Chữ ký</th>
                                <th class="text-center" style="width: 15%;">Chắc năng</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <!-- END Dynamic Table Full Pagination -->
    </div>
    <!-- END Page Content -->
</main>
@include('Admin.manage.timekeeping.edit')

<!-- END Main Container -->
@endsection
@push('js')
    <script src="{{ asset('assets/js/Admin/manage/timekeeping/index.js')}}"></script>
@endpush
