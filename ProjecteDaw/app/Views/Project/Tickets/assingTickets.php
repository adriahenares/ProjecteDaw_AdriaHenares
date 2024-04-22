<style>
    #header {
        height: 110px;
        width: 100vw;
    }
</style>

<?= $this->extend('layouts/mainLayout'); ?>

<?= $this->section("main_content"); ?>

<div>
    <a href="<?= base_url('/assingTicket') ?>" class="btn btn-primary">Assigna</a>
</div>
<?= $output ?>
<?= $this->endSection(); ?>