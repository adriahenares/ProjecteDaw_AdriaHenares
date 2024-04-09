<?php
echo $this->extend('layouts/default/default');
echo $this->section("main_content");
?>
<div class="container-fluid p-0">
    <div class="row">

        <div class="col-12">
            <div class="d-flex align-items-center">
                <img src="<?= base_url('Logo.png') ?>" alt="Logo" style="max-width: 128px">
                <div>
                    <h1><?= $title ?></h1>
                </div>
            </div>
        </div>

        <?= $this->include("layouts/partials/menu") ?>
        
        <div class="col-10 ps-2 pe-2 pt-2">
            <div>
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
                    </table>
                </div>
                <div>
                    <?= $output ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->endSection(); ?>