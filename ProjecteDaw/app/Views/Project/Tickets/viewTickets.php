<style>
    #header {
        height: 110px;
        /* width:  100vw; */
    }
</style>

<?= $this->extend('layouts/mainLayout'); ?>

<?= $this->section("main_content"); ?>

<!-- <div class="col-10 px-3 pt-2"> -->
    <div>
        <a href="<?= base_url('/addTickets') ?>" class="btn btn-primary">Afegir Ticket</a>
    </div>
    <?= $output ?>
<!-- </div> -->

<?= $this->endSection(); ?>