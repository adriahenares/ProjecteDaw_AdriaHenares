<?php
echo $this->extend('layouts/default/default');

echo $this->section("main_content");
?>

<div class="container-fluid p-0">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center bg-dark">
                <img src="<?= base_url('Logo.png') ?>" alt="Logo" style="max-width: 80px">
                <div>
                    <h1 class="text-white text-center"><?= $title ?></h1>
                </div>
            </div>
        </div>
        <?= $this->include("layouts/partials/menu") ?>
        <div id="centres" class="col-10">
            <form action="<?= base_url("/addIntervention") ?>" method="POST">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="professor" class=""><?= lang('ticketsLang.teacher')?>:</label>
                    <input type="text" class="form-control" name="professor" id="professor">
                </div>
                <div class="form-group">
                    <label for="student"><?= lang('ticketsLang.student')?>:</label>
                    <input type="text" class="form-control" name="student" id="student">
                </div>
                <div class="form-group">
                    <label for="interventionType"><?= lang('ticketsLang.intervention_type')?>:</label>
                    <select class="form-control" name="interventionType" id="interventionType">
                        <?php
                        $valueN = 1;
                        foreach ($interTypes as $value) {
                            echo "<option value='". $valueN. "'>". $value ."</option>";
                            $valueN++;
                        }  
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description"><?= lang('ticketsLang.description')?></label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="cicle"><?= lang('ticketsLang.FP')?></label>
                    <select class="form-control" name="cicle" id="cicle">
                        <?php
                            echo "<option value='DAM'>DAM</option>";
                            echo "<option value='DAW'>DAW</option>";
                            echo "<option value='ASIX'>ASIX</option>"; 
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="course"><?= lang('ticketsLang.course')?></label>
                    <select class="form-control" name="course" id="course">
                        <?php
                            echo "<option value='1'>1r</option>";
                            echo "<option value='2'>2n</option>";
                        ?>
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary"><?= lang('ticketsLang.save')?></button>
                    <a href="<?= base_url("/interventionsOfTicket/" . session()->getFlashdata("idTicket")) ?>" class="btn btn-secondary"><?= lang('ticketsLang.cancel')?></a>
                </div>
            </form>
        </div>ñ
    </div>
</div>
</div>
<?php echo $this->endSection(); ?>