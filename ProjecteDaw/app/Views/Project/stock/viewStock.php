<?= $this->extend('layouts/mainLayout'); ?>
<?= $this->section("title"); ?>
<title>
    <?= lang('stockLang.title') . ': ' . session()->get('idCenter') ?>
</title>
<?php echo $this->endSection(); ?>
<?= $this->section("main_content"); ?>
<script>
    $(document).ready(function() {
        $('#table').DataTable({
            processing: true,
            serverSide: true,
            orderCellsTop: true,
            ajax: '<?= base_url('stockByCenterId/' . session()->get('idCenter')) ?>',
            columnDefs: [{
                targets: -1,
                orderable: false,
                className: 'noExport'
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
        document.getElementById('table_wrapper').insertBefore(addDiv, document.getElementById('table_wrapper').childNodes[1])   ;
    });

    function showAddDiv() {
        document.getElementById('addContainer').style.display = 'block';
        document.getElementById('addButton').hidden = false;
        document.getElementById('editButton').hidden = true;
        document.getElementById('amountLabel').hidden = false;
        document.getElementById('amount').hidden = false;

        document.getElementById('type').value = '';
        document.getElementById('description').value = '';
        document.getElementById('date').value = '';
        document.getElementById('price').value = '';
    }
    function edit(id, type, description, date, price) {
        document.getElementById('addContainer').style.display = 'block';
        document.getElementById('addButton').hidden = true;
        document.getElementById('editButton').hidden = false;
        document.getElementById('amountLabel').hidden = true;
        document.getElementById('amount').hidden = true;

        document.getElementById('type').value = type;
        document.getElementById('description').value = description;
        document.getElementById('date').value = date;
        document.getElementById('price').value = price;
    }
</script>
<div id="addContainer" style="display: none; border: 1px solid black; border-radius: 5px; margin-bottom: 8px">
    <h3 style="font-weight: bold;"> <?= 'Afegir inventari (traduir)' ?></h3>
    <form action="<?= base_url('addStock') ?>" method="POST">
        <?= csrf_field(); ?>
        <label for="type">Descripció</label>
        <select name="type" id="type">
            <?php foreach ($types as $type) : ?>
                <option value="<?= $type['stock_type_id'] ?>"><?= $type['name'] ?></option>
            <?php endforeach; ?>
        </select>
        <label for="description">Descripció</label>
        <input type="text" name="description" id="description"/>
        <label for="date">Data de compra</label>
        <input type="date" name="date" id="date"><br>
        <label for="price">Preu</label>
        <input type="number" name="price" id="price" min='1'>
        <label for="amount" id="amountLabel">Quantitat</label>
        <input type="number" name="amount" id="amount" value="1" min='1'>
        <br>
        <button id="addButton" class="btn btn-success" name="addButton">Afegir</button>
        <button id="editButton" class="btn btn-success" name="editButton" hidden>Modificar</button>
        <button class="btn btn-danger">Cancelar</button>
    </form>
</div>
<h3 style="font-weight: bold;"> <?= lang('stockLang.inventory') ?></h3>
<table id="table" class="table table-bordered">
    <thead>
        <tr>
            <th>Tipus</th>
            <th>Descripcio</th>
            <th>Data de compra</th>
            <th>Preu</th>
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
<?php echo $this->endSection(); ?>