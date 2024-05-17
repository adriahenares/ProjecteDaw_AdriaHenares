

<h1>Confirmación de eliminación</h1>
<p>¿Estás seguro de que quieres eliminar el ticket con ID: <?= $id ?></p>
    <!-- <a href="<? redirect()->to('delTicket/'. $id)?>">Sí, eliminar</a> -->
    <a class="btn btn-danger" style="text-decoration: none;" href="<?= base_url('delTicket/' . $id) ?>">Sí, eliminar</a>
<a class="btn btn-primari" style="text-decoration: none;"  href="<?= base_url('viewTickets') ?>">Cancelar</a>