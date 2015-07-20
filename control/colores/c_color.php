<?php session_start();
include_once('../resources/control.php');


$nombre_color=$_POST['nombre_color'];

/* INSERT */
include_once("classes/class.colores.php");
$colores= new colores();
$colores->nombre_color=$nombre_color;

$colores->insert();

$_SESSION['msg_ok'] = 'Color Creado!';
header('Location: ../colores/v_color.php?activo=2&sub=d');

?>