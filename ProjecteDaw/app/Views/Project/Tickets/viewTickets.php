<?php echo $this->extend('layouts/default/default'); ?>

<?php echo $this->section("main_content"); ?>
<div>
    <div>
        <h1>GESTIO DE TICKETS</h1>
        <!--<img src="" alt=""> logo empresa -->
    </div>
    <?= $output?>
    <div>
        <a class="m-1 w-50 btn btn-primary" href="<?php echo base_url('/addTickets')?>">Crear Ticket</a>
    </div>

    <?= $this->include('layouts/partials/menu') ?>
</div>
<?php echo $this->endSection(); ?>