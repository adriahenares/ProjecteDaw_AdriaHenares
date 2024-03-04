<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
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
        <table>
            <?php foreach ($interventions as $intervention) : ?>
                <td>
                    <a href="">
                        <p><?php echo $intervention['ticket_id']; ?></p>
                    </a>
                </td>
            <?php endforeach; ?>
        </table>
    </div>
    <div>
        <a href="/funcio add" class="btn btn-primary">Afegeix Intervencio</a>
    </div>
</body>

</html>