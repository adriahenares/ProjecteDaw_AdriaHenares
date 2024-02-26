<?php echo $this->extend('layouts/ticketsAll/tickets'); ?>

<?php echo $this->section("view"); ?>
<div>
    <div>
        <h1>GESTIO DE TICKETS</h1>
        <!--<img src="" alt=""> logo empresa -->
    </div>
    <?= $output?>
    <div>
        <a class="m-1 w-50 btn btn-primary" href="<?php echo base_url('/addTickets')?>">Crear Ticket</a>
    </div>
</div>
<?php echo $this->endSection(); ?>