<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="tr">

<head>
    <?php $this->load->view("frontend/layout/partials/head") ?>
    <?php $this->load->view("frontend/layout/partials/styles") ?>
    <?php $this->load->view("frontend/layout/partials/scripts_top") ?>
</head>

<body>
    <?php $this->load->view("frontend/layout/partials/header") ?>
    <?php $this->load->view("frontend/layout/partials/footer") ?>
    <?php $this->load->view("frontend/layout/partials/scripts_bottom") ?>
</body>

</html>