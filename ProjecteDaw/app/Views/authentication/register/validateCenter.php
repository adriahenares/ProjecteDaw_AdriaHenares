<?= $this->extend('layouts/authLayout/auth.php'); ?>

<?= $this->section("auth"); ?>
<div class="container-fluid mt-3">
    <div id="assign" class="border">

        <div>
            <h3 class="mt-0"> <?= lang('ticketsLang.centers') ?></h3>
        </div>
        <div>
            <form action="<?= base_url('/validateCenter') ?>" method="post">
                <?= csrf_field(); ?>
                <div>
                    <label for="center_r"></label>
                    <select class="form-control" name="center_r" id="center_r">
                        <?php
                        echo "<option value=''  default hidden>".  lang('ticketsLang.choose_center') ."</option>";
                        foreach ($center as $value) {
                            echo "<option value='" . $value['center_id'] . "'>" . $value['name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class=" col-12 bottom-center pe-0 ">
                    <button type="submit" class="btn btn-primary bold"><?= lang('ticketsLang.save')?></button>
                </div>
            </form>
        </div>

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
<?= $this->endSection() ?>