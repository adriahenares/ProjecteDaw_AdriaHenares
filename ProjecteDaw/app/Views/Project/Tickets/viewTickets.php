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
            addEventListener("DOMContentLoaded", (event) => {
                let btn = document.createElement('a');
                btn.href = "<?= base_url('/addTickets') ?>";
                btn.classList.add('btn', 'btn-info');
                btn.id = 'list-btn-print';
                btn.style.marginLeft = '5px';
                btn.innerHTML = '<i class="fa-solid fa-plus"></i> Afegir';
                let div = document.getElementsByClassName('d-flex')[0];
                div.appendChild(btn);
                // document.getElementById('data-list-tickets_info').style.display = 'none';
            });
        </script>
    <?php endif ?>

    <?= $output ?>
<?= $this->endSection(); ?>