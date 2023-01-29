<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="container">
    <form id="createProduct" onsubmit="return false" action="<?= base_url("panel/products/save") ?>" enctype="multipart/form-data" method="POST">
        <div class="row g-3 mb-3">
            <div class="col-lg-12">
                <div class="row g-3 align-items-center align-self-center align-content-center">
                    <div class="col-4">
                        <label class="my-0 me-1 fw-semibold" for="title"><?= lang("product_title") ?> : </label>
                    </div>
                    <div class="col-8">
                        <input class="form-control" type="text" name="title" id="title" placeholder="<?= lang("product_title") ?>" required minlength="2" maxlength="255">
                    </div>
                </div>
            </div>
            <?php if (!empty($product_variations)) : ?>
                <div class="col-lg-12">
                    <div class="row g-3 align-items-center align-self-center align-content-center">
                        <div class="col-4">
                            <label class="my-0 me-1 fw-semibold" for="variations"><?= lang("product_variations") ?> : </label>
                        </div>
                        <div class="col-8 position-relative">
                            <select name="variations[]" id="variations" class="form-control tagsInput" multiple>
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
                    <div class="col-4">
                        <button class="btn btn-secondary btnSave" type="submit" data-url="<?= base_url("panel/products/save") ?>"><?= lang("save_product") ?></button>
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
            dropdownParent: $("#createProduct").find("#variations").parent(),
            placeholder: "<?= lang("choose_product_variations") ?>"
        });
    });
</script>