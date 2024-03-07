$(function(){
    loadData();
})

async function loadData(){
    let method = 'get',
    url = 'time-keeping-data',
    data = null,
    param = null;
    let res = await templateCallAjax(method,url,data,param);
    dataTableTimeKeeping(res[0].original.data);
}

async function dataTableTimeKeeping(data) {
    let id = $('#table-timekeeping'),
        scroll_Y = '',
        fixed_left = '',
        fixed_right = '';
    let columns = [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '1%'},
        {data: 'staff_name', name: 'staff_name',className: 'text-center'},
        {data: 'date_in', name: 'date_in', className: 'text-center',width: '5%'},
        {data: 'date_out', name: 'date_out', className: 'text-center', width: '5%'},
        {data: 'time', name: 'time', className: 'text-center', width: '5%'},
        {data: 'address', name: 'address', className: 'text-center', },
        {data: 'signature', name: 'signature', className: 'text-center', width: '5%'},
        {data: 'action', name: 'action', className: 'text-center', width: '5%'},

    ];
    await DatatableTemplate(id, data, columns, scroll_Y, fixed_left, fixed_right);
}
