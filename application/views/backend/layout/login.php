<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="tr">

<head>
    <?php $this->load->view("backend/layout/partials/login/head") ?>
    <?php $this->load->view("backend/layout/partials/login/styles") ?>
    <?php $this->load->view("backend/layout/partials/login/scripts_top") ?>
</head>

<body>
    <section class="ftco-section vh-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section"><?= $settings->project_title ?></h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <div class="wrap">
                        <div class="img" style="background-image: url(<?= get_picture("settings", $settings->img_url) ?>);background-size:contain"></div>
                        <div class="login-wrap p-4 p-md-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4"><?= lang("login") ?></h3>
                                </div>
                                <div class="w-100">
                                    <p class="social-media d-flex justify-content-end">
                                        <a target="_blank" rel="nofollow" title="Github" href="https://github.com/adorratm" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-github"></span></a>
                                        <a target="_blank" rel="nofollow" title="Linkedin" href="https://linkedin.com/in/emrekilic98" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-linkedin"></span></a>
                                        <a target="_blank" rel="nofollow" title="Instagram" href="https://instagram.com/adorratm" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-instagram"></span></a>
                                    </p>
                                </div>
                            </div>
                            <form action="<?= base_url("panel/do-login") ?>" method="POST" class="signin-form" enctype="multipart/form-data">
                                <div class="form-group mt-3">
                                    <input name="email" id="email" type="email" class="form-control" placeholder="<?= lang("email") ?>" required>
                                    <label class="form-control-placeholder" for="email"><?= lang("email") ?></label>
                                </div>
                                <div class="form-group">
                                    <input name="password" id="password" type="password" class="form-control" placeholder="<?= lang("password") ?>" required>
                                    <label class="form-control-placeholder" for="password"><?= lang("password") ?></label>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary rounded submit px-3"><?= lang("login") ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php $this->load->view("backend/layout/partials/login/scripts_bottom") ?>
    <?php $this->load->view("backend/layout/partials/alert") ?>
</body>

</html>