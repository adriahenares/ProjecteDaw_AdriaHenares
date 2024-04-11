<style>
  #header {
    height: 110px;
    /* width:  100vw; */
  }
</style>

<?= $this->extend('layouts/default/default'); ?>
<?= $this->section("main_content"); ?>

<?= $output ?>
<?= $this->endSection(); ?>