<?php echo $this->extend('layouts/default/default'); ?>

<?php echo $this->section("main_content"); ?>
<div>
    <?= $output ?>
</div>
<?php echo $this->endSection(); ?>