<div class="modal fade" id="modal-create-employee" tabindex="-1" role="dialog" aria-labelledby="modal-fadein" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h2 class="block-title">Thêm giảng viên</h2>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    {{-- <div class="form-group row">
                        <label class="col-12" for="example-select">Chi Nhánh</label>
                        <div class="col-md-12">
                            <select class="form-control js-example-basic-single" id="select-branch" name="example-select" data-select-not-empty>

                            </select>
                            <div class="invalid-feedback error-message"></div>
                        </div>
                    </div> --}}
                    <div class="form-group">
                        <label for="example-nf-email">Tên nhân viên</label>
                        <input type="text" class="form-control" id="name-employee" name="name-employee" placeholder="" data-not-empty>
                        <div class="invalid-feedback error-message"></div>
                    </div>
                    <div class="form-group">
                        <label for="example-nf-email">Email</label>
                        <input type="email" class="form-control" id="email-employee" name="email-employee" placeholder="" data-not-empty data-validate=mail>
                        <div class="invalid-feedback error-message"></div>
                    </div>
                    <div class="form-group">
                        <label for="example-nf-email">Số điện thoại</label>
                        <input type="phone" class="form-control" id="phone-employee" name="phone-employee" placeholder="" phone-required-template>
                        <div class="invalid-feedback error-message"></div>
                    </div>
                    <div class="form-group">
                        <label for="example-nf-email">Địa chỉ</label>
                        <input type="text" class="form-control" id="address-employee" name="address-employee" placeholder="" data-not-empty>
                        <div class="invalid-feedback error-message"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" onclick="CloseModalCreateEmployee()" >Đóng</button>
                <button type="button" class="btn btn-alt-success" onclick="create()">
                    <i class="fa fa-check"></i> Thêm
                </button>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script src="{{ asset('assets/js/Admin/manage/employee/create.js')}}"></script>
@endpush
