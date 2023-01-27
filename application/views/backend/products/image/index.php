<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="container py-5">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <form data-table="imageTable" action="<?= base_url("panel/products/file-upload/$item->id"); ?>" id="dropzone" class="dropzone" data-plugin="dropzone" data-options="{ url: '<?= base_url("panel/products/file-upload/$item->id"); ?>'}">
                <div class="dz-message">
                    <h3><?= lang("drag_the_files_you_want_to_upload_here") ?></h3>
                    <p class="mb-3 text-muted">(<?= lang("drag_your_files_or_click_here_to_upload") ?>)</p>
                </div>
            </form>
        </div><!-- END column -->
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <h4 class="my-3">
                "<b><?= $item->title; ?></b>" <?= lang("images") ?>
            </h4>
            <hr>
        </div><!-- END column -->
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <form id="filter_form" onsubmit="return false">
                <div class="d-flex flex-wrap">
                    <label for="search" class="flex-fill mx-1">
                        <input class="form-control form-control-sm rounded-0" placeholder="<?= lang("enter_text_to_search") ?>" type="text" onkeypress="return runScript(event,'detailTable')" name="search">
                    </label>
                    <label for="clear_button" class="mx-1">
                        <button class="btn btn-sm btn-outline-danger rounded-0 " onclick="clearFilter('filter_form','imageTable')" id="clear_button" data-toggle="tooltip" data-placement="top" data-title="<?= lang("clear_filter") ?>" data-original-title="" title=""><i class="fa fa-eraser"></i></button>
                    </label>
                    <label for="search_button" class="mx-1">
                        <button class="btn btn-sm btn-outline-success rounded-0 " onclick="reloadTable('imageTable')" id="search_button" data-toggle="tooltip" data-placement="top" data-title="<?= lang("search_product_image") ?>"><i class="fa fa-search"></i></button>
                    </label>
                </div>
            </form>
            <table class="table table-hover table-striped table-bordered content-container imageTable">
                <thead>
                    <th class="w150"><?= lang("product_image_id") ?></th>
                    <th class="w150 nosort"><?= lang("product_image") ?></th>
                    <th><?= lang("product_image_url") ?></th>
                    <th class="w175"><?= lang("product_image_cover") ?></th>
                    <th class="w75 nosort" class="nosort"><?= lang("actions") ?></th>
                </thead>
                <tbody>

                </tbody>
            </table>

        </div><!-- END column -->
    </div>
</div>

<script>
    window.addEventListener('DOMContentLoaded', function() {
        TableInitializer("imageTable", obj, "<?= base_url("panel/products/image-datatable/{$item->id}") ?>", true);
    });
</script>