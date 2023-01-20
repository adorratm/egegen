<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<nav class="navbar navbar-expand-xl sticky-top navbar-dark bg-dark">
    <div class="container-fluid">
        <a rel="dofollow" class="navbar-brand" href="<?= base_url("panel") ?>">
            <img loading="lazy" data-src="<?= get_picture("settings", $settings->img_url) ?>" alt="<?= $settings->project_title ?>" class="img-fluid lazyload" width="100" height="75">
            <span class="fs-5 fw-bold flex-fill text-center d-none d-sm-inline"><?= $settings->project_title ?></span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mx-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a rel="dofollow" title="<?= lang("dashboard") ?>" href="<?= base_url("panel") ?>" class="nav-link <?= $this->uri->segment(2) == NULL || $this->uri->segment(2) == "/" ? "active" : null ?>" aria-current="page">
                        <i class="fa fa-tachometer me-3"></i>
                        <?= lang("dashboard") ?>
                    </a>
                </li>
                <li>
                    <a rel="dofollow" title="<?= lang("products") ?>" href="<?= base_url("panel/products") ?>" class="nav-link <?= $this->uri->segment(2) == "products" ? "active" : null ?>">
                        <i class="fa fa-boxes-stacked me-3"></i>
                        <?= lang("products") ?>
                    </a>
                </li>
                <li>
                    <a rel="dofollow" title="<?= lang("product_variations") ?>" href="<?= base_url("panel/product-variations") ?>" class="nav-link <?= $this->uri->segment(2) == "product-variations" ? "active" : null ?>">
                        <i class="fa fa-boxes-packing me-3"></i>
                        <?= lang("product_variations") ?>
                    </a>
                </li>
                <li>
                    <a rel="dofollow" title="<?= lang("settings") ?>" href="<?= base_url("panel/settings") ?>" class="nav-link <?= $this->uri->segment(2) == "settings" ? "active" : null ?>">
                        <i class="fa fa-cogs me-3"></i>
                        <?= lang("settings") ?>
                    </a>
                </li>
            </ul>
            <div class="dropdown">
                <a href="https://github.com/adorratm" class="d-flex align-items-center link-light text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <img loading="lazy" data-src="https://avatars.githubusercontent.com/u/39022587" alt="<?= get_active_user()->first_name ?> <?= get_active_user()->last_name ?>" width="32" height="32" class="rounded-circle me-2 lazyload">
                    <strong><?= get_active_user()->first_name ?> <?= get_active_user()->last_name ?></strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-lg-end text-small shadow">
                    <li><a rel="dofollow" title="<?= lang("profile") ?>" class="dropdown-item" href="<?= base_url("panel/profile/" . get_active_user()->id) ?>"><i class="fa fa-user"></i> <?= lang("profile") ?></a></li>
                    <li><a rel="dofollow" title="<?= lang("logout") ?>" class="dropdown-item" href="<?= base_url("panel/logout") ?>"><i class="fa fa-power-off"></i> <?= lang("logout") ?></a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a target="_blank" rel="nofollow" title="<?= lang("github") ?>" class="dropdown-item" href="https://github.com/adorratm"><i class="fa fa-github"></i> <?= lang("github") ?></a></li>
                    <li><a target="_blank" rel="nofollow" title="<?= lang("linkedin") ?>" class="dropdown-item" href="https://linkedin.com/in/emrekilic98"><i class="fa fa-linkedin"></i> <?= lang("linkedin") ?></a></li>
                    <li><a target="_blank" rel="nofollow" title="<?= lang("instagram") ?>" class="dropdown-item" href="https://instagram.com/adorratm"><i class="fa fa-instagram"></i> <?= lang("instagram") ?></a></li>
                    <li><a target="_blank" rel="nofollow" title="<?= $settings->company_name ?>" class="dropdown-item" href="<?= $settings->company_url ?>"><img loading="lazy" data-src="<?= get_picture("settings", $settings->img_url) ?>" width="14" height="16" class="img-fluid lazyload"> <?= $settings->company_name ?></a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>