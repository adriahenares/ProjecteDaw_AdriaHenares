<style>
    #header {
        height: 110px;
        /* width:  100vw; */
    }
</style>

<?= $this->extend('layouts/mainLayout'); ?>

<<?= $this->section("main_content"); ?>

        <!-- overflow -->
        <div class="row m-0 p-0">

                <div class="col-5">

                    <div class="row">
                        <div class="col-6">
                            <h5>Id device</h5> 
                            <br>
                            <p><?php echo $ticket['device_type_id'] ?></p>
                            <br>
                        </div>  

                        <div class="col-6">
                            <h5>email centre generador</h5> 
                            <br>
                            <p><?php echo $ticket['email_person_center_g'] ?></p>
                            <br>
                        </div>

                        <div class="col-12">
                            <h5>Descripció</h5>
                            <br>
                            <p><?php echo $ticket['fault_description'] ?></p>
                            <br>
                        </div>

                        <div class="col-6">
                            <h5>data registre</h5>
                            <br>
                            <p><?php echo $ticket['created_at'] ?></p>
                            <br>
                        </div>

                        <div class="col-6">
                            <h5>data ultima modificacio</h5>
                            <br>
                            <p><?php echo $ticket['updated_at'] ?></p>
                            <br>
                        </div>

                        <div class="col-12">
                            <h5>Id status</h5>
                            <br>
                            <p><?php echo $ticket['status_id'] ?></p>
                            <br>
                        </div>
                        
                    </div>



                    <!-- <table>
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
                            <td><?php  $ticket['device_type_id'] ?></td>
                            <td><?php  $ticket['fault_description'] ?></td>
                            <td><?php  $ticket['email_person_center_g'] ?></td>
                            <td><?php  $ticket['created_at'] ?></td>
                            <td><?php  $ticket['updated_at'] ?></td>
                            <td><?php  $ticket['status_id'] ?></td>
                        </tr>
                    </table> -->
                </div>
                
                <div class="col-7 h-100">
                    <div class="d-flex justify-content-end mb-2">
                        <a class="btn" style="background-color: #0DCAF0;"  href="<?= base_url('/addIntervention/' . $ticket['ticket_id'])?>"><i class="fa fa-plus" aria-hidden="true"></i> Afegeix</a>
                    </div>
                    <?= $output ?>
                </div>


        </div>
    </div>
</div>


<?= $this->endSection(); ?>