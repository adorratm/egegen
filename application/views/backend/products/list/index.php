<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="container py-5">
    <h4 class="mb-3">
        <?= lang("products") ?>
        <a href="javascript:void(0)" data-url="<?= base_url("panel/products/create-new-product"); ?>" class="btn btn-sm btn-outline-primary rounded-0 float-end createNewProductBtn"> <i class="fa fa-plus"></i> <?= lang("create_new_product") ?></a>
    </h4>
    <form id="filter_form" onsubmit="return false">
        <div class="d-flex flex-wrap">
            <label for="search" class="flex-fill mx-1">
                <input class="form-control form-control-sm rounded-0" placeholder="<?= lang("enter_text_to_search") ?>" type="text" onkeypress="return runScript(event,'productTable')" name="search">
            </label>
            <label for="clear_button" class="mx-1">
                <button class="btn btn-sm btn-outline-danger rounded-0 " onclick="clearFilter('filter_form','productTable')" id="clear_button" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= lang("clear_filter") ?>"><i class="fa fa-eraser"></i></button>
            </label>
            <label for="search_button" class="mx-1">
                <button class="btn btn-sm btn-outline-success rounded-0 " onclick="reloadTable('productTable')" id="search_button" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= lang("search_product") ?>"><i class="fa fa-search"></i></button>
            </label>
        </div>
    </form>
    <table class="table table-hover table-bordered table-striped table-light productTable">
        <thead>
            <tr>
                <th class="w100 text-center align-middle"><?= lang("product_id") ?></th>
                <th class="w150 text-center align-middle"><?= lang("product_image") ?></th>
                <th class="text-center align-middle"><?= lang("product_title") ?></th>
                <th class="w150 text-center align-middle"><?= lang("actions") ?></th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>

<script>
    window.addEventListener('DOMContentLoaded', function() {
        TableInitializer("productTable", obj, "<?= base_url("panel/products/datatable") ?>", true);
    });
</script>