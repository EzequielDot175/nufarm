<?php header('Content-Type: text/html; charset=utf-8');
include_once('../resources/control.php');
include_once('helper_titulos.php');
?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once('../resources/control.php'); ?>
	<title></title>
	<link rel="stylesheet" type="text/css" media="all" href="../layout/main.css" />
	<link rel="stylesheet" type="text/css" media="all" href="../layout/base.css" />
	<link rel="stylesheet" type="text/css" media="all" href="../layout/header-footer-columns.css" />
	<link rel="stylesheet" type="text/css" media="all" href="../layout/forms.css" />

	<!-- charset -->
	<meta charset="utf-8">
	<!-- Mobile Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<!-- Description -->
	<meta name="description" content="">

<?php include_once('../resources/includes.php'); ?>
<script type="text/javascript">
function changueoferta(div){
$('#oferta'+div).load('changue_oferta.php?id='+div);
}
</script>
<script type="text/javascript"> 
$(document).ready(function(){
    $("#simpleform").validate({
      event: "blur",
      rules: {
       nombre: { 
		required: true, 
		minlength: 2 
		},
		     
      
      },
      messages: {
        nombre: { 
		required: " Complete nombre de tipo", 
		minlength: "* 2 caracteres minimo." 
		},
			
             
        },
      debug: true,
      errorElement: "p",
      submitHandler: function(form){
         //alert('Los datos seran enviados');
          form.submit();
      }
   });
});
</script> 
<script type="text/javascript">
$(function() {
$("#fecha").datepicker({altFormat: 'yy-mm-dd'});

});
</script>
</head>
<body>

<!-- Header -->

	<?php include_once('../inc/header.php') ?>

<div class="block">
	
<div class="three_4">

<div class="item-group-btn">
<a class="btn-fill" href="<?php  echo BASEURL.'/productos/n_producto.php?activo=2&sub=d';?>"><span><p>Crear nuevo producto</p></span></a>
<a class="btn-fill"href="<?php  echo BASEURL.'/categorias/v_categorias.php?activo=2&sub=d';?>"><span><p>Administrar Categorías</p></span></a>
<a class="btn-fill" href="<?php  echo BASEURL.'/talles/v_talles.php?activo=2&sub=d';?>"><span><p>Administrar Talles</p></span></a>
<a class="btn-fill" href="<?php  echo BASEURL.'/colores/v_color.php?activo=2&sub=d';?>"><span><p>Administrar Colores</p></span></a>
</div>

<?php

$id=$_GET['id'];

// if(!$_POST['confirm'] && $_POST['pulsado']){$msgpulsado ='<div class="notify"><p>Debe marcar el campo de confirmacion para poder eliminar..</p></div>';}else{$msgpulsado="";}
// echo $msgpulsado;
/* SELECT */
include_once("classes/class.productos.php");
$productos= new productos();
$productos->select($id);
$idProducto=$productos->getidProducto();
$strNombre=$productos->getstrNombre();
$strDetalle=$productos->getstrDetalle();
$intCategoria=$productos->getintCategoria();
$dblPrecio=$productos->getdblPrecio();
$intStock=$productos->getintStock();
$strImagen=$productos->getstrImagen();
$strImagen2=$productos->getstrImagen2();
$strImagen3=$productos->getstrImagen3();

if($_POST['confirm']){
$id=$_POST['id_producto'];

/* DELETE */

include_once("classes/class.productos.php");
$productos= new productos();
$productos->select($id);
$productos->delete($id);

#echo '<div class="notify"><p>producto, eliminado!</p><p><a href="v_productos.php">Regresar</a></p></div>';
$_SESSION['msg_ok'] = 'Producto Eliminado!';
header('Location: '.BASEURL.'productos/v_productos.php?activo=2&sub=d');
}
else{
echo '

<div class="item-content-prod-edit">
<form action="d_producto.php?id='.$id.'&activo=2&sub=d&confirm=true" id="simpleform" method="post">
		<div class="barra-prod-edit"><span>Eliminar producto</span></div>
	
			<div class="form-item">
				<label for=""></label>
				<span>Confirma Eliminar este producto? <input type="checkbox" name="confirm" id="confirm" class="checkbox" /></span>
			</p> <input type="hidden" name="id_producto" name="id_producto" value="'.$id.'" />
			<input type="hidden" name="pulsado" value="1" />
			</div>
	
<div class="form-item">
<p><button name="btnborrar" class="button">Aceptar</button> 
<button type="button" class="button" onClick="location.href=\'v_productos.php?activo=2&sub=d\'">Cancelar</button></div></p>

</form>
</div>
';
}
?>	
</div>
<?php include_once('../inc/footer.php') ?></div>


</body>
</html>