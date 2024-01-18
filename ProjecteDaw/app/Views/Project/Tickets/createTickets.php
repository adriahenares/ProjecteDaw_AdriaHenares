<?php echo $this->extend('layouts/ticketsAll/tickets'); ?>

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
        <label for="generating_center">Centre generador:</label>
        <input type="number" id="generating_center" name="generating_center">
        <br />
        <label for="repair_center">Centre reparador:</label>
        <input type="number" id="repair_center" name="repair_center">

        <div id="">
            <label for="ticket_id">ID tiquet:</label>
            <input type="text" name="ticket_id" id="ticket_id">
            <br />
            <label for="device_type">Tipus dispositiu</label>
            <input type="text" name="device_type" id="device_type">
            <br />
            <label for="person_contact_center">Persona contacte centre:</label>
            <input type="text" name="person_contact_center" id="person_contact_center">
            <br />
            <label for="email_person_contact">Correu persona contacte:</label>
            <input type="text" name="email_person_contact" id="email_person_contact">
            <br />
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