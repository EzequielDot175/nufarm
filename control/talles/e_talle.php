<?php header('Content-Type: text/html; charset=utf-8');
include_once('../resources/control.php');
include_once('helper_titulos.php');
?>
<!DOCTYPE html>
<html>
<head>

	<title></title>
	


	<!-- charset -->
	<meta charset="utf-8">
	<!-- Mobile Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<!-- Description -->
	<meta name="description" content="">

	<?php include_once('../resources/includes.php'); ?>



</head>



<script type="text/javascript"> 
$(document).ready(function(){
    $("#simpleform").validate({
      event: "blur",
      rules: {
       strDescripcion: { 
		required: true, 
		minlength: 2 
		},
		     
      
      },
      messages: {
        strDescripcion: { 
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
</div>

<?php

$id =$_GET['id'];
/* SELECT */
include_once("classes/class.talles.php");
$talles= new talles();
$talles->select($id);
$id_talle=$talles->getid_talle();
$nombre_talle=$talles->getnombre_talle();


?>
<div id="content-talle">
<div class="barra-prod"><span>Editar talle</span></div>
<form method="post" action="u_talle.php" id="simpleform"  >

<div class="box-form">
<div class="form-item">
<div class="tiform6-2">Nombre de talle</div>
<input type="text" name="nombre_talle" class="campo-prod2" value="<?php echo $nombre_talle;?>" />
</div>
</div>


<div class="box-form-btn">
<input type="hidden" name="id_talle" id="id_talle" value="<?php echo $id_talle; ?>" />
<div class="btn-talle">
<p><button type="submit" class="button7">Aceptar</button> <button type="button" class="button7" onclick="javascript:history.back(1)">Cancelar</button></p>
</div>

</div>


</form>
</div></div>
	
	
<?php include_once('../inc/footer.php') ?></div><!-- end block -->



</body></html>