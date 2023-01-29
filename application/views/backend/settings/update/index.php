<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="container">
    <form id="updateSettings" onsubmit="return false" action="<?= base_url("panel/settings/update/$item->id") ?>" enctype="multipart/form-data" method="POST">
        <div class="row g-3 mb-3">
            <div class="col-lg-12">
                <div class="row g-3 align-items-center align-self-center align-content-center">
                    <div class="col-4">
                        <label class="my-0 me-1 fw-semibold" for="project_title"><?= lang("project_title") ?> : </label>
                    </div>
                    <div class="col-8">
                        <input class="form-control" type="text" name="project_title" id="project_title" placeholder="<?= lang("project_title") ?>" value="<?= $item->project_title ?>" required minlength="2" maxlength="255">
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="row g-3 align-items-center align-self-center align-content-center">
                    <div class="col-4">
                        <label class="my-0 me-1 fw-semibold" for="company_name"><?= lang("company_name") ?> : </label>
                    </div>
                    <div class="col-8">
                        <input class="form-control" type="text" name="company_name" id="company_name" placeholder="<?= lang("company_name") ?>" value="<?= $item->company_name ?>" required minlength="2" maxlength="255">
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="row g-3 align-items-center align-self-center align-content-center">
                    <div class="col-4">
                        <label class="my-0 me-1 fw-semibold" for="company_url"><?= lang("company_url") ?> : </label>
                    </div>
                    <div class="col-8">
                        <input class="form-control" type="text" name="company_url" id="company_url" placeholder="<?= lang("company_url") ?>" value="<?= $item->company_url ?>" required minlength="2" maxlength="255">
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="row g-3 align-items-center align-self-center align-content-center">
                    <div class="col-4">
                        <label class="my-0 me-1 fw-semibold" for="img_url"><?= lang("img_url") ?> : </label>
                    </div>
                    <div class="col-8">
                        <div class="row align-items-center align-self-center align-content-center">
                            <div class="col-4">
                                <img data-src="<?= get_picture("settings", $item->img_url) ?>" alt="<?= lang("img_url") ?>" class="img-fluid lazyload">
                                <button type="button" class="btn btn-danger w-100 d-block mt-2 btnDeleteImage" data-url="<?= base_url("panel/settings/delete-image/$item->id") ?>"><i class="fa fa-trash"></i></button>
                            </div>
                            <div class="col-8">
                                <input class="form-control" type="file" name="img_url" id="img_url" placeholder="<?= lang("img_url") ?>">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="row g-3 align-items-center align-self-center align-content-center">
                    <div class="col-4">
                        <button class="btn btn-secondary btnUpdate" type="submit" data-url="<?= base_url("panel/settings/update/$item->id") ?>"><?= lang("update_settings") ?></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>