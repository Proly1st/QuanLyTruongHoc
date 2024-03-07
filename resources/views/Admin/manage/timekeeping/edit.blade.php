<div class="modal fade" id="modal-edit-timekeeping" tabindex="-1" role="dialog" aria-labelledby="modal-fadein" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h2 class="block-title">Chỉnh sửa chấm công</h2>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="form-group row">
                        <label class="col-12" for="example-select">Ngày chấm công</label>
                        <div class="col-md-12">
                            <label for="" id="date-timekeeping"></label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-12">
                            <label for="example-flatpickr-time-standalone-24">Giờ vào</label>
                            <input type="text" class="text-center js-flatpickr form-control" id="time-in" name="example-flatpickr-time-standalone-24" data-enable-time="true" data-no-calendar="true" data-date-format="H:i" data-time_24hr="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="example-nf-email">Giờ ra</label>
                        <input type="email" class="form-control text-center" id="time-out" name="email-teacher"  data-not-empty >
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" onclick="CloseModalEditTimeKeeping()" >Đóng</button>
                <button type="button" class="btn btn-alt-success" onclick="edit()">
                    <i class="fa fa-check"></i> Cập nhật
                </button>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script src="{{ asset('assets/js/Admin/manage/timekeeping/edit.js')}}"></script>
@endpush
