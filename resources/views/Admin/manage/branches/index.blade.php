@extends('layouts.layout')

@section('title', 'Danh sách chi nhánh')

@section('content')
    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Content -->
        <div class="content pt-0">
            <!-- Default Table Style -->
            <h2 class="content-heading pt-4">Danh sách chi nhánh</h2>

            <!-- Dynamic Table Full Pagination -->
            <div class="block">
                {{--            <div class="block-header block-header-default">--}}
                {{--                <h3 class="block-title">Dynamic Table <small>Full pagination</small></h3>--}}
                {{--            </div>--}}
                <div class="block-content block-content-full">
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                        <thead>
                        <tr>
                            <th class="text-center">STT</th>
                            <th class="text-center">Tên chi nhánh</th>
                            <th class="d-none d-sm-table-cell text-center">Email</th>
                            <th class="d-none d-sm-table-cell text-center" style="width: 15%;">SĐT</th>
                            <th class="d-none d-sm-table-cell text-center">Địa chỉ</th>
                            <th class="text-center" style="width: 15%;">Chức năng</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($dataTable)) {!! $dataTable !!} @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END Dynamic Table Full Pagination -->
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->
@endsection
