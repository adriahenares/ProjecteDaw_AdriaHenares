<style>
  #header {
    height: 110px;
    /* width:  100vw; */
  }
</style>

<?= $this->extend('layouts/mainLayout'); ?>
<?= $this->section("main_content"); ?>
<script>
  $(document).ready(function() {
    $('#table').DataTable({
      processing: true,
      serverSide: true,
      orderCellsTop: true,
      ajax: '<?= base_url('studentsByCenterId/' . session()->get('idCenter')) ?>',
      columnDefs: [{
        targets: -1,
        orderable: false,
        className: 'noExport'
      }],
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
    document.getElementById('mail').value = '';
    document.getElementById('password').value = '';
  }

  function close() {
    document.getElementById('addContainer').style.display = 'none';
  }
</script>
<div class="row p-2 pb-0">
  <div class="col-12">
    <div id="addContainer" style="display: none; border: 1px solid black; border-radius: 5px; margin-bottom: 8px">
      <h3 style="font-weight: bold;" id="addTitle"> <?= 'Afegir inventari' ?></h3>
      <form action="<?= base_url('students') ?>" method="POST">
        <?= csrf_field(); ?>
        <label for="mail">Correu</label>
        <input type="mail" name="mail" id="mail" />
        <label for="password">Contrasenya</label>
        <input type="password" name="password" id="password" />
        <br>
        <button id="addButton" class="btn btn-success" name="addButton">Afegir</button>
        <button id="cancelButton" class="btn btn-danger" type="button">Cancelar</button>
      </form>
    </div>    <h3 style="font-weight: bold;">Alumnes</h3>
    <!-- Ficar recompte de tickets d'aquest curs i intervencions d'aquest curs i dades com el ultim curs agafat de la ultima intervencio -->
    <table id="table" class="table table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Correu</th>
          <th>Accions</th>
        </tr>
        <tr>
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