function openModalCreateTeachres()
{
    $('#modal-create-teachres').modal('show');
    $('#select-branch').select2({
        dropdownParent: $('#modal-create-teachres'),
    });

    loadDataBranch();
}

async function loadDataBranch(){
    let method = 'get',
    url = 'branch-data',
    data = null,
    param = null;
    let res = await templateCallAjax(method,url,data,param);
    $('#select-branch').html(res);
}

async function create(){
    checkEmptyTemplate('#modal-create-teachres');
    checkPhoneTemplate('#modal-create-teachres');
    checkSelectTemplate('#modal-create-teachres');
    let method = 'post',
    url = 'create-teachers',
    data = {
        branch: $('#select-branch').val(),
        name : $('#name-teacher').val(),
        email : $('#email-teacher').val(),
        phone : $('#phone-teacher').val(),
        address: $('#address-teacher').val(),
    },
    param = null;
    let res = await templateCallAjax(method,url,data,param);
    if(res.success === '200'){
        let title = 'Thông Báo',
            text = 'Thêm mới thành công';
        SwalSuccess(title,text);
        loadData();
        Swal.fire({
            title: 'Thông báo',
            html : 'Tài khoản : '+ res.phone + "<br/>" + " Mật khẩu : " +res.password,
            showCancelButton: true,
          }).then((result) => {
            // if (result.value) {
            //     Swal.fire({
            //         title: 'Thông báo',
            //         html : 'Bạn có chắn chắn lưu tài khoản mật khẩu ??',
            //         showCancelButton: true,
            //       }).then((result) => {
            //         // if (result.value) {
            //         //     Swal.fire('Saved!', '', 'success')
            //         // }
            //     })
            // }
        })
        CloseModalCreateTeachres();
    }
    else{
        $('#phone-teacher').removeClass('is-valid');
        $('#phone-teacher').addClass('is-invalid');
        $('#phone-teacher').parent().children('.error-message').text(res.error);
    }
}

function CloseModalCreateTeachres(){
    $('#modal-create-teachres').modal('hide');
    $('#select-branch option:selected').val(''),
    $('#name-teacher').val(''),
    $('#email-teacher').val(''),
    $('#phone-teacher').val(''),
    $('#address-teacher').val('');
}
