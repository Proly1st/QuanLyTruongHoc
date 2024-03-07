$(function(){
    loadData();
})

async function loadData(){
    let method = 'get',
    url = 'branches-data',
    data = null,
    param = null;
    let res = await templateCallAjax(method,url,data,param);
    await dataTableBranch(res);
    await dataTableBranchOff(res);

}

async function dataTableBranch(data) {
    let id = $('#table-branch'),
        scroll_Y = '',
        fixed_left = '',
        fixed_right = '';
    let columns = [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '1%'},
        {data: 'school_name', name: 'name',className: 'text-center',width: '5%' },
        {data: 'email', name: 'email', className: 'text-center',width: '5%'},
        {data: 'phone', name: 'phone', className: 'text-center', width: '5%'},
        {data: 'address', name: 'phone', className: 'text-center', width: '5%'},
        {data: 'action', name: 'action', className: 'text-center', width: '5%'},
    ];
     DatatableTemplate(id, data[0].original.data, columns, scroll_Y, fixed_left, fixed_right);
}

async function dataTableBranchOff(data) {
    let id1 = $('#table-branch-off'),
        scroll_Y = '',
        fixed_left = '',
        fixed_right = '';
    let columns = [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '1%'},
        {data: 'school_name', name: 'name',className: 'text-center',width: '5%' },
        {data: 'email', name: 'email', className: 'text-center',width: '5%'},
        {data: 'phone', name: 'phone', className: 'text-center', width: '5%'},
        {data: 'address', name: 'phone', className: 'text-center', width: '5%'},
        {data: 'action', name: 'action', className: 'text-center', width: '5%'},
    ];
    await DatatableTemplate(id1, data[1].original.data, columns, scroll_Y, fixed_left, fixed_right);
}

async function openModalQrcode(id){
    $('#qrcode').html('');
    $('#modal-qrcode-branch').modal('show');
    let method = 'get',
    url = 'branch-detail',
    data = {
        id :id,
    },
    param = null;
    let res = await templateCallAjax(method,url,data,param);
    $('#qrcode').qrcode({
        width: "400",
        height: "400",
        text : JSON.stringify(res[0].id),
    });

}
function CloseModalQrcode(){
    $('#qrcode').html('');
    $('#modal-qrcode-branch').modal('hide');
}

function download() {
    var canvas = $('#qrcode').find('canvas');
    var img = canvas[0].toDataURL("image/jpg");
    var link = document.createElement('a');
    link.href = img;
    link.download = 'image.jpg';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}


$('.nav-tabs a').on('shown.bs.tab', function(event){
    loadData();
});


