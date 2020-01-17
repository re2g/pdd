<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">

<script src="https://code.jquery.com/jquery-3.4.1.min.js"  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"  crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"  crossorigin="anonymous"></script>
<?php
require_once 'dbconnect/database.class.php';

$objDB = new DataBase;

$result = $objDB->Execute('SELECT * FROM proposiciones');
$contador = 1;
?>
<body>
<div class="container-fluid" >
  <br />
<table id="example" class="table table-striped table-bordered" style="width:100%">
<thead>
  <tr>
    <th># Items</th>
    <th>Nombre</th>
    <th>Email</th>
    <th>Teléfono</th>
    <th>Ejes</th>
    <th>Problema</th>
    <th>Solución</th>
    <th>Video</th>
  </tr>
</thead>
<tbody>
<?php
while($employee = $result->fetch_assoc()){
  ?>
  <tr>    
    <td class="text-center"><?=$contador?></td>
    <td><?= $employee['nombre'] ?></td>
    <td><?= $employee['email'] ?></td>
    <td><?= $employee['telefono'] ?></td>
    <td><?= $employee['ejes'] ?></td>
    <td><?= $employee['problema'] ?></td>
    <td><?= $employee['solucion'] ?></td>    
    <td><?php if(!empty($employee['video'])) : ?><a href="uploads/<?= $employee['video'] ?>" target="blank">Video</a><?php endif; ?></td>
  </tr>
  <?php
  $contador = $contador + 1;
}
?>
</tbody>
</table>
</div>
<script>
$(document).ready(function() {
  $('#example').DataTable({
        "pageLength": 100,
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        }
  });
});
</script>

</body>