<?php header('Content-Type: text/html; charset=utf-8');
include_once('../resources/control.php');
include_once('helper_titulos.php');
?>
<?php
$idCategorias = $_POST['idCategorias'];
$strDescripcion=$_POST['strDescripcion'];
$talles=$_POST['talles'];


/* UPDATE */
include_once("classes/class.categorias.php");
$categorias= new categorias();

$categorias->select($idCategorias);
$categorias->idCategorias=$idCategorias;
$categorias->strDescripcion=$strDescripcion;
$categorias->talles=$talles;
$categorias->update($idCategorias);


#echo '<div class="notify"><p>categoria actualizada!</p><p><a href="v_categorias.php">Regresar</a></p></div>';

$_SESSION['msg_ok'] = 'Categoria, actualizada!';
header('Location: '.BASEURL.'categorias/v_categorias.php?activo=2&sub=d');
?>	
