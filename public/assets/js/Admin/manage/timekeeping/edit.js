// let id = null;
function openModalEditTimeKeeping(timekeeping_id)
{
    id = timekeeping_id;
    $('#modal-edit-timekeeping').modal('show');

    LoadDataTimeKeeping();
    $('#time-in').flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true
    })

    $('#time-out').flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
    })
}
async function LoadDataTimeKeeping(){
    let method = 'get',
    url = 'timekeeping-data-update',
    data = {
        id:id
    },
    param = null;
    let res = await templateCallAjax(method,url,data,param);
    $('#time-in').val(res['data'].date_in);
    $('#time-out').val(res['data'].date_out);
    $('#date-timekeeping').text(res['data'].date);

}
async function edit(){
    checkEmptyTemplate('#modal-edit-branch');
    checkPhoneTemplate('#modal-edit-branch');
    checkSelectTemplate('#modal-edit-branch');

    let method = 'post',
    url = 'edit-timekeeping',
    data = {
        id : id,
        time_in : $('#time-in').val(),
        time_out : $('#time-out').val(),
    },
    param = null;
    let res = await templateCallAjax(method,url,data,param);
    if(res.success === '200'){
        let title = 'Thông Báo',
            text = 'Cập nhật thành công';
        SwalSuccess(title,text);
        loadData();
        CloseModalEditTimeKeeping();
    }
}


function CloseModalEditTimeKeeping(){
    $('#modal-edit-timekeeping').modal('hide');
}
