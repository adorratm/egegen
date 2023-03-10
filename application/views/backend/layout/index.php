<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="tr">

<head>
    <?php $this->load->view("backend/layout/partials/head") ?>
    <?php $this->load->view("backend/layout/partials/styles") ?>
    <?php $this->load->view("backend/layout/partials/scripts_top") ?>
</head>

<body>
    <?php $this->load->view("backend/layout/partials/header") ?>

    <?php $this->load->view("backend/{$viewFolder}/{$subViewFolder}/index"); ?>
    <?php $this->load->view("backend/layout/partials/footer") ?>
    <?php $this->load->view("backend/layout/partials/scripts_bottom") ?>
    <?php $this->load->view("backend/layout/partials/alert") ?>
</body>

</html>