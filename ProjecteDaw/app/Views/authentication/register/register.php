<?php echo $this->extend('layouts/authLayout/auth.php'); ?>

<?php echo $this->section("auth"); ?>

<h2 class="text-center">REGISTRAT</h2>

<?= validation_list_errors(); ?>

<form action="<?= base_url('authentication/register') ?>" method="POST">
    <?= csrf_field(); ?>

    <div class="m-2">
        <label for="name" class="form-label">Nom: </label>
        <input class="form-control" type="text" name="name" id="name" value="<?= old('name') ?>">
    </div>

    <div class="m-2">
        <label for="mail" class="form-label">Email: </label>
        <input class="form-control" type="text" name="mail" id="mail" value="<?= old('mail') ?>">
    </div>

    <div class="m-2">
        <label for="password" class="form-label">Password: </label>
        <input class="form-control" type="password" name="password" id="password" value="<?= old('pass') ?>">
    </div>

    <div class="m-2">
        <label for="passConfirm" class="form-label">Confirma Contrasenya: </label>
        <input class="form-control" type="password" name="passConfirm" id="passConfirm" value="<?= old('passConfirm') ?>">
    </div>

    <div class="mt-3">
        <input class="btn btn-primary w-100" type="submit" value="Registrat">
        <div style="color:red">
            <?= session()->getFlashdata('error'); ?>
        </div>
    </div>
    <div class="m-1 text-center">
        <a class="btn btn-link" href="<?php echo base_url("/login") ?>">Tornar al Login</a>
    </div>

    <div class="m-1 text-center">
        <a class="btn btn-link" href="<?php echo base_url("/viewTickets") ?>">Cancela</a>
    </div>
</form>


<?php echo $this->endSection(); ?>