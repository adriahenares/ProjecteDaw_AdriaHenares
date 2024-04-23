<style>
    #header {
        height: 110px;
        /* width:  100vw; */
    }

    .text-danger{
        color: red !important;
    }

</style>

<?= $this->extend('layouts/mainLayout'); ?>


<?= $this->section("main_content"); ?>

    <?php  use function App\Controllers\bAdd;?>

    <?php if ($badd):?>
        <div>
            <a href="<?= base_url('/addTickets') ?>" class="btn btn-primary">Afegir Ticket</a>
        </div>
    <?php endif ?>

    <?= $output ?>
<?= $this->endSection(); ?>