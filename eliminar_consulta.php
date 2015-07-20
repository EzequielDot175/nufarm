<?php session_start(); ob_start();

$id_consulta =  $_POST['idconsulta'];

//eliminar respuestas de la consulta
include_once('includes/class.consultas.php');
$asoc = new consultas();
$asoc->delete_by_consulta($id_consulta);

//eliminar consulta
//eliminar respuestas de la consulta
include_once('includes/class.consultas.php');
$asoc = new consultas();
$asoc->select($id_consulta);
$asoc->delete($id_consulta);

//reenvio a mis_consultas.php

$_SESSION['mensaje'] = "Mensaje eliminado!";

header("Location: mi_cuenta.php?activo=2&del=1");
?>