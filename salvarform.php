<?php
header('Content-type: application/json; charset=utf-8');

require_once 'dbconnect/database.class.php';

$objDB = new DataBase;
$email = '';
$telefono = '';
$identificacion = '';
$nombre = '';
$ejes = '';
$problema = '';
$solucion = '';
$video = '';

$id = filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT);
if(isset($_POST['email'])) { 
	$email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
}
if(isset($_POST['telefono'])) { 
	$telefono = filter_var($_POST['telefono'],FILTER_SANITIZE_STRING);
}
if(isset($_POST['identificacion'])) { 
	$identificacion = filter_var($_POST['identificacion'],FILTER_SANITIZE_STRING);
}
if(isset($_POST['nombre'])) { 
	$nombre = filter_var($_POST['nombre'],FILTER_SANITIZE_STRING);
}
if(isset($_POST['ejes'])) { 
	$ejes = filter_var($_POST['ejes'],FILTER_SANITIZE_STRING);
}
if(isset($_POST['problema'])) { 
	$problema = filter_var($_POST['problema'],FILTER_SANITIZE_STRING);
}
if(isset($_POST['solucion'])) { 
	$solucion = filter_var($_POST['solucion'],FILTER_SANITIZE_STRING);
}
if(isset($_POST['video'])) { 
	$video = filter_var($_POST['video'],FILTER_SANITIZE_STRING);
}


$employee_data = [
	'identificacion' => $identificacion,
	'nombre' => $nombre,
	'email' => $email,
	'telefono' => $telefono,
	'ejes' => $ejes,
    'problema' => $problema,
    'solucion' => $solucion,
    'video' => $video
];

if($id==0){ // Nuevo
	$r = $objDB->Insert('proposiciones', $employee_data);
	if($r['result']){
		$arr = ['resultado' => true, 'mensaje' => 'Registro añadido', 'id' => $r['insert_id'] ];
	}else{
		$arr = ['resultado' => false, 'mensaje' => $r['error']];
	}
}else{ // Update
	$r = $objDB->Update('proposiciones', $employee_data, ["id" => $id]);
	if($r['result']){
		$arr = ['resultado' => true, 'mensaje' => 'Registro actualizado' ];
	}else{
		$arr = ['resultado' => false, 'mensaje' => $r['error']];
	}
}
die(json_encode($arr));