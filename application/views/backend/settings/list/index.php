<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="container py-5">
    <form id="filter_form" onsubmit="return false">
        <div class="d-flex flex-wrap">
            <label for="search" class="flex-fill mx-1">
                <input class="form-control form-control-sm rounded-0" placeholder="Arama Yapmak İçin Metin Girin." type="text" onkeypress="return runScript(event,'productTable')" name="search">
            </label>
            <label for="clear_button" class="mx-1">
                <button class="btn btn-sm btn-outline-danger rounded-0 " onclick="clearFilter('filter_form','productTable')" id="clear_button" data-toggle="tooltip" data-placement="top" data-title="Filtreyi Temizle" data-original-title="" title=""><i class="fa fa-eraser"></i></button>
            </label>
            <label for="search_button" class="mx-1">
                <button class="btn btn-sm btn-outline-success rounded-0 " onclick="reloadTable('productTable')" id="search_button" data-toggle="tooltip" data-placement="top" data-title="Ürün Ara"><i class="fa fa-search"></i></button>
            </label>
            <label for="delete_button" class="mx-1 toggleLabel d-none">
                <button class="btn btn-sm btn-outline-danger rounded-0 " data-url="<?= base_url("products/deleteBulk") ?>" id="delete_button" data-toggle="tooltip" data-placement="top" data-title="Seçili Ürünleri Sil"><i class="fa fa-trash"></i></button>
            </label>
        </div>
    </form>
    <div class="table-responsive">
        <table class="table table-hover table-bordered table-striped table-light product-table">
            <thead>
                <tr>
                    <th class="mw50 text-center align-middle"><i class="fa fa-list"></i></th>
                    <th class="mw50 text-center align-middle"><i class="fa fa-reorder"></i></th>
                    <th class="mw50 text-center align-middle">ID</th>
                    <th class="mw150 text-center align-middle"><?= lang("product_image") ?></th>
                    <th class="text-center align-middle"><?= lang("product_title") ?></th>
                    <th class="text-center align-middle"><?= lang("actions") ?></th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>

<script>
</script>