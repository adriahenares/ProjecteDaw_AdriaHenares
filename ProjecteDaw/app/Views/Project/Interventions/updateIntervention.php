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
            <form action="<?php base_url("/addTickets") ?>" method="POST">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="person_contact_center" class=""><?= lang('ticketsLang.center_contact')?>:</label>
                    <input type="text" class="form-control" name="person_contact_center" id="person_contact_center">
                </div>
                <div class="form-group">
                    <label for="email_person_contact"><?= lang('ticketsLang.center_contact_email')?>:</label>
                    <input type="text" class="form-control" name="email_person_contact" id="email_person_contact">
                </div>
                <div class="form-group">
                    <label for="description"><?= lang('ticketsLang.description')?></label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="device"><?= lang('ticketsLang.device')?></label>
                    <select class="form-control" name="device" id="device">
                        <?php
                        $valueN = 1;
                        foreach ($device as $value) {
                            echo "<option value='". $valueN. "'>". $value ."</option>";
                            $valueN++;
                        }  
                        ?>
                    </select>
                </div>
                <div>
                    <label for="status">Status</label>
                    <select class="form-control" name="status" id="status">
                        <?php
                        $valueN = 1;
                        foreach ($status as $value) {
                            echo "<option value='". $valueN . "'>". $value ."</option>";
                            $valueN++;
                        }  
                        ?>
                    </select>
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary"><?= lang('ticketsLang.save')?></button>
                    <a href="<?= base_url("/viewTickets") ?>" class="btn btn-secondary"><?= lang('ticketsLang.cancel')?></a>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<?php echo $this->endSection(); ?>