<?php header('Content-Type: text/html; charset=utf-8');
include_once('../resources/control.php');
include_once('helper_titulos.php');
?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once('../resources/control.php'); ?>
	<title></title>
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
<div id="top"></div>
<div id="bg1">
<div id="bg2">
<div id="bg3">
<div id="bg4">
<!-- Header -->
<div class="block">
	<?php include_once('../inc/header.php') ?>
	<div style="width:122px;height:1px;border-top:2px solid #AB3476;margin:-45px 0 0 496px;padding:0;display:block;float:left"></div>	
</div>


<div class="block">
	
	<div class="three_4">
	<div class="green-bar"><h4>Novedades</h4></div>
<?php


$id =$_GET['id'];
/* SELECT */
include_once("classes/class.novedades.php");
$novedades= new novedades();
$novedades->select($id);
$idNovedades=$novedades->getidNovedades();
$titulo=$novedades->gettitulo();
$cuerpo=$novedades->getcuerpo();
$imagen=$novedades->getimagen();
$fecha=$novedades->getfecha();

?>
<div class="item">
<form method="post" action="u_novedad.php" id="simpleform" enctype="multipart/form-data">

<div class="olive-bar"><h4>Editar novedad</h4></div>



<div class="colform">
<div class="form-item">
<div class="tiform2">Titulo</div>
<p><input type="text" name="titulo" id="titulo" value="<?php echo $titulo;?>" /></p>
</div></div> <!-- Fin colform -->

<div class="colform">
<div class="form-item">
<div class="tiform2">Fecha</div>
<p><input type="text" name="fecha" id="fecha" value="<?php echo $fecha;?>" /></p>
</div></div><!-- Fin colform -->



<div class="form-item">
<div class="tiform2">Cuerpo</div>
<p><textarea name="cuerpo" id="cuerpo" cols="30" rows="10"><?php echo $cuerpo;?></textarea></p>
</div>

<br />
<div class="olive-bar"><h4>Cargar imagen</h4></div>



<div class="form-item">
<?php 

if(strlen($imagen) > 1){
  echo '<img style="margin:0 auto; display:block; margin-bottom: 10px;margin-top:20px" src="'.BASEURLRAIZ.'/images-novedades/'.$imagen.'" alt="" height="100"/>';
}else{
  echo '<p>Sin imagen</p>';
}
?>
<div class="upload">
<input type="file" name="imagen" id="imagen" value="<?php echo $imagen;?>" /></div>
</div>


<input type="hidden" name="idNovedades" id="idNovedades" value="<?php echo $idNovedades; ?>" />

<div class="form-item">

<p><button type="submit" class="button">Aceptar</button> <button type="button" class="button" onclick="javascript:history.back(1)">Cancelar</button></p>

</div>



</fieldset>

</form>

	</div></div>
<div class="one_4">
<div id="welcome">
	<h3>Bienvenido <br /><?php  echo $_SESSION['logged_name']; ?> </h3>
   			<div class="prop"><?php  

include_once("../propuestas/classes/class.propuestas.php");
$prop= new propuestas();
$prop->sin_responder();


?></div>
	</div>
		<ul class="menusidebar">
             <li><a href="<?php  echo BASEURL.'/logout.php'?>">Cerrar sesion</a></li>
			<div style="width:218px;border-top:1px solid #ECCEDF; padding: 4px 0 0 0"></div>
			<li><a href="n_<?php echo $singular; ?>.php">Crear <?php echo $singular; ?></a></li>		
			
		</ul>

		
	</div>	
</div>

<?php include_once('../inc/footer.php') ?>
</div></div></div></div>
</body></html>