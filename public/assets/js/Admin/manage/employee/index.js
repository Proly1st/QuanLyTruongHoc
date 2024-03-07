$(function(){
    $('#change-branch').change(function(){
        loadData();
    });
    loadData();
})

async function loadData(){
    let method = 'get',
    url = 'employee-data',
    data = {
        branch_id:$('#change-branch').val(),
    },
    param = null;
    let res = await templateCallAjax(method,url,data,param);
    dataTableEmployee(res[0].original.data);
    dataTableEmployeeOff(res[1].original.data);
}

async function dataTableEmployeeOff(data) {
    let id = $('#table-employee-off'),
        scroll_Y = '',
        fixed_left = '',
        fixed_right = '';
    let columns = [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '1%'},
        {data: 'Name', name: 'name',className: 'text-center',width: '5%' },
        {data: 'username', name: 'email', className: 'text-center',width: '5%'},
        {data: 'phone', name: 'phone', className: 'text-center', width: '5%'},
        {data: 'action', name: 'action', className: 'text-center', width: '5%'},
    ];
    await DatatableTemplate(id, data, columns, scroll_Y, fixed_left, fixed_right);
}
async function dataTableEmployee(data) {
    let id = $('#table-employee'),
        scroll_Y = '',
        fixed_left = '',
        fixed_right = '';
    let columns = [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '1%'},
        {data: 'Name', name: 'name',className: 'text-center' },
        {data: 'username', name: 'email', className: 'text-center'},
        {data: 'phone', name: 'phone', className: 'text-center'},
        {data: 'action', name: 'action', className: 'text-center'},
    ];
    await DatatableTemplate(id, data, columns, scroll_Y, fixed_left, fixed_right);
}

$('.nav-tabs a').on('shown.bs.tab', function(event){
    loadData();
});
