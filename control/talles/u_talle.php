<?php header('Content-Type: text/html; charset=utf-8');
include_once('../resources/control.php');
include_once('helper_titulos.php');
?>

<?php
$id_talle = $_POST['id_talle'];
$nombre_talle=$_POST['nombre_talle'];



/* UPDATE */
include_once("classes/class.talles.php");
$talles= new talles();

$talles->select($id_talle);
$talles->nombre_talle=$nombre_talle;
$talles->update($id_talle);


#echo '<div class="notify"><p>talle actualizada!</p><p><a href="v_talles.php">Regresar</a></p></div>';

$_SESSION['msg_ok'] = 'talle, actualizado!';
header('Location: '.BASEURL.'/talles/v_talles.php');
?>	
