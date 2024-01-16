<?php echo $this->extend('layout/ticketsAll/tickets'); ?>

<?php echo $this->section("view"); ?>
<div>
    <div>
        <h1>GESTIO DE TICKETS</h1>
        <!--<img src="" alt=""> logo empresa -->
    </div>
    <div>
        <table>
            <thead>
                <tr>
                    <th>Id ticket</th>
                    <th>Id device</th>
                    <th>descripcio</th>
                    <th>codi centre generador</th>
                    <th>codi centre reparador</th>
                    <th>email centre generador</th>
                    <th>data ultima modificacio</th>
                    <th>data registre</th>
                    <th>Id status</th>
                </tr>
            </thead>
            <?php foreach ($tickets as $ticket) : ?>
                <tr>
                    <td><?php echo $ticket['ticket_id'] ?></td>
                    <td><?php echo $ticket['device_type_id'] ?></td>
                    <td><?php echo $ticket['fault_description'] ?></td>
                    <td><?php echo $ticket['g_center_code'] ?></td>
                    <td><?php echo $ticket['r_center_code'] ?></td>
                    <td><?php echo $ticket['email_person_center_g'] ?></td>
                    <td><?php echo $ticket['date_last_modification'] ?></td>
                    <td><?php echo $ticket['registration_data'] ?></td>
                    <td><?php echo $ticket['status_id'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <div>
        <a class="m-1 w-100 btn btn-primary" href="">Crear Ticket</a>
    </div>
</div>
<?php echo $this->endSection(); ?>