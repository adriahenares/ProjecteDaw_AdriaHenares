<?= $this->extend('layouts/default/default'); ?>
<?= $this->section("main_content"); ?>
<div class="container-fluid p-0">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center">
                <img src="<?= base_url('Logo.png') ?>" alt="Logo" style="max-width: 128px">
                <div>
                    <h1><?= $title ?></h1>
                </div>
            </div>
        </div>
        <div class="col-md-2 p-0">
            <div class="d-flex flex-column h-100 justify-content-center">
                <div class="start text-center" tabindex="0" id="start" aria-labelledby="offcanvasLabel" style="background-color: rgb(26,26,26);">
                    <div class="header">
                        <h4 class="title text-white mb-0">MENU</h4>
                    </div>
                    <div class="body">
                        <div class="m-5">
                            <a class="text-white text-decoration-none" href="<?php echo base_url('/') ?>">Tickets</a>
                        </div>
                        <div class="m-5">
                            <a class="text-white text-decoration-none" href="<?php echo base_url('/add2fa') ?>">Inventario</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-10">
            <?= $output ?>
            <div>
                <a class="m-1 w-50 btn btn-primary" href="<?php echo base_url('/addTickets') ?>">Crear Ticket</a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
