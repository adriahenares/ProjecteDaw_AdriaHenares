<?= $this->extend('layouts/mainLayout'); ?>

<?= $this->section("main_content"); ?>
<!-- 
<div>
    <img src="<? base_url('images/alert.jpg') ?>" style="width: 100px;" />

    <h1><? lang('ticketsLang.confirm')?></h1>

    <a class="btn btn-danger" style="text-decoration: none;" href="<? base_url('delTicket/' . $id) ?>">Sí, eliminar</a>
    <a class="btn btn-primari" style="text-decoration: none;"  href="<? base_url('viewTickets') ?>">Cancelar</a>
</div> -->


<div class="container">
  <div class="row justify-content-center align-items-center text-center mt-4">
    <img src="<?= base_url('images/alert.jpg') ?>" style="width: 300px;" class="img-fluid" />
    <h1 class="my-5"><?= lang('ticketsLang.confirm')?></h1>
    <div class="row justify-content-center align-items-center text-center">
        <a class="btn btn-danger me-5" style="width: 200px;" href="<?= base_url('delTicket/' . $id) ?>"><?= lang('ticketsLang.accept')?></a>
        <a class="btn btn-primary " style="width: 200px;" href="<?= base_url('viewTickets') ?>"><?= lang('ticketsLang.cancel')?></a>
    </div>
  </div>
</div>


<?= $this->endSection(); ?>

