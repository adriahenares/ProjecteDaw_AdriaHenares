<style>
    #header {
        height: 110px;
        /* width:  100vw; */
    }

</style>

<?= $this->extend('layouts/mainLayout'); ?>
<? // $this->extend('layouts/default/default'); ?>
<?= $this->section("main_content"); ?>

<div class="col-12 p-0">
    <div class="row" >

        <!-- <div id="header" class="col-12 p-0">
            <div class="d-flex bg-dark" >
                <div class="col-2 px-2 text-center">
                    <img src="<? base_url('Logo.png') ?>" alt="Logo" style="max-width: 90px">
                </div> 
                
                <div class="col-10 py-3">
                    <h1 class="text-white m-0 ms-2 "><? $title ?></h1>
                </div>
            </div>
        </div> -->

        <?php /*$this->include("layouts/partials/menu")*/ ?>

        <div class="col-10 px-3 pt-2">
            <div>
                <a href="<?= base_url('/addTickets') ?>" class="btn btn-primary">Assigna</a>
            </div>
            <?= $output ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
