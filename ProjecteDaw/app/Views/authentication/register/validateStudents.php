<style>
  #header {
    height: 110px;
    /* width:  100vw; */
  }
</style>

<?= $this->extend('layouts/mainLayout'); ?>
<?= $this->section("main_content"); ?>
<div class="row p-2 pb-0">
  <div class="col-6">
    <script>
      $(document).ready(function() {
        $('#table').DataTable({
          processing: true,
          serverSide: true,
          orderCellsTop: true,
          ajax: '<?= base_url('studentsByCenterId/' . session()->get('idCenter')) ?>',
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
  <div class="col-6">
    <form action="<?= base_url("/students") ?>" method="post" class="formAdd">
      <?= csrf_field(); ?>
      <div class="form-group my-4 ">
        <label for="mail"></label>
        <input class="form-control" type="text" placeholder="email.." name="mail" id="mail">
      </div>
      <div>
        <?= session()->getFlashdata('error') ?>
      </div>
      <div class="bottom-center pe-0 ">
        <input type="submit" class="btn btn-primary m-2">
      </div>
  </div>
  </form>
</div>
</div>
<?= $this->endSection(); ?>