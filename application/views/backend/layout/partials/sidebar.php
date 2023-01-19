<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="d-flex flex-column flex-shrink-0 p-3 bg-light w-25">
    <a href="<?= base_url("panel") ?>" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none w-100">
        <img data-src="<?= get_picture("settings", "logo.png") ?>" alt="Egegen Job Application Task" class="img-fluid lazyload" width="100" height="75">
        <span class="fs-5 fw-bold flex-fill text-center">Egegen Job Application Task</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a rel="dofollow" title="Dashboard" href="<?= base_url("panel") ?>" class="nav-link <?= $this->uri->segment(2) == NULL || $this->uri->segment(2) == "/" ? "active" : "link-dark" ?>" aria-current="page">
                <i class="fa fa-tachometer me-3"></i>
                Dashboard
            </a>
        </li>
        <li>
            <a rel="dofollow" title="Products" href="<?= base_url("panel/products") ?>" class="nav-link <?= $this->uri->segment(2) == "products" ? "active" : "link-dark" ?>">
                <i class="fa fa-boxes-stacked me-3"></i>
                Products
            </a>
        </li>
        <li>
            <a rel="dofollow" title="Product Variations" href="<?= base_url("panel/product-variations") ?>" class="nav-link <?= $this->uri->segment(2) == "product-variations" ? "active" : "link-dark" ?>">
                <i class="fa fa-boxes-packing me-3"></i>
                Product Variations
            </a>
        </li>
        <li>
            <a rel="dofollow" title="Settings" href="<?= base_url("panel/settings") ?>" class="nav-link <?= $this->uri->segment(2) == "settings" ? "active" : "link-dark" ?>">
                <i class="fa fa-cogs me-3"></i>
                Settings
            </a>
        </li>
    </ul>
    <hr>
    <div class="dropdown">
        <a href="https://github.com/adorratm" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img data-src="https://avatars.githubusercontent.com/u/39022587" alt="Emre KILIÇ" width="32" height="32" class="rounded-circle me-2 lazyload">
            <strong>EMRE KILIÇ</strong>
        </a>
        <ul class="dropdown-menu text-small shadow">
            <li><a target="_blank" rel="nofollow" title="Github" class="dropdown-item" href="https://github.com/adorratm"><i class="fa fa-github"></i> Github</a></li>
            <li><a target="_blank" rel="nofollow" title="Linkedin" class="dropdown-item" href="https://linkedin.com/in/emrekilic98"><i class="fa fa-linkedin"></i> Linkedin</a></li>
            <li><a target="_blank" rel="nofollow" title="Instagram" class="dropdown-item" href="https://instagram.com/adorratm"><i class="fa fa-instagram"></i> Instagram</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a target="_blank" rel="nofollow" title="Egegen" class="dropdown-item" href="https://egegen.com"><img data-src="<?= get_picture("settings", "logo.png") ?>" width="14" height="16" class="img-fluid lazyload"> Egegen</a></li>
        </ul>
    </div>
</div>