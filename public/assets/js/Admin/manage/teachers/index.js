$(function(){
    loadData();
})

async function loadData(){
    let method = 'get',
    url = 'teacher-data',
    data = null,
    param = null;
    let res = await templateCallAjax(method,url,data,param);
    dataTableTeacher(res);
}

async function dataTableTeacher(data) {
    let id = $('#table-teacher'),
        id1 = $('#table-teacher-off'),
        scroll_Y = '',
        fixed_left = '',
        fixed_right = '';
    let columns = [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '1%'},
        {data: 'name', name: 'name',className: 'text-center',width: '5%' },
        {data: 'email', name: 'email', className: 'text-center',width: '5%'},
        {data: 'phone', name: 'phone', className: 'text-center', width: '5%'},
        {data: 'action', name: 'action', className: 'text-center', width: '5%'},
    ];
    await DatatableTemplate(id, data[0].original.data, columns, scroll_Y, fixed_left, fixed_right);
    await DatatableTemplate(id1, data[1].original.data, columns, scroll_Y, fixed_left, fixed_right);

}
$('.nav-tabs a').on('shown.bs.tab', function(event){
    loadData();
});
