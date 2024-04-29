<style>
    #header {
        height: 110px;
        /* width: 100vw; */
    }
</style>

<?= $this->extend('layouts/mainLayout'); ?>

<?= $this->section("main_content"); ?>

<div class="container-fluid mt-3">
    <div id="assign" class="border">

        <div>
            <h3 class="titleForm mt-0">Assigna Ticket</h3>
        </div>

        <form method='post' class="formAdd p-2 pb-0" action="<?= base_url("/assignTicket/" . $id) ?>">
            <?= csrf_field() ?>

            <div class="row ">

                <div class="col-12 px-4 mt-4">
                    <label for="device" class=" bold fs-5 mb-3 ps-1">Centre Reparador</label>
                </div>

                <div class="form-group col-12 px-4 mb-5 mt-2 ">
                    <select class="form-control  form-select" name='idRepair' id="idRepair">
                        <?php
                        echo "<option value=''  default hidden>Escull centre...</option>";
                        foreach ($centerId as $value) {
                            echo "<option value='" . $value['center_id'] . "'>" . $value['name'] . "</option>";
                        }
                        ?>
                    </select>

                </div>

                <div class=" col-12 bottom-center pe-0 ">
                    <!-- <div class='pt-2'><input type='submit' value='Envia'></div> -->
                    <button type="submit" class="btn btn-primary bold">Guardar</button>
                    <a href="<?= base_url("/viewTickets") ?>" class="btn btn-light btn-block  ">Cancelar</a>
                </div>

            </div>

        </form>
    </div>
</div>

<?= $this->endSection(); ?>

<script>
    $(document).ready(function() {
        $('select').selectize({
            sortField: 'text'
        });
    });
</script>