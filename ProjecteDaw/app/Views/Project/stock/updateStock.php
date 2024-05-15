<?php
$this->extend('layouts/mainLayout');
$testUser = 2;
echo $this->section("main_content");
?>
<div class="container-fluid mt-3">
    <div id="centres" class="border">

        <div>
            <h3 class="titleForm mt-0">Updade Stock</h3>
        </div>

        <form action="<?php base_url("/updateStock/" . $stock["stock_id"]) ?>" method="POST" class="formAdd p-2 pb-0">
            <?= csrf_field() ?>
            <?php if (session()->getFlashdata("level") == 1) : ?>
                <div class="form-group col-6 my-4 ">
                    <label for="price" class=" bold fs-5">Preu (unitari)</label>
                    <input type="number" class="form-control" name="price" onkeydown="checkValidationPrice(event)" id="price" value="<?= $stock['price'] ?>"></input>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata("level") == 0) : ?>
                <div class="row">
                    <div class="form-group col-6 my-4 ">
                        <label for="description" class=" bold fs-5"><?= lang('ticketsLang.description') ?></label>
                        <textarea class="form-control" name="description" id="description" cols="30" rows="3"><?= $stock['description'] ?></textarea>
                    </div>
                    <div class="form-group col-6 my-4">
                        <label for="type_piece" class="bold fs-5">Tipus peça</label>
                        <select class="form-control form-select" name="type_piece" id="type_piece">
                            <?php
                            echo "<option value=''default hidden>Escull el tipus...</option>";
                            $valueN = 1;
                            foreach ($types as $value) {
                                if ($valueN == $stock['stock_type_id']) {
                                    echo "<option value='" . $valueN . "'>" . $value['name'] . " </option>";
                                } else {
                                    echo "<option value='" . $valueN . "'>" . $value['name'] . " </option>";
                                }
                                $valueN++;
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-6 my-4 ">
                        <label for="price" class=" bold fs-5">Preu (unitari)</label>
                        <input type="number" class="form-control" name="price" onkeydown="checkValidationPrice(event)" id="price"></input>
                    </div>
                    <div class="form-group col-6 my-4 ">
                        <label for="number_units" class=" bold fs-5">Numero de unitats</label>
                        <input type="number" class="form-control" onkeydown="checkValidation(event)" name="number_units" id="number_units"></input>
                    </div>
                    <div class="col-6 mt-4 mb-5">
                        <label for="center" class=" bold fs-5"><?= lang('ticketsLang.issuing_center') ?></label>
                        <select name="center" id="center">
                            <?php
                            echo "<option value='' default hidden>Escull centre...</option>";
                            foreach ($center as $value) {

                                echo "<option value='" . $value['center_id'] . "'>" . $value['name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <?= session()->getFlashdata('error') ?>
                    </div>
                    <div class="col-12 bottom-center pe-0 ">
                        <button type="submit" class="btn btn-primary bold"><?= lang('ticketsLang.save') ?></button>
                        <a href="<?= base_url("/viewStock") ?>" class="btn btn-light btn-block"><?= lang('ticketsLang.cancel') ?></a>
                    </div>
                </div>
            <?php endif; ?>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        // s'inicialitza els select amb selectize
        $('select').selectize({
            sortField: 'text'
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        var selectedValue = <?php echo json_encode($stock['stock_type_id']); ?>;

        var $select = $('#select-stock-type').selectize();

        var selectizeInstance = $select[0].selectize;

        selectizeInstance.setValue(selectedValue);
    });


    function checkValidation(event) {
        var key = event.key;
        const unitNumber = event.target.value;
        if (isNaN(key) && key != 'Backspace') {
            event.stopPropagation();
            event.preventDefault();
            return;
        }
        if (unitNumber.length === 0 && key === '0') {
            event.preventDefault(); // Evitar la inserción del 0 inicial
            return;
        }
    }

    function checkValidationPrice(event) {
        //const unitNumber = document.getElementById('number_units');
        var key = event.key;
        if (key == '-') {
            event.stopPropagation();
            event.preventDefault();
            return;
        }
    }
</script>
<?php echo $this->endSection() ?>