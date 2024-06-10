<style>
    #header {
        height: 110px;
        /* width:  100vw; */
    }

    .text-danger {
        color: red !important;
    }
</style>
<?= $this->section("title"); ?>
<title>
    <?= lang('ticketsLang.Tickets') ?>
</title>
<?php echo $this->endSection(); ?>
<?= $this->extend('layouts/mainLayout'); ?>


<?= $this->section("main_content"); ?>

<?// if ($add): ?>
<!-- <script>
            addEventListener("DOMContentLoaded", (event) => {
                let btn = document.createElement('a');
                btn.href = "<?= base_url('/addTickets') ?>";
                btn.classList.add('btn', 'btn-info');
                btn.id = 'list-btn-print';
                btn.style.marginLeft = '5px';
                btn.innerHTML = '<i class="fa-solid fa-plus"></i> <?= lang('ticketsLang.add') ?>';
                let div = document.getElementsByClassName('d-flex')[0];
                div.appendChild(btn);
                document.getElementById('list-btn-exportxls').innerHTML = '<i class="fa-solid fa-file-excel" aria-hidden="true" style="margin-right: 5px"></i><?= lang('ticketsLang.export') ?>';
                document.getElementById('list-btn-print').innerHTML = '<i class="fa-solid fa-print" aria-hidden="true" style="margin-right: 5px"></i><?= lang('ticketsLang.print') ?>';
                //console.log(document.getElementsByClassName('dataTables_info'));
                //document.getElementsByClassName('dataTables_info')[0] = 'none';
            });
        </script> -->
<?php //endif ?>
<script>
    $(document).ready(function () {
        $('#table').DataTable({
            processing: true,
            serverSide: true,
            orderCellsTop: true,
            ajax: '<?= base_url('loadInfoTickets') ?>',
            columnDefs: [
                {
                    targets: -1,
                    orderable: false,
                    className: 'noExport'
                },
                {
                    targets: 0,
                    render: function (data, type) {
                        return data.slice(24, 36);
                    }
                },
                {
                    targets: 2,
                    render: function (data, type) {
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
                    buttons: [
                        {
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
            initComplete: function (settings, json) {
                var indexColumn = 0;
                var length = this.api().columns()[0].length - 1;
                this.api().columns().every(function () {

                    var column = this;
                    console.log(column[0][0]);
                    if (column[0][0] != length) {
                        var input = document.createElement("input");

                        $(input).attr('placeholder', 'Search')
                            .addClass('form-control form-control-sm')
                            .appendTo($('.filterhead:eq(' + indexColumn + ')').empty())
                            .on('keyup', function () {
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
            window.location.href='<?= base_url('addTickets'); ?>';
        });
        div.appendChild(button);
        document.getElementById('table_wrapper').childNodes[0].childNodes[1].classList.add("mr-auto");
        document.getElementById('table_wrapper').childNodes[0].appendChild(div);
    });
    
</script>
<table id="table" class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tipus</th>
            <th>Descripcio</th>
            <th>Centre generador</th>
            <th>Centre reparador</th>
            <th>Estat</th>
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
<?= $this->endSection(); ?>