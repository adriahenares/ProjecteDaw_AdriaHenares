<style>
  #header {
    height: 110px;
    /* width:  100vw; */
  }
</style>

<?= $this->extend('layouts/mainLayout'); ?>
<?= $this->section("main_content"); ?>

<?= $output ?>
<form action="<?= base_url("/validateStudents") ?>" method="post">
  <?= csrf_field(); ?>
  <div class="form-group">
    <label for="mail"></label>
    <input class="form-control" type="text" placeholder="email.." name="mail" id="mail">
    <div>
      <input type="submit" class="btn btn-primary">
      <div>
        <?= session()->getFlashdata('error') ?>
      </div>
    </div>
  </div>
</form>

<?= $this->endSection(); ?>