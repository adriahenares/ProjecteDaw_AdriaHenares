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
                                <th>Id device</th>
                                <th>descripcio</th>
                                <th>email centre generador</th>
                                <th>data registre</th>
                                <th>data ultima modificacio</th>
                                <th>Id status</th>
                            </tr>
                        </thead>
                        <tr>
                            <td><?php echo $ticket['device_type_id'] ?></td>
                            <td><?php echo $ticket['fault_description'] ?></td>
                            <td><?php echo $ticket['email_person_center_g'] ?></td>
                            <td><?php echo $ticket['created_at'] ?></td>
                            <td><?php echo $ticket['updated_at'] ?></td>
                            <td><?php echo $ticket['status_id'] ?></td>
                        </tr>
                    </table>
                </div>
                <a class="btn btn-primary" href="<?= base_url('/addIntervention/' . $ticket['ticket_id'])?>">Afegeix Intervencio</a>
                <div>
                    <?= $output ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->endSection(); ?>