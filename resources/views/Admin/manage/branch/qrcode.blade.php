<div class="modal fade" id="modal-qrcode-branch" tabindex="-1" role="dialog" aria-labelledby="modal-fadein" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div id="qrcode" class="d-flex justify-content-center mb-4 "></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-primary" onclick="download()" >In QRCode</button>
                    <button type="button" class="btn btn-alt-secondary" onclick="CloseModalQrcode()" >Đóng</button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script src="{{ asset('assets/js/Admin/manage/branch/qrcode.js')}}"></script>
@endpush

