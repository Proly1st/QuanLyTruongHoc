<div class="modal fade" id="modal-edit-branch" tabindex="-1" role="dialog" aria-labelledby="modal-fadein" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h2 class="block-title">Chỉnh sửa trường học</h2>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="form-group">
                        <label for="example-nf-email">Tên trường học</label>
                        <input type="text" class="form-control " id="edit-name-branch" name="name-branch" placeholder="Nguyễn Văn A" data-not-empty>
                        <div class="invalid-feedback error-message"></div>
                    </div>
                    <div class="form-group">
                        <label for="example-nf-email">Email</label>
                        <input type="email" class="form-control" id="edit-email-branch" name="email-branch" placeholder="a@gmail.com" data-not-empty data-validate=mail>
                        <div class="invalid-feedback error-message"></div>
                    </div>
                    <div class="form-group">
                        <label for="example-nf-email">Số điện thoại</label>
                        <input type="phone" class="form-control" id="edit-phone-branch" name="phone-branch" placeholder="0937772618" phone-required-template>
                        <div class="invalid-feedback error-message"></div>
                    </div>
                    <div class="form-group">
                        <label for="example-nf-email">Địa chỉ</label>
                        <input type="text" class="form-control" id="edit-address-branch" name="address-branch" placeholder="TPHCM" data-not-empty>
                        <div class="invalid-feedback error-message"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" onclick="CloseModalEditBranch()" >Đóng</button>
                <button type="button" class="btn btn-alt-success" onclick="edit()">
                    <i class="fa fa-check"></i> Cập nhật
                </button>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script src="{{ asset('assets/js/Admin/manage/branch/edit.js')}}"></script>
@endpush
