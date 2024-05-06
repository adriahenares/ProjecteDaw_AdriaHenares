<style>
  #header {
    height: 110px;
    /* width:  100vw; */
  }
</style>

<?= $this->extend('layouts/mainLayout'); ?>
<?= $this->section("main_content"); ?>
<div class="row p-2 pb-0" style="">
  <div class="col-6">
    <?= $output ?>
  </div>
  <div class="col-6">
    <form action="<?= base_url("/validateStudents") ?>" method="post" class="formAdd">
      <?= csrf_field(); ?>
      <div class="form-group my-4 ">
        <label for="mail"></label>
        <input class="form-control" type="text" placeholder="email.." name="mail" id="mail">
      </div>
      <div>
        <?= session()->getFlashdata('error') ?>
      </div>
      <div class="bottom-center pe-0 ">
        <input type="submit" class="btn btn-primary m-2">
      </div>
  </div>
  </form>
</div>
</div>
<?= $this->endSection(); ?>