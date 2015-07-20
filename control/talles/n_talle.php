<?php header('Content-Type: text/html; charset=utf-8');
include_once('../resources/control.php');
include_once('helper_titulos.php');
?>
<!DOCTYPE html>
<html>
<head>

	<?php include_once('../resources/includes.php'); ?>
	
	

	<!-- charset -->
	<meta charset="utf-8">
	<!-- Mobile Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<!-- Description -->
	<meta name="description" content="">


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
       nombre_talle: { 
		required: true, 
		minlength: 1 
		},
		     
      
      },
      messages: {
        nombre_talle: { 
		required: " Complete nombre", 
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

<div id="content-talle">
<div class="barra-prod"><span>Nuevo talle</span></div>

<form method="post" action="c_talle.php?activo=2&sub=d" id="simpleform" >

<div class="box-form">
<div class="form-item">
<div class="tiform6">Nombre de talle</div>
<input type="text" name="nombre_talle" class="campo-prod" />
</div>
</div>

<div class="box-form-btn-talle">
<p><button type="submit" class="button7">Aceptar</button>
<button type="button" class="button7" onClick="location.href='v_talles.php?activo=2&sub=d'">Cancelar</button></p>
</div>

</form>

</div></div>
<?php include_once('../inc/footer.php') ?>
</div>
</body></html>

