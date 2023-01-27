<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="container py-5">
    <h4 class="mb-3">
        <?= lang("product_variations") ?>
        <a href="javascript:void(0)" data-url="<?= base_url("panel/product-variations/create-new-product-variation"); ?>" class="btn btn-sm btn-outline-primary rounded-0 float-end createNewProductVariationBtn"> <i class="fa fa-plus"></i> <?= lang("create_new_product_variation") ?></a>
    </h4>
    <form id="filter_form" onsubmit="return false">
        <div class="d-flex flex-wrap">
            <label for="search" class="flex-fill mx-1">
                <input class="form-control form-control-sm rounded-0" placeholder="<?= lang("enter_text_to_search") ?>" type="text" onkeypress="return runScript(event,'productVariationTable')" name="search">
            </label>
            <label for="clear_button" class="mx-1">
                <button class="btn btn-sm btn-outline-danger rounded-0 " onclick="clearFilter('filter_form','productVariationTable')" id="clear_button" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= lang("clear_filter") ?>"><i class="fa fa-eraser"></i></button>
            </label>
            <label for="search_button" class="mx-1">
                <button class="btn btn-sm btn-outline-success rounded-0 " onclick="reloadTable('productVariationTable')" id="search_button" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= lang("search_product_variation") ?>"><i class="fa fa-search"></i></button>
            </label>
        </div>
    </form>
    <table class="table table-hover table-bordered table-striped table-light w-100 productVariationTable">
        <thead>
            <tr>
                <th class="w175 text-center align-middle"><?= lang("product_variation_id") ?></th>
                <th class="text-center align-middle"><?= lang("product_variation_title") ?></th>
                <th class="w75 text-center align-middle nosort"><?= lang("actions") ?></th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>

<div id="productVariationsModal"></div>

<script>
    window.addEventListener('DOMContentLoaded', function() {
        TableInitializer("productVariationTable", obj, "<?= base_url("panel/product-variations/datatable") ?>", true);

        $(document).on("click", ".createNewProductVariationBtn", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            let url = $(this).data("url");
            $('#productVariationsModal').iziModal('destroy');
            createModal("#productVariationsModal", "<?= lang("create_new_product_variation") ?>", "<?= lang("create_new_product_variation") ?>", 600, true, "20px", 0, "#495057", "#fff", 1040, function() {
                $.post(url, {}, function(response) {
                    $("#productVariationsModal .iziModal-content").html(response);
                });
            });
            openModal("#productVariationsModal");
            $("#productVariationsModal").iziModal("setFullscreen", false);
        });
        $(document).on("click", ".btnSave", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            let url = $(this).data("url");
            let formData = new FormData(document.getElementById("createProductVariation"));
            createAjax(url, formData, function() {
                closeModal("#productVariationsModal");
                $("#productVariationsModal").iziModal("setFullscreen", false);
                reloadTable("productVariationTable");
            });
        });
        $(document).on("click", ".updateProductVariationBtn", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            $('#productVariationsModal').iziModal('destroy');
            let url = $(this).data("url");
            createModal("#productVariationsModal", "<?= lang("edit_product_variation") ?>", "<?= lang("edit_product_variation") ?>", 600, true, "20px", 0, "#495057", "#fff", 1040, function() {
                $.post(url, {}, function(response) {
                    $("#productVariationsModal .iziModal-content").html(response);
                });
            });
            openModal("#productVariationsModal");
            $("#productVariationsModal").iziModal("setFullscreen", false);
        });
        $(document).on("click", ".btnUpdate", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            let url = $(this).data("url");
            let formData = new FormData(document.getElementById("updateProductVariation"));
            createAjax(url, formData, function() {
                closeModal("#productVariationsModal");
                $("#productVariationsModal").iziModal("setFullscreen", false);
                reloadTable("productVariationTable");
            });
        });
    });
</script>