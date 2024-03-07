// Datatable template
/**
 * @param id: $('#id')
 * @param data_table: [data]
 * @param column: []
 * @param scroll_Y: 'xxvh'
 * @param fixed_left: int
 * @param fixed_right: int
 * @param initComplete: default null
 * @param rowsGroup: default null
 * @returns {Promise<void>}
 * @constructor
 */
 async function DatatableTemplate(id, data_table, column, scroll_Y, fixed_left, fixed_right, initComplete, rowsGroup) {
    try {
        let length = parseInt($('#data-table-length').val());
        // $('body').append(loadingBall);
        let table = await id.DataTable({
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

        id.on('draw.dt', function () {
            $('[data-toggle="tooltip"]').tooltip({
                trigger : 'hover',
                container: 'body',
                html : true
            });
        });

        datatableDraw();
        return table;
    } catch (e) {
        console.log('Error Data Table Template !' + e)
    }
}

/**
 * @param id: $('#id')
 * @param data_table: [data]
 * @param column: []
 * @param scroll_Y: 'xxvh'
 * @param fixed_left: int
 * @param fixed_right: int
 * @param page_number: page current
 * @param total_page: max size datatable
 * @returns {Promise<void>}
 * @constructor
 */


/**
 * Show img null data
 */
function nullDataImg(id) {
    id.html("<div class='empty-datatable-custom center-loading' ><img src='../../../../files/assets/images/nodata-datatable2.png'></div>");
}

/**
 * Vẽ lại bảng khi cột bị lệch
 */
function datatableDraw() {
    $.fn.dataTable.tables({visible: true, api: true}).columns.adjust().draw();
}

/**
 * Scroll EmptyDatatable When Changed BS Tab.
 */
$(function () {
    $('a[data-toggle="tab"]').not('.remove-draw-table').on('shown.bs.tab', function (e) {
        $.fn.dataTable.tables({visible: true, api: true}).columns.adjust().draw();
        checkEmptyTableTabAndScroll($(this));
    });

});

let widthTb = 0;
let widthWrapper = 0;

// function checkEmptyTableTabAndScroll(i) {
//     let idTable = $(i).attr('href');
//     widthTb = $(idTable).find('.dataTables_scroll .dataTables_scrollBody table').width();
//     widthWrapper = $(idTable).find('.dataTables_scroll .dataTables_scrollBody').width();
//     if ($(idTable).find('.dataTables_scroll .dataTables_scrollBody table tbody tr td').eq(0).hasClass('dataTables_empty')) {
//         $(idTable).find('.dataTables_scroll .dataTables_scrollBody').animate(
//             {scrollLeft: (widthTb - widthWrapper) / 2}, 500, 'easeOutQuad'
//         )
//     }
// }

// /**
//  * Check empty ALL DATATABLE and SCROLL center.
//  */

// $(document).on('init.dt', function (e, settings, json) {
//     setTimeout(function () {
//         datatableDraw();
//     }, 300);
//     if (settings.aoData.length === 0) {
//         let tb = '#' + settings.sTableId + '_wrapper';
//         let findDTScroll = $(tb).find('div').hasClass('dataTables_scroll');
//         if (findDTScroll === true) {
//             widthTb = $(tb + ' .dataTables_scroll .dataTables_scrollBody table')[0].offsetWidth;
//             widthWrapper = $(tb + ' .dataTables_scroll .dataTables_scrollBody')[0].offsetWidth;
//             $(tb).find('.dataTables_scroll .dataTables_scrollBody').animate(
//                 {scrollLeft: (widthTb - widthWrapper) / 2}, 500, 'easeOutQuad'
//             )
//         }

//         $(tb + ' .DTFC_RightBodyWrapper').removeClass('border-DTFC-right');
//         $(tb + ' .DTFC_RightHeadWrapper').removeClass('border-DTFC-right');
//         $(tb + ' .DTFC_LeftBodyWrapper').removeClass('border-DTFC-left');
//         $(tb + ' .DTFC_LeftHeadWrapper').removeClass('border-DTFC-left');
//     } else {
//         let tb2 = '#' + settings.sTableId + '_wrapper';
//         $(tb2 + ' .DTFC_RightBodyWrapper').addClass('border-DTFC-right');
//         $(tb2 + ' .DTFC_RightHeadWrapper').addClass('border-DTFC-right');
//         $(tb2 + ' .DTFC_LeftBodyWrapper').addClass('border-DTFC-left');
//         $(tb2 + ' .DTFC_LeftHeadWrapper').addClass('border-DTFC-left');
//     }

//     $('.DTFC_RightWrapper .DTFC_RightBodyWrapper .DTFC_RightBodyLiner table thead').remove();

//     //Custom size filter Datatable.
//     let tbs = '#' + settings.sTableId + '_wrapper';
//     $(tbs).find('.dataTables_length').parent().removeClass('col-md-6').addClass('col-md-3');
//     $(tbs).find('.dataTables_filter').parent().removeClass('col-md-6').addClass('col-md-9');
//     $(tbs).find('.dataTables_length label select').addClass('data-table-length-custom');
// });

/**
 * fix tab with multiple Datatable
 *
 */
$('a[data-toggle="tab"]').on('click', function () {
    $('.tab-pane[id="' + this.hash.substr(1) + '"]').parents('.tab-content').find('.tab-pane').removeClass('active');
    $(this.hash).addClass('active');
});

/**
 * fix collapse datatable
 */
$(document).on('click', '#mobile-collapse', function () {
    datatableDraw();
});

/**
 * Check Scrollbar
 */
$.fn.hasScrollBarHorizontal = function () {
    return this.get(0).scrollWidth > this.width();
};

$.fn.hasScrollBarVertical = function () {
    return this.get(0).scrollHeight > this.height();
};

/**
 * Keep Datatable Length
 */
$(document).on('change', '.data-table-length-custom', function () {
    axios({
        method: 'get',
        url: '/home.update-datatable-length',
        params: {length: $(this).val()}
    }).then(res => {
        if ($('.page-body .data-table-length-custom').length > 1) {
            $('.data-table-length-custom').not($(this)).each(function (index, value) {
                $('#' + $(value).attr('aria-controls')).DataTable().page.len(res.data).draw();
            })
        } else {
            return false;
        }
    });
});

function addRowDT(id, array_col) {
    let table = $(id).DataTable();
    table.row.add(array_col).draw(false);
}


