<?php session_start();
include_once('../resources/control.php');


$nombre_talle=$_POST['nombre_talle'];

/* INSERT */
include_once("classes/class.talles.php");
$talles= new talles();
$talles->nombre_talle=$nombre_talle;

$talles->insert();

$_SESSION['msg_ok'] = 'talle Creado!';
header('Location: ../talles/v_talles.php');

?>