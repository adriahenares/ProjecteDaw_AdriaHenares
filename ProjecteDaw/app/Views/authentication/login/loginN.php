<?php echo $this->extend('layouts/authLayout/auth.php'); ?>

<?php echo $this->section("auth"); ?>

<h2 class="text-center">INICIA SESSIÓ</h2>

<form action="<?= base_url('/loginAuth') ?>" method="post">
    <?= csrf_field(); ?>
    <div class="m-2">
        <label for="mail" class="form-label">Email:</label>
        <input type="text" name="mail" id="mail" class="form-control" placeholder="example@gmail.com" value="<?= old('mail') ?>">
    </div>

    <div class="m-2">
        <label for="pass" class="form-label">Password:</label>
        <input type="password" name="pass" id="pass" class="form-control" placeholder="Contrasenya" value="<?= old('pass') ?>">
    </div>
    <div class="m-2 text-center">
        <input type="submit" class="btn btn-primary w-100" value="Login">
        <div classs="m-3 text-center" style="color:red">
            <?= session()->getFlashdata('error'); ?>
        </div>
    </div>
</form>

<?php echo $this->endSection(); ?>