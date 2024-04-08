<?= $this->extend('layouts/default/default'); ?>
<?= $this->section("main_content"); ?>
<div class="container-fluid p-0">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center">
                <img src="<?= base_url('Logo.png') ?>" alt="Logo" style="max-width: 128px">
                <div>
                    <h1><?= $title ?></h1>
                </div>
            </div>
        </div>
        <?= $this->include("layouts/partials/menu") ?>
        <div class="col-10">
            <?= $output ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
