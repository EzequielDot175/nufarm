<?php include_once('../resources/control.php'); header('Content-Type: text/html; charset=utf-8');



$strDescripcion=$_POST['strDescripcion'];
$talles=$_POST['talles'];


/* INSERT */
include_once("classes/class.categorias.php");
$categorias= new categorias();
$categorias->idCategorias=$idCategorias;
$categorias->strDescripcion=$strDescripcion;
$categorias->talles=$talles;
$categorias->insert();

$_SESSION['msg_ok'] = 'categoria Creada!';
header('Location: '.BASEURL.'/categorias/v_categorias.php');
?>