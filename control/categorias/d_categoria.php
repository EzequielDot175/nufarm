<?php header('Content-Type: text/html; charset=utf-8');
include_once('../resources/control.php');
include_once('helper_titulos.php');
?>
<!DOCTYPE html>
<html>
<head>
	

	<!-- charset -->
	<meta charset="utf-8">
	<!-- Mobile Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<!-- Description -->
	<meta name="description" content="">

	<?php include_once('../resources/includes.php'); ?>

</head>
<body>

<!-- Header -->
	<?php include_once('../inc/header.php') ?>	

<div class="block">

<div class="three_4">
<?php

$id=$_GET['id'];

if(!$_POST['confirm'] && $_POST['pulsado']){$msgpulsado ='<div class="notify"><p>Debe marcar el campo de confirmacion para poder eliminar..</p></div>';}else{$msgpulsado="";}
echo $msgpulsado;
/* SELECT */
include_once("classes/class.categorias.php");
$categorias= new categorias();
$categorias->select($id);
$idCategorias=$categorias->getidCategorias();
$strDescripcion=$categorias->getstrDescripcion();
$talles=$categorias->gettalles();

if($_POST['confirm']){
$id=$_POST['id_categoria'];

/* DELETE */

include_once("classes/class.categorias.php");
$categorias= new categorias();
$categorias->select($id);
$categorias->delete($id);

#echo '<div class="notify"><p>!</p><p><a href="v_categorias.php">Regresar</a></p></div>';

$_SESSION['msg_ok'] = 'Categoria, eliminada!';
header('Location: '.BASEURL.'categorias/v_categorias.php');

}
else{
echo '<div class="item"><div class="dividerclean"><form action="d_categoria.php?id='.$id.'" id="simpleform" method="post">
		<div class="olive-bar"><h4>Eliminar categoria</h4></div>
	
			<div class="form-item">
				<label for=""></label>
				<p>Confirma Eliminar este categoria? <input type="checkbox" name="confirm" id="confirm" class="checkbox" /></p>
			</p> <input type="hidden" name="id_categoria" name="id_categoria" value="'.$id.'" />
			<input type="hidden" name="pulsado" value="1" />
			</div>
	
<div class="form-item">
<p><button name="btnborrar" class="button">Aceptar</button> 
<button type="button" class="button" onClick="location.href=\'v_categorias.php\'">Cancelar</button></div></p>
	
		
	</form></div></div>
';
}
?>	
</div>	
<?php include_once('../inc/footer.php') ?>
</div><!-- end block -->
</body></html>