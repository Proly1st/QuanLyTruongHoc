function openModalCreateEmployee()
{
    $('#modal-create-employee').modal('show');
    // $('#select-branch').select2({
    //     dropdownParent: $('#modal-create-employee'),
    // });
    loadDataBranch();
}

async function loadDataBranch(){
    let method = 'get',
    url = 'branch-data',
    data = null,
    param = null;
    let res = await templateCallAjax(method,url,data,param);
    console.log(res);
    $('#select-branch').html(res);
}

async function create(){
    checkEmptyTemplate('#modal-create-employee');
    checkPhoneTemplate('#modal-create-employee');
    checkSelectTemplate('#modal-create-employee');
    let method = 'post',
    url = 'create-employee',
    data = {
        branch: $('#select-branch option:selected').val(),
        name : $('#name-employee').val(),
        email : $('#email-employee').val(),
        phone : $('#phone-employee').val(),
        address: $('#address-employee').val(),
    },
    param = null;
    let res = await templateCallAjax(method,url,data,param);
    if(res.success === '200'){
        let title = 'Thông Báo',
            text = 'Thêm mới thành công';
        SwalSuccess(title,text);
        loadData();
        CloseModalCreateEmployee();
    }
    else{
        $('#phone-employee').removeClass('is-valid');
        $('#phone-employee').addClass('is-invalid');
        $('#phone-employee').parent().children('.error-message').text(res.error);
    }
}

function CloseModalCreateEmployee(){
    $('#modal-create-employee').modal('hide');
    $('#select-branch option:selected').val(''),
    $('#name-employee').val(''),
    $('#email-employee').val(''),
    $('#phone-employee').val(''),
    $('#address-employee').val('');
}
