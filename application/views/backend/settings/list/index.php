<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="container py-5">
    <h4 class="mb-3">
        <?= lang("settings") ?>
    </h4>
    <form id="filter_form" onsubmit="return false">
        <div class="d-flex flex-wrap">
            <label for="search" class="flex-fill mx-1">
                <input class="form-control form-control-sm rounded-0" placeholder="<?= lang("enter_text_to_search") ?>" type="text" onkeypress="return runScript(event,'settingsTable')" name="search">
            </label>
            <label for="clear_button" class="mx-1">
                <button class="btn btn-sm btn-outline-danger rounded-0 " onclick="clearFilter('filter_form','settingsTable')" id="clear_button" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= lang("clear_filter") ?>"><i class="fa fa-eraser"></i></button>
            </label>
            <label for="search_button" class="mx-1">
                <button class="btn btn-sm btn-outline-success rounded-0 " onclick="reloadTable('settingsTable')" id="search_button" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= lang("search_settings") ?>"><i class="fa fa-search"></i></button>
            </label>
        </div>
    </form>
    <table class="table table-hover table-bordered table-striped table-light w-100 settingsTable">
        <thead>
            <tr>
                <th class="w175 text-center align-middle"><?= lang("settings_id") ?></th>
                <th class="text-center align-middle"><?= lang("project_title") ?></th>
                <th class="w75 text-center align-middle nosort"><?= lang("actions") ?></th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>

<div id="settingsModal"></div>

<script>
    window.addEventListener('DOMContentLoaded', function() {
        TableInitializer("settingsTable", obj, "<?= base_url("panel/settings/datatable") ?>", true);
        $(document).on("click", ".updateSettingsBtn", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            $('#settingsModal').iziModal('destroy');
            let url = $(this).data("url");
            createModal("#settingsModal", "<?= lang("edit_settings") ?>", "<?= lang("edit_settings") ?>", 600, true, "20px", 0, "#495057", "#fff", 1040, function() {
                $.post(url, {}, function(response) {
                    $("#settingsModal .iziModal-content").html(response);
                });
            });
            openModal("#settingsModal");
            $("#settingsModal").iziModal("setFullscreen", false);
        });
        $(document).on("click", ".btnUpdate", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            let url = $(this).data("url");
            let formData = new FormData(document.getElementById("updateSettings"));
            createAjax(url, formData, function() {
                closeModal("#settingsModal");
                $("#settingsModal").iziModal("setFullscreen", false);
                reloadTable("settingsTable");
            });
        });
        $(document).on("click", ".btnDeleteImage", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            let url = $(this).data("url");
            let formData = new FormData();
            createAjax(url, formData, function() {
                closeModal("#settingsModal");
                $("#settingsModal").iziModal("setFullscreen", false);
                reloadTable("settingsTable");
            });
        });
    });
</script>