<?php echo $this->extend('layout/ticketsAll/tickets'); ?>
<?php echo $this->section("menu"); ?>

<div class="menu">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">MENU</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <img src="tickets.png" alt="">
                    <a class="nav-link" href="#">Tickets</a>
                </li>
                <li class="nav-item">
                    <img src="inventari.png" alt="">
                    <a class="nav-link" href="#">Inventari</a>
                </li>
        </div>
    </nav>
</div>

<?php echo $this->endSection(); ?>