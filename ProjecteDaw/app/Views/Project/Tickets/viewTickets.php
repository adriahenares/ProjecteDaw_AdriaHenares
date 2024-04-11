<style>
    #header {
        height: 110px;
        /* width:  100vw; */
    }

</style>

<?= $this->extend('layouts/mainLayout'); ?>
<? // $this->extend('layouts/default/default'); ?>
<?= $this->section("main_content"); ?>

<!-- <div class="col-12 p-0"> -->
    <!-- <div class="row" > -->
        <!-- <div class=" px-3 pt-2"> -->
            <!-- <div>
                <a href="<?php //echo base_url('/addTickets') ?>" class="btn btn-primary">Assigna</a>
            </div> -->
            <?php echo $output ?>
        <!-- </div> -->
    <!-- </div> -->
<!-- </div> -->
<?= $this->endSection(); ?>
