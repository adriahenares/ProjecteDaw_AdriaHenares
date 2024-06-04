<style>
    #header {
        height: 110px;
        /* width:  100vw; */
    }

    .text-danger{
        color: red !important;
    }

</style>
<?= $this->section("title"); ?>
<title>
    <?= lang('ticketsLang.Tickets')?>
</title>
<?php echo $this->endSection(); ?>
<?= $this->extend('layouts/mainLayout'); ?>


<?= $this->section("main_content"); ?>

    <?php if ($add):?>
        <script>
            addEventListener("DOMContentLoaded", (event) => {
                let btn = document.createElement('a');
                btn.href = "<?= base_url('/addTickets') ?>";
                btn.classList.add('btn', 'btn-info');
                btn.id = 'list-btn-print';
                btn.style.marginLeft = '5px';
                btn.innerHTML = '<i class="fa-solid fa-plus"></i> <?= lang('ticketsLang.add')?>';
                let div = document.getElementsByClassName('d-flex')[0];
                div.appendChild(btn);
                document.getElementById('list-btn-exportxls').innerHTML = '<i class="fa-solid fa-file-excel" aria-hidden="true" style="margin-right: 5px"></i><?= lang('ticketsLang.export')?>';
                document.getElementById('list-btn-print').innerHTML = '<i class="fa-solid fa-print" aria-hidden="true" style="margin-right: 5px"></i><?= lang('ticketsLang.print')?>';
                //console.log(document.getElementsByClassName('dataTables_info'));
                //document.getElementsByClassName('dataTables_info')[0] = 'none';
            });
        </script>
    <?php endif ?>

    <?= $output ?>
<?= $this->endSection(); ?>