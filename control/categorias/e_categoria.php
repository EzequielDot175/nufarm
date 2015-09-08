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
<a class="btn-fill" href="<?php  echo BASEURL.'productos/n_producto.php?activo=2&sub=d';?>"><span><p>Crear nuevo producto</p></span></a>
<a class="btn-fill"href="<?php  echo BASEURL.'categorias/v_categorias.php?activo=2&sub=d';?>"><span><p>Administrar Categorías</p></span></a>
<a class="btn-fill" href="<?php  echo BASEURL.'talles/v_talles.php?activo=2&sub=d';?>"><span><p>Administrar Talles</p></span></a>
</div>
<?php

$id =$_GET['id'];
/* SELECT */
include_once("classes/class.categorias.php");
$categorias= new categorias();
$categorias->select($id);
$idCategorias=$categorias->getidCategorias();
$strDescripcion=$categorias->getstrDescripcion();
$talles=$categorias->gettalles();

?>
<div id="content-prod">

<form method="post" action="u_categoria.php" id="box-cat-edit">
<div class="barra-prod"><span>ADMINISTRAR CATEGORÍAS</span></div>
<div style="width:100%;height:30px;float:left;display:block"></div>
<div class="colform-cat-edit">
<div class="form-item">
<div class="tiform6">Descripcion</div>
<input type="text" name="strDescripcion" id="strNombre" value="<?php echo $strDescripcion;?>" />
</div></div><!-- Fin colform -->

<div class="colform-cat-edit">
<div class="form-item">
<div class="tiform6">Talles</div>
<select name="talles" id="role">
	<option value="0" <?php if($talles==0){echo'selected';} ?>>NO requiere talles ni colores</option>
	<option value="1"<?php if($talles==1){echo'selected';} ?>>SI requiere talles</option>
	<option value="2"<?php if($talles==2){echo'selected';} ?>>SI requiere colores</option>
	<option value="3"<?php if($talles==3){echo'selected';} ?>>SI requiere talles y colores</option>
</select>

</div>
<div class="colBtn-cat">
<input type="hidden" name="idCategorias" id="idCategorias" value="<?php echo $idCategorias; ?>" />
<p><button type="submit" class="button7">Aceptar</button> <button type="button" class="button7" onclick="javascript:history.back(1)">Cancelar</button></p>
</div>
</div><!-- Fin colform -->


</form>
</div>



<?php include_once('../inc/footer.php') ?>
</div><!-- end block -->
</body></html>