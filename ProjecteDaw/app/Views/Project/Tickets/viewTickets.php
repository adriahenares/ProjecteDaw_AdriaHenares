<?php echo $this->extend('layouts/default/default'); ?>

<?php echo $this->section("main_content"); ?>
<div>
    <div>
        <h1><?= $title ?></h1>
        <img src="<?= base_url('Logo.png') ?>" alt="Logo" style="max-width: 128px">
    </div>
    <?= $output?>
    <div>
        <a class="m-1 w-50 btn btn-primary" href="<?php echo base_url('/addTickets')?>">Crear Ticket</a>
    </div>

    <?= $this->include('layouts/partials/menu') ?>
</div>
<?php echo $this->endSection(); ?>