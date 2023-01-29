<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!-- Lazysizes -->
<script async defer src="<?= base_url("public/js/global/lazysizes.min.js") ?>"></script>
<!-- #Lazysizes -->

<!-- Jquery -->
<script src="<?= base_url("public/js/global/jquery.min.js") ?>"></script>
<!-- #Jquery -->

<!-- Bootstrap -->
<script defer src="<?= base_url("public/js/global/bootstrap.bundle.min.js") ?>"></script>
<!-- #Bootstrap -->

<!-- iziToast -->
<script defer src="<?= base_url("public/js/global/iziToast.min.js") ?>"></script>
<!-- #iziToast -->

<!-- iziModal -->
<script defer src="<?= base_url("public/js/global/iziModal.min.js") ?>"></script>
<!-- #iziModal -->

<!-- Sweetalert2 -->
<script defer src="<?= base_url("public/js/global/sweetalert2.all.min.js") ?>"></script>
<!-- #Sweetalert2 -->

<!-- DataTables -->
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script defer src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.1/af-2.5.1/b-2.3.3/b-colvis-2.3.3/b-html5-2.3.3/b-print-2.3.3/cr-1.6.1/date-1.2.0/fc-4.2.1/fh-3.3.1/kt-2.8.0/r-2.4.0/rg-1.3.0/rr-1.3.1/sc-2.0.7/sb-1.4.0/sp-2.1.0/sl-1.5.0/sr-1.2.0/datatables.min.js"></script>
<!-- #DataTables -->

<!-- Select2 -->
<script defer src="<?= base_url("public/js/backend/select2.full.min.js") ?>"></script>
<!-- #Select2 -->

<!-- Dropzone -->
<script defer src="<?= base_url("public/js/backend/dropzone.min.js") ?>"></script>
<!-- #Dropzone -->

<script>
    const lang = {
        "are_you_sure": "<?= lang("are_you_sure") ?>",
        "you_cannot_turn_back_this_process": "<?= lang("you_cannot_turn_back_this_process") ?>",
        "yes_delete_it": "<?= lang("yes_delete_it") ?>",
        "no_cancel": "<?= lang("no_cancel") ?>",

    };
</script>

<!-- Custom JS -->
<script defer src="<?= base_url("public/js/backend/scripts.js") ?>"></script>
<!-- #Custom JS -->