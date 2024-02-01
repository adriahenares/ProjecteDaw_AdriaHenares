<?php

use PhpParser\Node\Expr\Cast;

 echo $this->extend('layouts/ticketsAll/tickets'); ?>

<?php echo $this->section("create"); ?>

<div>
    <div id="header">
        <img src="" alt="logo">
        <h1>Crear Tickets</h1>
    </div>

    <div id="enrere">
        <img src="" alt="enrere">
    </div>

    <div id="centres">
        <form action="<?php base_url("/addTickets") ?>" method="POST">
            <?= csrf_field() ?>
            <div>
                <label for="generating_center">Codi centre generador:</label>
                <input type="number" id="generating_center" name="generating_center">
            </div>
            <div>
                <label for="repair_center">Codi centre reparador:</label>
                <input type="number" id="repair_center" name="repair_center" value="<?php echo $codeGenCenter['repair_center_id'] ?>" >
            </div>
            <div>
                <label for="person_contact_center">Persona contacte centre:</label>
                <input type="text" name="person_contact_center" id="person_contact_center">
            </div>
            <div>
                <label for="email_person_contact">Correu persona contacte:</label>
                <input type="text" name="email_person_contact" id="email_person_contact">
            </div>
            <div>
                <label for="date_last_modification">Data ultima modificació: </label>
                <input type="date" name="date_last_modification" id="date_last_modification" value="<?php echo $dateNow?>">
            </div>
            <div>
                <label for="registration_data">Data de registre: </label>
                <input type="date" name="registration_data" id="registration_data" value="<?php echo $dateNow ?>">
            </div>
            <div>
                <label for="description">Descripció</label> <br />
                <textarea name="description" id="description" cols="30" rows="3"></textarea>
            </div>
            <div>
                <input type="submit" class="button" value="Guardar">
                <input type="submit" class="button" value="Cancelar">
            </div>
    </div>
</div>
<?php echo $this->endSection(); ?>