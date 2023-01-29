<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="container">
    <form id="createProductVariation" onsubmit="return false" action="<?= base_url("panel/product-variations/save") ?>" enctype="multipart/form-data" method="POST">
        <div class="row g-3 mb-3">
            <div class="col-lg-12">
                <div class="row g-3 align-items-center align-self-center align-content-center">
                    <div class="col-5">
                        <label class="my-0 me-1 fw-semibold" for="title"><?= lang("product_variation_title") ?> : </label>
                    </div>
                    <div class="col-7">
                        <input class="form-control" type="text" name="title" id="title" placeholder="<?= lang("product_variation_title") ?>" required minlength="2" maxlength="255">
                    </div>
                </div>
            </div>
            <?php if (!empty($product_variations)) : ?>
                <div class="col-lg-12">
                    <div class="row g-3 align-items-center align-self-center align-content-center">
                        <div class="col-5">
                            <label class="my-0 me-1 fw-semibold" for="childs"><?= lang("product_variation_subs") ?> : </label>
                        </div>
                        <div class="col-7 position-relative">
                            <select name="childs[]" id="childs" class="form-control tagsInput" multiple>
                                <?php foreach ($product_variations as $key => $value) : ?>
                                    <option value="<?= $value->id ?>"><?= $value->title ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            <?php endif ?>
            <div class="col-lg-12">
                <div class="row g-3 align-items-center align-self-center align-content-center">
                    <div class="col-5">
                        <button class="btn btn-secondary btnSave" type="submit" data-url="<?= base_url("panel/product-variations/save") ?>"><?= lang("save_product_variation") ?></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(function() {
        $(".tagsInput").select2({
            allowClear:true,
            width: 'resolve',
            theme: "classic",
            tags: false,
            tokenSeparators: [',', ' '],
            dropdownParent: $("#createProductVariation").find("#childs").parent(),
            placeholder: "<?= lang("choose_product_variation_subs") ?>"
        });
    });
</script>