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
            <div class="mb-3 text-center">
                <img src="<?= base_url('images/portatil.png') ?>" alt="Logo" style="max-height: 300px; max-width:250px;">
            </div>
        <?php elseif ($ticket['device_type_id'] == 3) : ?>
            <div class="mb-3 text-center">
                <img src="<?= base_url('images/pantalla.png') ?>" alt="Logo" style="max-height: 300px; max-width:250px;">
            </div>
        <?php elseif ($ticket['device_type_id'] == 4) : ?>
            <div class="mb-2 text-center mt-0">
                <img src="<?= base_url('images/projector.png') ?>" alt="Logo" style="max-height: 300px; max-width:250px;">
            </div>
        <?php elseif ($ticket['device_type_id'] == 5) : ?>
            <div class="mb-3 text-center">
                <img src="<?= base_url('images/impressora.webp') ?>" alt="Logo" style="max-height: 300px; max-width:250px;">
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
                            orderable: false,
                            className: 'noExport'
                        },
                        {
                            targets: 0,
                            render: function(data, type) {
                                return data.slice(24, 36);
                            }
                        },
                        {
                            targets: 1,
                            render: function(data, type) {
                                console.log(data);
                                if (data.length > 30) {
                                    return data.slice(0, 26) + '...';
                                }
                                return data;
                            }
                        }
                    ],
                    layout: {
                        topStart: {
                            buttons: [{
                                    extend: 'copy',
                                    text: '<i class="fa-solid fa-copy"></i>'
                                },
                                {
                                    extend: 'csv',
                                    text: '<i class="fa-solid fa-file-csv"></i>'
                                },
                                {
                                    extend: 'excel',
                                    text: '<i class="fa-solid fa-file-excel"></i>'
                                },
                                {
                                    extend: 'pdf',
                                    text: '<i class="fa-solid fa-file-pdf"></i>'
                                },
                                {
                                    extend: 'print',
                                    text: '<i class="fa-solid fa-print"></i>'
                                }
                            ]
                        }
                    },
                    select: true,
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
                let div = document.createElement('div');
                div.classList.add('col-md-auto', 'ml-auto');
                let button = document.createElement('button');
                button.classList.add('btn', 'btn-primary');
                button.innerHTML = 'Afegir';
                button.addEventListener('click', () => {
                    showAddDiv();
                });
                div.appendChild(button);
                console.log(document.getElementById('table_wrapper').childNodes[0].childNodes[1]);
                document.getElementById('table_wrapper').childNodes[0].childNodes[1].classList.add("mr-auto");
                document.getElementById('table_wrapper').childNodes[0].appendChild(div);
                let addDiv = document.getElementById('addContainer');
                document.getElementById('table_wrapper').insertBefore(addDiv, document.getElementById('table_wrapper').childNodes[1]);
                document.getElementById('cancelButton').addEventListener('click', () => {
                    close();
                });
            });

            function showAddDiv() {
                document.getElementById('addContainer').style.display = 'block';
                document.getElementById('addTitle').innerHTML = 'Afegir intervenció';
                document.getElementById('addButton').hidden = false;
                document.getElementById('editButton').hidden = true;

                document.getElementById('interventionId').value = '';
                document.getElementById('stock').value = '';
                document.getElementById('description').value = '';
            }

            function close() {
                document.getElementById('addContainer').style.display = 'none';
                document.getElementById('interventionId').value = '';
                document.getElementById('stock').value = '';
                document.getElementById('description').value = '';
            }
        </script>
        <div id="addContainer" style="display: none; border: 1px solid black; border-radius: 5px; margin-bottom: 8px">
            <h3 style="font-weight: bold;" id="addTitle">Afegir intervenció</h3>
            <form action="<?= base_url('addIntervention/' . $id) ?>" method="POST">
                <?= csrf_field(); ?>
                <label for="stock">Peça utilitzada:</label>
                <select name="stock" id="stock">
                    <?php if (count($stock) == 0) : ?>
                        <option disabled>No hi ha inventari</option>
                    <?php endif; ?>
                    <?php foreach ($stock as $item) : ?>
                        <option value="<?= $item->stock_id ?>"><?= $item->name ?>: <?= $item->description ?>
                            (<?= $item->price ?>€)</option>
                    <?php endforeach; ?>
                </select>
                <input type="text" name="interventionId" id="interventionId" hidden>
                <label for="description">Descripció:</label>
                <input type="text" name="description" id="description" />
                <label for="course">Curs:</label>
                <select name="course" id="course">
                    <option value="1n">1n</option>
                    <option value="2n">2n</option>
                </select>
                <label for="studies">Estudis:</label>
                <select name="studies" id="studies">
                    <option value="SMX">SMX</option>
                    <option value="ASIX">ASIX</option>
                </select>
                <br>
                <button id="addButton" class="btn btn-success" name="addButton">Afegir</button>
                <button id="editButton" class="btn btn-success" name="editButton" hidden>Modificar</button>
                <button id="cancelButton" class="btn btn-danger" type="button">Cancelar</button>
            </form>
        </div>
        <table id="table" class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descripcio</th>
                    <th>Alumne</th>
                    <th>Curs</th>
                    <th>Estudis</th>
                    <th>Data de creaciò</th>
                    <th>Accions</th>
                </tr>
                <tr>
                    <th class="filterhead"></th>
                    <th class="filterhead"></th>
                    <th class="filterhead"></th>
                    <th class="filterhead"></th>
                    <th class="filterhead"></th>
                    <th class="filterhead"></th>
                    <th class="filterhead"></th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>


<?= $this->endSection(); ?>