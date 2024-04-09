<?= $this->extend('layouts/default/default'); ?>
<?= $this->section("main_content"); ?>
<div class="container-fluid p-0">
    <form method='post' action="<?= base_url("/assingTicket/" . $id) ?>">
    <?= csrf_field(); ?>
        <div class="row">
            <div class="col-12">
                <div class="d-flex align-items-center">
                    <img src="<?= base_url('Logo.png') ?>" alt="Logo" style="max-width: 128px">
                    <div>
                        <h1>test</h1>
                    </div>
                </div>
            </div>
            
            <?= $this->include("layouts/partials/menu") ?>

            <div class="col-10 ps-2 pe-2 pt-2">
                <div class="d-grid" style="margin-top:20px">
                    <div class="p-2">
                        <label>centre a assignar</label>
                        <div class="form-control bg-light">
                            <input type='text' name='idRepair' id="idRepair">
                        </div>
                    </div>
                </div>
                <div>
                    <div class='pt-2'><input type='submit' value='Envia'></div>
                </div>
            </div>
    </form>
</div>
<?= $this->endSection(); ?>