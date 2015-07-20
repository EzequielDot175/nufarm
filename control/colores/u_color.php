<?php header('Content-Type: text/html; charset=utf-8');
include_once('../resources/control.php');
include_once('helper_titulos.php');

$id_color = $_POST['id_color'];
$nombre_color=$_POST['nombre_color'];



/* UPDATE */
include_once("classes/class.colores.php");
$colores= new colores();

$colores->select($id_color);
$colores->nombre_color=$nombre_color;
$colores->update($id_color);


#echo '<div class="notify"><p>talle actualizada!</p><p><a href="v_talles.php">Regresar</a></p></div>';

$_SESSION['msg_ok'] = 'Color, actualizado!';
header('Location: '.BASEURL.'/colores/v_color.php?activo=2&sub=d');
?>	
