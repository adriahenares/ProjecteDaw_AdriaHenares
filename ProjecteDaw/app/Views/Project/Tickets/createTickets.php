<?php
$this->extend('layouts/mainLayout');
echo $this->section("main_content");
?>


<div class="container-fluid mt-3">
    <div id="centres" class="border">

        <div>
            <h3 class="titleForm mt-0"><?= lang('ticketsLang.add_ticket') ?></h3>
        </div>

        <form action="<?php base_url("/addTickets") ?>" method="POST" class="formAdd p-2 pb-0">

            <?= csrf_field() ?>

            <div class="row ">
                <div class="form-group col-6 my-4 ">
                    <label for="description" class=" bold fs-5"><?= lang('ticketsLang.description') ?></label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="3"></textarea>
                </div>
                <div class="form-group col-6 my-4">
                    <label for="device" class=" bold fs-5"><?= lang('ticketsLang.device') ?></label>
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
                <!--Començament de les variables-->
                <?php if($role == 'SSTT'): ?>
                <div class="col-6 mt-4 mb-5">
                    <label for="center_g" class=" bold fs-5"><?= lang('ticketsLang.issuing_center') ?></label>
                    <select name="center_g" id="center_g">
                        <?php
                        echo "<option value='' default hidden>Escull centre...</option>";
                        foreach ($center as $value) {
                            echo "<option value='" . $value['center_id'] . "'>" . $value['name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-6 mt-4 mb-5">
                    <label for="center_r" class=" bold fs-5"><?= lang('ticketsLang.repair_center') ?></label>
                    <select class="form-control form-select" name="center_r" id="center_r">
                        <?php
                        echo "<option value='' default hidden>Escull centre...</option>";
                        foreach ($repairCenters as $value) {
                            echo "<option value='" . $value->center_id . "'>" . $value->name . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <?php endif; ?>
                <div class="form-group col-6 my-4 ">
                    <label for="email" class=" bold fs-5"><?= lang('ticketsLang.teacher_email') ?> </label>
                    <input type="text" class="form-control" name="email" id="email"></input> <!--Correu per sessio-->
                </div>
                <div class="form-group col-6 my-4 ">
                    <label for="name" class=" bold fs-5"><?= lang('ticketsLang.teacher_name') ?></label> <!--Nom per sessio-->
                    <input type="text" class="form-control"  name="name" id="name"></input> 
                </div>
                <!--Professor-->
                <!--Fi variables-->
                <div class="col-12 bottom-center pe-0 ">
                    <button type="submit" class="btn btn-primary bold"><?= lang('ticketsLang.save') ?></button>
                    <a href="<?= base_url("/viewTickets") ?>" class="btn btn-light btn-block"><?= lang('ticketsLang.cancel') ?></a>
                </div>
            </div>
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
</script>
<?php if(session()->get('role') == 'SSTT'): ?>
<script>
    $(document).ready(function() {
        const selectGen = $('#center_g')[0].selectize;
        const name = document.getElementById('name');
        const email = document.getElementById('email');
        name.disabled = false;
        email.disabled = false;
        selectGen.on('change', function(value) {
            console.log(value);
            if (value != '') {
                console.log(value);
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    if (xhttp.readyState == 4 && xhttp.status == 200) {
                        const response = JSON.parse(xhttp.responseText);
                        console.log(response);
                        email.value = response.email;
                    } else {
                        console.log('error');
                    }
                }
                xhttp.open("GET", '/emailCenter/' + value);
                xhttp.send();
            } else {
                console.log('del');
            }
        });
    });
</script>
<?php endif; ?>
<?php echo $this->endSection(); ?>