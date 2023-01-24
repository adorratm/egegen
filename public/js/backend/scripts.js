window.addEventListener('DOMContentLoaded', function () {
    // Tooltips
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
});

/**
 * Datatables with server side processing
*/
// Datatables
function TableInitializer(table, data, url, filterSearch = false, aocolumndefs = [{
    "sClass": "text-center justify-content-center align-middle",
    "aTargets": "_all"
}, {
    "type": 'turkish',
    "targets": '_all'
}, {
    "targets": ['nosort'],
    "orderable": false,
},]) {
    $('table.' + table).on('draw.dt', function () {
        $('table.' + table).DataTable().columns.adjust();
        $('table.' + table).DataTable().responsive.recalc();
    });
    $('table.' + table).DataTable({
        "destroy": true,
        "renderer": "bootstrap",
        "deferRender": true,
        "stateSave": true,
        "bstateSave": true,
        "responsive": true,
        "dom": (filterSearch === false ? "<'d-flex align-content-center flex-wrap justify-content-between' <'justify-content-start' l><'justify-content-center'r><'justify-content-end'f>>t<'d-flex flex-wrap justify-content-between' <'justify-content-start'i> <'justify-content-end'p>>" : "<'d-flex align-content-center justify-content-between' <'justify-content-start'><'justify-content-center text-center flex-grow-1'r><'justify-content-end'>>t<'d-flex flex-wrap align-content-center justify-content-between' <'justify-content-start text-center' <'pt-2'l>><'justify-content-end text-center'p>><i>"),
        "order": [],
        "aaSorting": [],
        "bSort": true,
        "aoColumnDefs": aocolumndefs,
        columnDefs: [
            {
                "sClass": "text-center justify-content-center align-middle",
                "aTargets": "_all"
            },
            {
                type: 'turkish',
                targets: '_all'
            },
            {
                targets: ['nosort'],
                orderable: false,
            },
        ],
        "search": {
            "caseInsensitive": false
        },
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "pageLength": 25,
        "iDisplayLength": 25,
        "lengthMenu": [
            [25, 50, 100, 250],
            [25, 50, 100, 250]
        ],
        'ajax': {
            'url': url,
            'data': data
        },
        "rowCallback": function (row, data) {
            if (data.rowColor !== "" && data.rowColor !== null) {
                $(row).addClass(data.rowColor);
            }
            if (data.columnColor !== "" && data.columnColor !== null && data.columnIndex !== "" && data.columnIndex !== null) {

                $.each(data.columnColor, function (key, value) {
                    $(row).find('td:eq(' + data.columnIndex + ')').css("background-color", value);
                });
            }
        },
    });
    $('table.' + table).on("responsive-display", function () {
        $('table.' + table).DataTable().columns.adjust();
        $('table.' + table).DataTable().responsive.recalc();
    });
    $('table.' + table).on("responsive-resize", function () {
        $('table.' + table).DataTable().columns.adjust();
        $('table.' + table).DataTable().responsive.recalc();
    });
}

// Search
function obj(d) {
    $.each($("#filter_form").serializeArray(), function () {
        d[this.name] = this.value;
    });
    return d;
}

// Reload Datatable
function reloadTable(table) {
    $('.' + table).DataTable().ajax.reload(null, false);
}

// Clear Filter
function clearFilter(form, table) {
    $("#" + form)[0].reset();
    reloadTable(table)
}

// Enter Search
function runScript(e, table) {
    //See notes about 'which' and 'key'
    if (e.keyCode == 13) {
        reloadTable(table);
        return false;
    }
}

/**
 * #Datatables with server side processing
 */