let id = null;
function openModalEditEmployee(employee_id)
{
    id = employee_id;
    $('#modal-edit-employee').modal('show');
    LoadDataEmployee();
}

async function LoadDataEmployee(){
    let method = 'get',
    url = 'employee-data-update',
    data = {
        id:id
    },
    param = null;
    let res = await templateCallAjax(method,url,data,param);
    $('#edit-select-branch-employee').html(res.branch);
    $('#edit-name-employee').val(res.data['Name']),
    $('#edit-email-employee').val(res.data['username']),
    $('#edit-phone-employee').val(res.data['phone']),
    $('#edit-address-employee').val(res.data['address']);
}

async function edit(){
    checkEmptyTemplate('#modal-edit-employee');
    checkPhoneTemplate('#modal-edit-employee');
    checkSelectTemplate('#modal-edit-employee');

    let method = 'post',
    url = 'edit-employee',
    data = {
        id : id,
        branch: $('#edit-select-branch option:selected').val(),
        name : $('#edit-name-employee').val(),
        email : $('#edit-email-employee').val(),
        phone : $('#edit-phone-employee').val(),
        address: $('#edit-address-employee').val(),
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

async function changeProfile(){
    checkEmptyTemplate('#main-container');
    checkPhoneTemplate('#main-container');
    checkSelectTemplate('#main-container');

    let method = 'post',
    url = 'change-profile',
    data = {
        name : $('#name-profile').val(),
        email : $('#email-profile').val(),
        phone : $('#phone-profile').text(),
        address: $('#address-profile').val(),
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

async function changepassword(){
    if(!checkEmptyTemplate('#main-container') || !checkPhoneTemplate('#main-container') ||!checkSelectTemplate('#main-container')){
        return false;
    }

    let method = 'post',
    url = 'change-password',
    data = {
        password : $('#profile-settings-password').val(),
        password_new : $('#profile-settings-password-new').val(),
        re_password_new : $('#profile-settings-password-new-confirm').val(),
    },
    param = null;
    let res = await templateCallAjax(method,url,data,param);
    if(res.success === '200'){
        let title = 'Thông Báo',
            text = 'Cập nhật thành công';
        SwalSuccess(title,text);
        setTimeout(() => {
            window.location.href = '/login';
        }, 1000);
    }else{
        $('#profile-settings-password').removeClass('is-valid');
        $('#profile-settings-password').addClass('is-invalid');
        $('#profile-settings-password').parent().find('.error-message').text(res.error);

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
                url = 'change-status-employee',
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
                url = 'change-status-employee',
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


function CloseModalEditEmployee(){
    $('#modal-edit-employee').modal('hide');
}
