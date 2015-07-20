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
       strDescripcion: { 
		required: true, 
		minlength: 2 
		},
		     
      
      },
      messages: {
        strDescripcion: { 
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
</div>

<div id="content-prod">

<form method="post" action="c_categoria.php" id="box-cat-edit">
<div class="barra-prod"><span>CREAR CATEGORÍAS</span></div>
<div style="width:100%;height:30px;float:left;display:block"></div>

<div class="colform-cat-edit">
<div class="form-item">
<div class="tiform6">Descripcion</div>
<p><input type="text" name="strDescripcion" class="campo-prod" /></p>
</div></div><!-- Fin colform -->

<div class="colform-cat-edit">
<div class="form-item">
<div class="tiform6">Talles</div>


<p><select name="talles" id="talles-cat">
	<option value="0" <?php if($talles==0){echo'selected';} ?>>NO requiere talles</option>
	<option value="1"<?php if($talles==1){echo'selected';} ?>>SI requiere talles</option>
</select>

</p>

</div>
<div class="colBtn-cat2">
<p><button type="submit" class="button7">GUARDAR</button>  
<button type="button" class="button7" onClick="location.href='v_categorias.php?activo=2&sub=d'">CANCELAR</button></p>
</div>
</div><!-- Fin colform -->






</form>

</div>	
<?php include_once('../inc/footer.php') ?>
</div>
</body></html>
