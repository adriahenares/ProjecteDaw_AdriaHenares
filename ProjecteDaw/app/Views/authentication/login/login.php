<?php echo $this->extend('layouts/authLayout/auth.php'); ?>

<?php echo $this->section("auth"); ?>


<h2 class="text-center">INICIA SESSIÓ</h2>

<?= validation_list_errors(); ?>

<form action="<?= base_url('authetication/login') ?>" method="POST">
    <?= csrf_field(); ?>
    <div class="m-2">
        <label for="mail" class="form-label">Email:</label>
        <input type="text" name="mail" id="mail" class="form-control" placeholder="example@gmail.com" value="<?= old('mail') ?>">
    </div>

    <div class="m-2">
        <label for="pass" class="form-label">Password:</label>
        <input type="password" name="pass" id="pass" class="form-control" placeholder="pass" value="<?= old('pass') ?>">
    </div>

    <div class="m-3 text-center">
        <input type="submit" class="btn btn-primary w-100" value="Login">
        <div style="color:red">
            <?= session()->getFlashdata('error'); ?>
        </div>
    </div>
    <div class="text-center m-1">
        <a class="btn btn-link" href="<?php echo base_url("/register") ?>">No tens compta? crea una!!</a>
    </div>

    <div class="text-center m-1">
        <a class="btn btn-link" href="<?php echo base_url("/viewTickets") ?>">Cancela</a>
    </div>
</form>
<?php echo $this->endSection(); ?>