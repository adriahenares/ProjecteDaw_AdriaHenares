<style>
    #header {
        height: 110px;
        /* width:  100vw; */
    }
</style>
<?= $this->section("title"); ?>
<title>
    <?= lang('ticketsLang.Ticket') . ': ' . $id ?>
</title>
<?php echo $this->endSection(); ?>
<?= $this->extend('layouts/mainLayout'); ?>

<?= $this->section("main_content"); ?>

<div class="row m-0 p-0">


    <div class="col-3">

        <?php if ($ticket['device_type_id'] == 1) : ?>
            <div class="mb-5 mt-2 text-center">
                <img src="<?= base_url('images/ordinador.png') ?>" alt="Logo" style="max-height: 300px; max-width:250px;">
            </div>
        <?php elseif ($ticket['device_type_id'] == 2) : ?>
            <div class="mb-2 text-center mt-0">
                <img src="<?= base_url('images/projector.png') ?>" alt="Logo" style="max-height: 300px; max-width:250px;">
            </div>
        <?php elseif ($ticket['device_type_id'] == 3) : ?>
            <div class="mb-3 text-center">
                <img src="<?= base_url('images/pantalla.png') ?>" alt="Logo" style="max-height: 300px; max-width:250px;">
            </div>
        <?php endif ?>

        <div class="col-12 mb-4 mt-3">

            <h5 style="font-weight: bold;"> Ticket id: <?= explode("-", $ticket['ticket_id'])[4] ?> </h5>

        </div>

        <div class="row border rounded-3 mb-4 pt-2">

            <div class="col-12">
                <h5 style="font-weight: bold;"><?= lang('ticketsLang.description') ?></h5>
                <br>
                <p class="text-justify"><?php echo $ticket['fault_description'] ?></p>
                <br>
            </div>


            <!-- <div class="col-12 p-3">
                        <h5 style="font-weight: bold;">Dispositiu</h5>
                        <br>
                        <p class="text-justify"><?php $ticket['device_type_id'] ?></p>
                        <br>
                    </div> -->

            <!-- <hr/> -->

            <div class="col-12">
                <h5 style="font-weight: bold;"><?= lang('ticketsLang.issuing_center') ?></h5>
                <br>
                <p class="text-justify"><?php echo $ticket['email_person_center_g'] ?></p>
                <br>
            </div>

            <!-- <hr/> -->



            <!-- <hr/> -->

            <div class="col-12">
                <h5 style="font-weight: bold;"><?= lang('ticketsLang.creation_data') ?></h5>
                <br>
                <p class="text-justify"><?php echo $ticket['created_at'] ?></p>
                <br>
            </div>
            <!-- <hr/> -->
            <div class="col-12">
                <h5 style="font-weight: bold;"><?= lang('ticketsLang.last_modification') ?></h5>
                <br>
                <p class="text-justify"><?php echo $ticket['updated_at'] ?></p>
                <br>
            </div>

            <!-- <hr/> -->

            <div class="col-12">
                <h5 style="font-weight: bold;"><?= lang('ticketsLang.state') ?></h5>
                <br>
                <p class="text-justify"><?= $status ?></p>
                <br>
            </div>

            <!-- </div> -->
        </div>
    </div>

    <div class="col-9 h-100 ps-4 mt-5 ">

        <div class="col-12 mb-3 ">

            <h3 style="font-weight: bold;"> <?= lang('ticketsLang.intervention') ?> </h3>

        </div>
        <!-- <?php if (session()->get('role') != 'SSTT' && session()->get('role') != 'Center') : ?>
                <div class="d-flex justify-content-end mb-2">
                    <a class="btn" style="background-color: #0DCAF0;"
                        href="<?= base_url('/addIntervention/' . $ticket['ticket_id']) ?>"><i class="fa fa-plus"
                            aria-hidden="true"></i> <?= lang('ticketsLang.add') ?></a>
                </div>
            <?php endif ?> -->
        <!-- https://codeigniter4-datatables.hermawan.dev/usage/multi_column_search/ -->
        <!-- https://github.com/Xiiivpiexzo/inv-databarang/blob/main/app/Config/Routes.php -->
        <!-- https://datatables.net/reference/api/i18n() -->
        <script>
            $(document).ready(function() {
                $('#table').DataTable({
                    processing: true,
                    serverSide: true,
                    orderCellsTop: true,
                    ajax: '<?= base_url('interventionsByTicketId/' . $id) ?>',
                    columnDefs: [{
                        targets: -1,
                        orderable: false
                    }],
                    layout: {
                        topStart: {
                            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                        }
                    },
                    initComplete: function(settings, json) {

                        var indexColumn = 0;
                        var length = this.api().columns()[0].length - 1;
                        this.api().columns().every(function() {

                            var column = this;
                            console.log(column[0][0]);
                            if (column[0][0] != length) {
                                var input = document.createElement("input");

                                $(input).attr('placeholder', 'Search')
                                    .addClass('form-control form-control-sm')
                                    .appendTo($('.filterhead:eq(' + indexColumn + ')').empty())
                                    .on('keyup', function() {
                                        column.search($(this).val(), false, false, true).draw();
                                    });

                                indexColumn++;
                            }
                        });
                    }
                });
            });
        </script>
        <table id="table" class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descripcio</th>
                    <th>Alumne</th>
                    <th>Data de creaciò</th>
                    <th>Accions</th>
                </tr>
                <tr>
                    <th class="filterhead"></th>
                    <th class="filterhead"></th>
                    <th class="filterhead"></th>
                    <th class="filterhead"></th>
                    <th class="filterhead"></th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <!-- <script>
            function sortTable(n) {
                var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
                table = document.getElementById("myTable");
                switching = true;
                //Set the sorting direction to ascending:
                dir = "asc";
                /*Make a loop that will continue until
                no switching has been done:*/
                while (switching) {
                    //start by saying: no switching is done:
                    switching = false;
                    rows = table.rows;
                    /*Loop through all table rows (except the
                    first, which contains table headers):*/
                    for (i = 1; i < (rows.length - 1); i++) {
                        //start by saying there should be no switching:
                        shouldSwitch = false;
                        /*Get the two elements you want to compare,
                        one from current row and one from the next:*/
                        x = rows[i].getElementsByTagName("TD")[n];
                        y = rows[i + 1].getElementsByTagName("TD")[n];
                        /*check if the two rows should switch place,
                        based on the direction, asc or desc:*/
                        if (dir == "asc") {
                            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                                //if so, mark as a switch and break the loop:
                                shouldSwitch = true;
                                break;
                            }
                        } else if (dir == "desc") {
                            if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                                //if so, mark as a switch and break the loop:
                                shouldSwitch = true;
                                break;
                            }
                        }
                    }
                    if (shouldSwitch) {
                        /*If a switch has been marked, make the switch
                        and mark that a switch has been done:*/
                        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                        switching = true;
                        //Each time a switch is done, increase this count by 1:
                        switchcount++;
                    } else {
                        /*If no switching has been done AND the direction is "asc",
                        set the direction to "desc" and run the while loop again.*/
                        if (switchcount == 0 && dir == "asc") {
                            dir = "desc";
                            switching = true;
                        }
                    }
                }
            }
        </script> -->
    </div>
</div>


<?= $this->endSection(); ?>