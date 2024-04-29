<?php
$this->extend('layouts/mainLayout');

echo $this->section("main_content");
?>



<div class="container-fluid mt-3">
    <div id="centres" class="border">

        <div>
            <h3 class="titleForm mt-0"> Afegir Ticket </h3>
        </div>

        <form action="<?php base_url("/addTickets") ?>" method="POST" class="formAdd p-2 pb-0">

            <?= csrf_field() ?>

            <div class="row ">
                <div class="form-group col-6 my-4 ">
                    <label for="description" class=" bold fs-5">Descripció </label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="3"></textarea>
                </div>

                <div class="form-group col-6 my-4">
                    <label for="device" class=" bold fs-5">Dispositiu</label>
                    <select class="form-control form-select" name="device" id="device">
                        <?php
                        echo "<option value='' default hidden>Escull dispositiu...</option>";
                        $valueN = 1;
                        foreach ($device as $value) {
                            echo "<option value='" . $valueN . "'>" . $value . " </option>";
                            $valueN++;
                        }
                        ?>
                    </select>
                </div>
                <div class="col-6 mt-4 mb-5">
                    <label for="center_g" class=" bold fs-5">Centre emissor</label>
                    <select class="form-control form-select" name="center_g" id="center_g">
                        <?php
                        echo "<option value='' default hidden>Escull centre...</option>";
                        foreach ($center as $value) {
                            echo "<option value='" . $value['center_id'] . "'>" . $value['name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-6 mt-4 mb-5">
                    <label for="center_r" class=" bold fs-5">Centre reparador</label>
                    <select class="form-control form-select" name="center_r" id="center_r">
                        <?php
                        echo "<option value='' default hidden>Escull centre...</option>";
                        foreach ($center as $value) {
                            echo "<option value='" . $value['center_id'] . "'>" . $value['name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-6 my-4 ">
                    <label for="email" class=" bold fs-5">Correu Professor Emissor </label>
                    <input type="text" class="form-control" name="email" id="email" value="anilei@xtec.cat"></input>
                </div>
                <div class="form-group col-6 my-4 ">
                    <label for="name" class=" bold fs-5">Nom Professor Emissor </label>
                    <input type="text" class="form-control" name="name" id="name" value="Alexander"></input>
                </div>
                <div>
                    <p style="color: red;"><?= session()->getFlashdata('error') ?></p>
                </div>
                <div class="col-12 bottom-center pe-0 ">
                    <button type="submit" class="btn btn-primary bold">Guardar</button>
                    <a href="<?= base_url("/viewTickets") ?>" class="btn btn-light btn-block ">Cancelar</a>

                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('select').selectize({
            sortField: 'text'
        });
    });
    /*const search1 = document.getElementById('search1');
    const select1 = document.getElementById('center_r');
    //const search2 = document.getElementById('search2');
    const select2 = document.getElementById('center_g');
    search1.addEventListener('input', filterR)

    function filterR() {
        var textToFilter = search1.value.toUpperCase();
        var options = select1.options;
        for (var i = 0; i < options.length; i++) {
            var txtValue = options[i].text.toUpperCase();
            if (txtValue.indexOf(textToFilter) > -1) {
                options[i].style.display = "";
            } else {
                options[i].style.display = "none";
            }
        }
    }*/
</script>
<?php echo $this->endSection(); ?>