
<head>
</head>
<div class="modal fade" id="modal-create-branch" tabindex="-1" role="dialog" aria-labelledby="modal-fadein" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h2 class="block-title">Thêm trường học</h2>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="form-group">
                        <label for="example-nf-email">Tên trường học</label>
                        <input type="text" class="form-control" id="name-branch" name="name-branch" placeholder="" data-not-empty>
                        <div class="invalid-feedback error-message"></div>
                    </div>
                    <div class="form-group">
                        <label for="example-nf-email">Email</label>
                        <input type="email" class="form-control" id="email-branch" name="email-branch" placeholder="" data-not-empty data-validate=mail>
                        <div class="invalid-feedback error-message"></div>
                    </div>
                    <div class="form-group">
                        <label for="example-nf-email">Số điện thoại</label>
                        <input type="phone" class="form-control" id="phone-branch" name="phone-branch" placeholder="" phone-required-template>
                        <div class="invalid-feedback error-message"></div>
                    </div>
                    <div class="form-group">
                        <label for="example-nf-email">Địa chỉ</label>
                        <input type="text" class="form-control" id="address-branch" name="address-branch" placeholder="" data-not-empty>
                        <div class="invalid-feedback error-message"></div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div id="map"></div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" onclick="CloseModalCreateBranch()" >Đóng</button>
                <button type="button" class="btn btn-alt-success" onclick="create()">
                    <i class="fa fa-check"></i> Thêm
                </button>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDufLLFr5vYdj5F-f8-tMiYrUWKwbGMCOs&callback=initMap&libraries=places"async defer></script>
    <script src="{{ asset('assets/js/Admin/manage/branch/create.js')}}"></script>
@endpush

