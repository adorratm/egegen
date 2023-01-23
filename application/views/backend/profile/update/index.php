<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="container py-5">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h4><?= lang("update_profile"); ?></h4>
            </div>
        </div>
        <div class="card-body">
            <form action="<?= base_url("panel/update-profile/$user->id") ?>" method="POST" enctype="multipart/form-data">
                <div class="row g-3 mb-3">
                    <div class="col-lg-4">
                        <div class="row g-3 align-items-center align-self-center align-content-center">
                            <div class="col-4">
                                <label class="my-0 me-1 fw-semibold" for="first_name"><?= lang("first_name") ?> : </label>
                            </div>
                            <div class="col-8">
                                <input class="form-control" type="text" name="first_name" id="first_name" placeholder="<?= lang("first_name") ?>" value="<?= $user->first_name; ?>" required minlength="2" maxlength="70">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="row g-3 align-items-center align-self-center align-content-center">
                            <div class="col-4">
                                <label class="my-0 me-1 fw-semibold" for="last_name"><?= lang("last_name") ?> : </label>
                            </div>
                            <div class="col-8">
                                <input class="form-control" type="text" name="last_name" id="last_name" placeholder="<?= lang("last_name") ?>" value="<?= $user->last_name; ?>" required minlength="2" maxlength="70">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-lg-4">
                        <div class="row g-3 align-items-center align-self-center align-content-center">
                            <div class="col-4">
                                <label class="my-0 me-1 fw-semibold" for="email"><?= lang("email") ?> : </label>
                            </div>
                            <div class="col-8">
                                <input class="form-control" type="text" name="email" id="email" placeholder="<?= lang("email") ?>" value="<?= $user->email; ?>" required minlength="2" maxlength="255">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="row g-3 align-items-center align-self-center align-content-center">
                            <div class="col-4">
                                <label class="my-0 me-1 fw-semibold" for="password"><?= lang("password") ?> : </label>
                            </div>
                            <div class="col-8">
                                <input class="form-control" type="text" name="password" id="password" placeholder="<?= lang("password") ?>" minlength="6" maxlength="255">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-lg-4">
                        <button type="submit" class="btn btn-primary"><?= lang("update_profile"); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>