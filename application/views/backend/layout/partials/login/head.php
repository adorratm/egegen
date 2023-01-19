<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>



<!-- Title -->
<title><?= (!empty($meta_title) ? stripslashes($meta_title) : (!empty($og_title) ? stripslashes($og_title) : $settings->project_title)) ?></title>
<!-- Title -->

<!-- Meta Data -->
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, user-scalable=yes, shrink-to-fit=no,minimal-ui">
<meta name="description" content="<?= clean(@$meta_desc) ?>">
<meta name="subject" content="<?= clean(@$meta_desc) ?>">
<meta name="copyright" content="https://github.com/adorratm">
<meta name="language" content="TR">
<meta name="robots" content="all" />
<meta name="revised" content="<?= turkishDate("d F Y, l H:i:s", date("Y-m-d H:i:s")) ?>" />
<meta name="abstract" content="<?= clean(@$meta_desc) ?>">
<meta name="topic" content="<?= clean(@$meta_desc) ?>">
<meta name="summary" content="<?= clean(@$meta_desc) ?>">
<meta name="Classification" content="Business">
<meta name="author" content="Emre KILIÇ, emrekilic19983@gmail.com">
<meta name="designer" content="Emre KILIÇ, emrekilic19983@gmail.com">
<meta name="copyright" content="Emre KILIÇ, emrekilic19983@gmail.com 2023 &copy; Tüm Hakları Saklıdır.">
<meta name="reply-to" content="emrekilic19983@gmail.com">
<meta name="owner" content="Emre KILIÇ, emrekilic19983@gmail.com">
<meta name="url" content="<?= clean(base_url()) ?>">
<meta name="identifier-URL" content="<?= clean(base_url()) ?>">
<meta name="directory" content="submission">
<meta name="category" content="Article">
<meta name="coverage" content="Worldwide">
<meta name="distribution" content="Global">
<meta name="rating" content="General">
<meta name="revisit-after" content="1 days">
<meta property="og:image:secure" content="<?= clean(@$og_image) ?>">
<meta property="og:locale" content="tr_TR">
<meta property="og:url" content="<?= (!empty($og_url) ? clean($og_url) : clean(base_url())) ?>" />
<meta property="og:type" content="<?= (!empty($og_type) ? clean($og_type) : "website") ?>" />
<meta property="og:title" content="<?= (!empty($meta_title) ? stripslashes($meta_title) : (!empty($og_title) ? stripslashes($og_title) : $settings->project_title)) ?>" />
<meta property="og:description" content="<?= (!empty($og_description) ? clean($og_description) : clean(@$meta_desc)) ?>" />
<meta property="og:image" content="<?= !empty($og_image) ? clean(@$og_image) : get_picture("settings", $settings->img_url); ?>" />
<meta property="og:image:secure_url" content="<?= clean(@$og_image) ?>" />
<meta name="twitter:title" content="<?= (!empty($meta_title) ? stripslashes($meta_title) : (!empty($og_title) ? stripslashes($og_title) : $settings->project_title)) ?>">
<meta name="twitter:description" content="<?= (!empty($og_description) ? clean($og_description) : clean(@$meta_desc)) ?>">
<meta name="twitter:image" content="<?= clean(@$og_image) ?>">
<meta name="twitter:card" content="summary_large_image">
<meta property="og:site_name" content="<?= (!empty($meta_title) ? stripslashes($meta_title) : (!empty($og_title) ? stripslashes($og_title) : $settings->project_title)) ?>">
<meta name="twitter:image:alt" content="<?= (!empty($meta_title) ? stripslashes($meta_title) : (!empty($og_title) ? stripslashes($og_title) : $settings->project_title)) ?>">
<meta name="googlebot" content="archive,follow,imageindex,index,odp,snippet,translate">
<meta name="publisher" content="Emre KILIÇ, emrekilic19983@gmail.com" />
<link rel="canonical" href="<?= (!empty($og_url) ? clean($og_url) : clean(base_url())) ?>" />
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-control" content="no-cache">
<meta http-equiv="Expires" content="0">
<link rel="preconnect" href="<?= base_url() ?>">
<link rel="dns-prefetch" href="<?= base_url() ?>">
<!-- Favicon -->
<link rel="shortcut icon" sizes="32x32" href="<?= get_picture("settings", $settings->img_url); ?>" type="<?= @image_type_to_mime_type(@exif_imagetype(get_picture("settings", $settings->img_url))) ?>">
<link rel="icon" sizes="32x32" href="<?= get_picture("settings", $settings->img_url); ?>" type="<?= @image_type_to_mime_type(@exif_imagetype(get_picture("settings", $settings->img_url))) ?>">
<link rel="apple-touch-icon" sizes="32x32" href="<?= get_picture("settings", $settings->img_url); ?>" type="<?= @image_type_to_mime_type(@exif_imagetype(get_picture("settings", $settings->img_url))) ?>">
<!-- META TAGS -->