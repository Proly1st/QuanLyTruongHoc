async function templateCallAjax(method,url, data, param ){
    try{
        let res = await $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: method,
            url: url,
            data: data,
            param : param,
        });
        return res;
    }catch (e) {
        console.log(e + ' templateCallAjax' + '\n' + 'url: ' + url);
        return e;
    }

}

async function DatatableTemplate(id, data_table, column, scroll_Y, fixed_left, fixed_right, initComplete, rowsGroup) {
    try {
        let length = parseInt($('#data-table-length').val());
        let table = await id.DataTable({
            columnDefs: [
                { width: '20%', targets: 0 }
            ],
            destroy: true,
            responsive: false,
            processing: true,
            language: {
                emptyTable: "<div class='empty-datatable-custom'><img src='../../../../files/assets/images/nodata-datatable2.png'></div>",
                processing: 'Đang tải ....'
            },
            serverSide: false,
            ordering: false,
            data: data_table,
            rowsGroup: rowsGroup,
            columns: column,
            scrollY: scroll_Y,
            scrollX: true,
            scrollCollapse: true,
            pageLength: length,
            lengthMenu: [[25, 50, 100, -1], [25, 50, 100, 'Tất cả']],
            fixedColumns: {
                leftColumns: fixed_left,
                rightColumns: fixed_right,
            },
            "initComplete": initComplete,
        });
        table.columns.adjust().draw();
        // id.on('draw.dt', function () {
        //     $('[data-toggle="tooltip"]').tooltip({
        //         trigger : 'hover',
        //         container: 'body',
        //         html : true
        //     });
        // });

        datatableDraw();
        return table;
    } catch (e) {
        console.log('Error Data Table Template !' + e)
    }
}

function datatableDraw() {
    $.fn.dataTable.tables({visible: true, api: true}).columns.adjust().draw();
}


function SwalSuccess(title,text,){
    Swal.fire({
        icon: 'success',
        title: title,
        text: text,
        showConfirmButton: false,
        timer: 1000
    })
}
