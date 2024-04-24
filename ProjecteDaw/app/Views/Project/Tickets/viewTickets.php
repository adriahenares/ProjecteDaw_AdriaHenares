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

    <?php if ($badd):?>
        <script>
            let btn = document.createElement('a');
            btn.href = "<?= base_url('/addTickets') ?>";
            btn.classList.add(['btn', 'btn-primary']);
            btn.innerHTML = 'Afegir Ticket';
            let arr = Array.from(document.getElementsByClassName('d-flex'));
            console.log(arr);
            let div = document.getElementsByClassName('d-flex');
            console.log(div);
        </script>
        <div>
            <a href="<?= base_url('/addTickets') ?>" class="btn btn-primary">Afegir Ticket</a>
        </div>
    <?php endif ?>

    <?= $output ?>
<?= $this->endSection(); ?>