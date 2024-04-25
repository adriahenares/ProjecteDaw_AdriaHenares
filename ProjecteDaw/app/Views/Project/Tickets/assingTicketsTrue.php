<style>
    #header {
        height: 110px;
        width: 100vw;
    }
</style>

<?= $this->extend('layouts/mainLayout'); ?>

<?= $this->section("main_content"); ?>

<form method='post' action="<?= base_url("/assingTicket/" . $id) ?>">
    <?= csrf_field() ?>

    <div>
        <h1>Assigna Ticket</h1>
    </div>

    <div class="col-10 ps-2 pe-2 pt-2">
        <div class="d-grid" style="margin-top:20px">
            <div class="p-2">
                <label>centre a assignar</label>
                <div class="form-control bg-light">
                    <select type='text' name='idRepair' id="idRepair">
                        <?php
                            foreach ($centerId as $value) {
                                echo "<option value='" . $value['center_id'] . "'>" . $value['name'] . "</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div>
            <div class='pt-2'><input type='submit' value='Envia'></div>
        </div>
    </div>
</form>

<?= $this->endSection(); ?>