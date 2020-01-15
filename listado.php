<link rel='stylesheet' href='css/bootstrap.min.css'>
<?php
require_once 'dbconnect/database.class.php';

$objDB = new DataBase;

$result = $objDB->Execute('SELECT * FROM proposiciones');
?>
<body>
<div class="content-fluid">
  <br />
<table class="table table-striped table-responsive table-bordered" width="80%">
  <tr>
    <th>Identificación</th>
    <th>Nombre</th>
    <th>Email</th>
    <th>Teléfono</th>
    <th>Ejes</th>
    <th>Problema</th>
    <th>Solución</th>
    <th>Video</th>
  </tr>
<?php
while($employee = $result->fetch_assoc()){
  ?>
  <tr>    
    <td><?= $employee['identificacion'] ?></td>
    <td><?= $employee['nombre'] ?></td>
    <td><?= $employee['email'] ?></td>
    <td><?= $employee['telefono'] ?></td>
    <td><?= $employee['ejes'] ?></td>
    <td><?= $employee['problema'] ?></td>
    <td><?= $employee['solucion'] ?></td>    
    <td><?php if(!empty($employee['video'])) : ?><a href="uploads/<?= $employee['video'] ?>" target="blank">Video</a><?php endif; ?></td>
  </tr>
  <?php
}
?>
</table>
</div>
</body>