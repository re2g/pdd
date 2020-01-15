<?php
require_once 'dbconnect/database.class.php';

$objDB = new DataBase;

$identificacion = $_GET['identificacion'];
if($identificacion>0){
  // $result = $objDB->Execute("SELECT * FROM ciudadanos WHERE identificacion=$identificacion");
  $result = $objDB->Execute("SELECT * FROM ciudadanos WHERE identificacion=$identificacion");
  $ciudadano = $result->fetch_assoc();
  if($ciudadano<>"") {
    echo $ciudadano['nombre'];
  } else {
    echo 0;
  }
  
}

?>