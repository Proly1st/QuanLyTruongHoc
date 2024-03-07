let id = null;
function openModalEditTeachres(teacher_id)
{
    id = teacher_id;
    $('#modal-edit-teachres').modal('show');
    $('#edit-select-branch').select2({
        dropdownParent: $('#modal-edit-teachres'),
    });
    LoadDateTeacher();
}

async function LoadDateTeacher(){
    let method = 'get',
    url = 'teacher-data-update',
    data = {
        id:id
    },
    param = null;
    let res = await templateCallAjax(method,url,data,param);
    $('#edit-select-branch').html(res.branch);
    $('#edit-name-teacher').val(res.data['name']),
    $('#edit-email-teacher').val(res.data['email']),
    $('#edit-phone-teacher').val(res.data['phone']),
    $('#edit-address-teacher').val(res.data['address']);
}

async function edit(){
    checkEmptyTemplate('#modal-edit-teachres');
    checkPhoneTemplate('#modal-edit-teachres');
    checkSelectTemplate('#modal-edit-teachres');
    let method = 'post',
    url = 'edit-teachers',
    data = {
        id : id,
        branch: $('#edit-select-branch').val(),
        name : $('#edit-name-teacher').val(),
        email : $('#edit-email-teacher').val(),
        phone : $('#edit-phone-teacher').val(),
        address: $('#edit-address-teacher').val(),
    },
    param = null;
    let res = await templateCallAjax(method,url,data,param);
    if(res.success === '200'){
        let title = 'Thông Báo',
            text = 'Cập nhật thành công';
        SwalSuccess(title,text);
        loadData();
        CloseModalEditTeachres();
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
                url = 'change-status-teachers',
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
                    CloseModalEditEmployee();
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
                url = 'change-status-teachers',
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




function CloseModalEditTeachres(){
    $('#modal-edit-teachres').modal('hide');
}
