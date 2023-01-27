window.addEventListener('DOMContentLoaded', function () {
    // Tooltips
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

    /** IsCoverSetter */
    $(document).on('change', '.is_cover', function () {
        let id = $(this).data("id");
        let url = $(this).data("url");
        let dataTable = $(this).data("table");
        let value = null;
        if ($(this).is(":checked")) {
            value = 1;
        } else {
            value = 0;
        }
        $.post(url, {
            "id": id,
            "data": value
        }, function (data) {
            if (data.success) {
                iziToast.success({
                    title: data.title,
                    message: data.msg,
                    position: "topCenter"
                });
                reloadTable(dataTable);
            } else {
                iziToast.error({
                    title: data.title,
                    message: data.msg,
                    position: "topCenter"
                });
                reloadTable(dataTable);
            }
        }, "json");
    });
    /** IsCoverSetter */

    /** Remove Button */
    $(document).on('click', '.remove-btn', function (e) {
        let url = $(this).data("url");
        let dataTable = $(this).data("table");
        swal.fire({
            title: lang.are_you_sure,
            text: lang.you_cannot_turn_back_this_process,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: lang.yes_delete_it,
            cancelButtonText: lang.no_cancel
        }).then(function (result) {
            if (result.value) {
                let formData = new FormData();
                createAjax(url, formData, function () {
                    reloadTable(dataTable);
                });
            }
        })
    });
    /** Remove Button */
});

(function ($) {
    /** Dropzone */
    if ($(".dropzone").length > 0) {
        Dropzone.autoDiscover = false;
        //;
        $('.dropzone').each(function (index) {
            let elem = "#" + $(this).attr("id");
            let $uploadSection = new Dropzone(elem);
            $uploadSection.on("complete", function (file) {
                //console.log(file);
                let dataTable = $(elem).data("table");
                reloadTable(dataTable);
            });
        });
    }
    /** Dropzone */
})(jQuery);

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

// Datatable Search
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

/** createAjax */
function createAjax(url, formData, successFnc = function () { }, errorFnc = function () { }) {
    $.ajax({
        type: "POST",
        url: url,
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "JSON"
    }).done(function (response) {
        if (response.success) {
            iziToast.success({
                title: response.title,
                message: response.message,
                position: "topCenter",
                displayMode: 'once',
            });
            successFnc(response);
            if (response.redirect !== null && response.redirect !== "" && response.redirect !== undefined) {
                setTimeout(function () {
                    window.location.href = response.redirect;
                }, 2000);
            }
        } else {
            iziToast.error({
                title: response.title,
                message: response.message,
                position: "topCenter",
                displayMode: 'once',
            });
            errorFnc(response);
            if (response.redirect !== null && response.redirect !== "" && response.redirect !== undefined) {
                setTimeout(function () {
                    window.location.href = response.redirect;
                }, 2000);
            }
        }
    });
}
/** createAjax */

/** createModal */
function createModal(modalClass = null, modalTitle = null, modalSubTitle = null, width = 600, bodyOverflow = true, padding = "20px", radius = 0, headerColor = "#e20e17", background = "#fff", zindex = 1040, onOpening = function () { }, onOpened = function () { }, onClosing = function () { }, onClosed = function () { }, afterRender = function () { }, onFullScreen = function () { }, onResize = function () { }, fullscreen = true, openFullscreen = false, closeOnEscape = true, closeButton = true, overlayClose = false, autoOpen = 0) {
    if (modalClass !== "" || modalClass !== null) {
        $(modalClass).iziModal({
            title: modalTitle,
            subtitle: modalSubTitle,
            headerColor: headerColor,
            background: background,
            width: width,
            zindex: zindex,
            fullscreen: fullscreen,
            openFullscreen: openFullscreen,
            closeOnEscape: closeOnEscape,
            closeButton: closeButton,
            overlayClose: overlayClose,
            autoOpen: autoOpen,
            padding: padding,
            bodyOverflow: bodyOverflow,
            radius: radius,
            onFullScreen: onFullScreen,
            onResize: onResize,
            onOpening: onOpening,
            onOpened: onOpened,
            onClosing: onClosing,
            onClosed: onClosed,
            afterRender: afterRender
        });
    }
    $(modalClass).iziModal('setFullscreen', false);
}
/** createModal */

/** openModal */
function openModal(modalClass = null, event = function () { }) {
    $(modalClass).iziModal('open', event);
    $(modalClass).iziModal('setFullscreen', false);
}
/** openModal */

/** closeModal */
function closeModal(modalClass = null, event = function () { }) {
    $(modalClass).iziModal('setFullscreen', false);
    $(modalClass).iziModal('close', event);
}
/** closeModal */