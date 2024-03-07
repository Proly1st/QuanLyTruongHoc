<div class="modal fade" id="modal-edit-teachres" tabindex="-1" role="dialog" aria-labelledby="modal-fadein" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h2 class="block-title">Chỉnh sửa giảng viên</h2>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="form-group row">
                        <label class="col-12" for="example-select">Trường học</label>
                        <div class="col-md-12">
                            <select class="form-control js-example-basic-single" id="edit-select-branch" multiple name="example-select"  data-select-not-empty >

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="example-nf-email">Tên giảng viên</label>
                        <input type="text" class="form-control " id="edit-name-teacher" name="name-teacher" placeholder="Nguyễn Văn A" data-not-empty>
                    </div>
                    <div class="form-group">
                        <label for="example-nf-email">Email</label>
                        <input type="email" class="form-control" id="edit-email-teacher" name="email-teacher" placeholder="a@gmail.com" data-not-empty data-validate=mail>
                    </div>
                    <div class="form-group">
                        <label for="example-nf-email">Số điện thoại</label>
                        <input type="phone" class="form-control" id="edit-phone-teacher" name="phone-teacher" placeholder="0937772618" phone-required-template>
                    </div>
                    <div class="form-group">
                        <label for="example-nf-email">Địa chỉ</label>
                        <input type="text" class="form-control" id="edit-address-teacher" name="address-teacher" placeholder="TPHCM" data-not-empty>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" onclick="CloseModalEditTeachres()" >Đóng</button>
                <button type="button" class="btn btn-alt-success" onclick="edit()">
                    <i class="fa fa-check"></i> Cập nhật
                </button>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script src="{{ asset('assets/js/Admin/manage/teachers/edit.js')}}"></script>
@endpush
