<?php echo $this->extend('layouts/authLayout/auth.php'); ?>

<?php echo $this->section("auth"); ?>
<div class="container-fluid">
    <form action="<?= base_url('/loginAuth') ?>" method="post">
        <?= csrf_field(); ?>
        <div class="m-2">
            <label for="mail" class="form-label"> <?= lang('loginLang.email') ?></label>
            <input type="text" name="mail" id="mail" class="form-control" placeholder="example@gmail.com" value="<?= old('mail') ?>">
        </div>

        <div class="m-2">
            <label for="pass" class="form-label"> <?= lang('loginLang.password') ?></label>
            <input type="password" name="pass" id="pass" class="form-control" placeholder="<?= lang('loginLang.password') ?>" value="<?= old('pass') ?>">
        </div>
        <div class="m-2 text-center">
            <input type="submit" class="btn btn-primary w-100" value=" <?= lang('loginLang.login_button') ?>">
        </div>
    </form>
    <div class="container">
        <div class="panel panel-default">
            <?php
            if (isset($login_button)) {
                echo  $login_button;
            }
            ?>
        </div>
        <div class="m-2 text-center">
            <div classs="m-3 text-center" style="color:red">
                <?= session()->getFlashdata('error'); ?>
            </div>
        </div>
    </div>
</div>
<?php echo $this->endSection(); ?>