<style>
    #header {
        height: 110px;
        width:  100vw;
    }

</style>

<?= $this->extend('layouts/mainLayout'); ?>

<?= $this->section("main_content"); ?>
    <?= $output ?>
<?= $this->endSection(); ?>
