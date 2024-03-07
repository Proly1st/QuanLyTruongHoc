let id = null;
function openModalEditBranch(branch_id)
{
    id = branch_id;
    $('#modal-edit-branch').modal('show');
    LoadDataBranch();
}

async function LoadDataBranch(){
    let method = 'get',
    url = 'branch-data-update',
    data = {
        id:id
    },
    param = null;
    let res = await templateCallAjax(method,url,data,param);
    $('#edit-name-branch').val(res.data['school_name']),
    $('#edit-email-branch').val(res.data['email']),
    $('#edit-phone-branch').val(res.data['phone']),
    $('#edit-address-branch').val(res.data['address']);
}

async function edit(){
    checkEmptyTemplate('#modal-edit-branch');
    checkPhoneTemplate('#modal-edit-branch');
    checkSelectTemplate('#modal-edit-branch');

    let method = 'post',
    url = 'edit-branch',
    data = {
        id : id,
        name : $('#edit-name-branch').val(),
        email : $('#edit-email-branch').val(),
        phone : $('#edit-phone-branch').val(),
        address: $('#edit-address-branch').val(),
    },
    param = null;
    let res = await templateCallAjax(method,url,data,param);
    if(res.success === '200'){
        let title = 'Thông Báo',
            text = 'Cập nhật thành công';
        SwalSuccess(title,text);
        loadData();
        CloseModalEditBranch();
    }
}

async function changStatus(status,branh_id){
    if(status === '1'){
        Swal.fire({
            title: 'Thông báo',
            text: "Bạn có muốn tạm dừng hoạt động ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Đồng ý',
            cancelButton : 'Đóng',
        }).then(async(result) => {
            if (result.value) {
                let method = 'post',
                url = 'change-status',
                data = {
                    id : branh_id,
                    status : status
                },
                param = null;
                let res = await templateCallAjax(method,url,data,param);
                if(res.success === '200'){
                    let title = 'Thông Báo',
                        text = 'Cập nhật thành công';
                    SwalSuccess(title,text);
                    loadData();
                    CloseModalEditBranch();
                }
            }
        })
    }else{
        Swal.fire({
            title: 'Thông báo',
            text: "Bạn có muốn hoạt động ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Đồng ý',
            cancelButton : 'Đóng',
        }).then(async(result) => {
            if (result.value) {
                let method = 'post',
                url = 'change-status',
                data = {
                    id : branh_id,
                    status : status
                },
                param = null;
                let res = await templateCallAjax(method,url,data,param);
                if(res.success === '200'){
                    let title = 'Thông Báo',
                        text = 'Cập nhật thành công';
                    SwalSuccess(title,text);
                    loadData();
                    CloseModalEditBranch();
                }
            }
        })
    }
}

function CloseModalEditBranch(){
    $('#modal-edit-branch').modal('hide');
}

