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



<!-- Header -->
	<?php include_once('../inc/header.php') ?>

<div class="block">
	
<div class="three_4">
<?php

$id=$_GET['id'];

if(!$_POST['confirm'] && $_POST['pulsado']){$msgpulsado ='<div class="notify"><p>Debe marcar el campo de confirmacion para poder eliminar..</p></div>';}else{$msgpulsado="";}
echo $msgpulsado;
/* SELECT */
include_once("classes/class.consultas.php");
$consultas= new consultas();
$consultas->select($id);
$idConsulta=$consultas->getidConsulta();
$idUsuario=$consultas->getidUsuario();
$strAsunto=$consultas->getstrAsunto();
$strCampo=$consultas->getstrCampo();

if($_POST['confirm']){
$id=$_POST['id_consulta'];

/* DELETE */

include_once("classes/class.consultas.php");
$consultas= new consultas();
$consultas->select($id);
$consultas->delete($id);


echo 'Consulta, eliminada!
<p>
<br><br>

<a class="btn-micuenta4" href="'.BASEURL.'consultas/v_consultas.php?activo=2&sub=f">Regresar</a></p>
';
#header('Location: '.BASEURL.'/consultas/v_consultas.php');


}
else{
echo '<div class="item">
<div class="dividerclean"><form action="d_consulta.php?id='.$id.'" id="simpleform" method="post">
		<div class="olive-bar"><h4>Consulta</h4></div>
	
			<div class="form-item">
				<label for=""></label>
				<p>Confirma Eliminar este consulta? <input type="checkbox" name="confirm" id="confirm" class="checkbox" /></p>
			</p> <input type="hidden" name="id_consulta" name="id_consulta" value="'.$id.'" />
			<input type="hidden" name="pulsado" value="1" />
			</div>
	
<div class="form-item">
<p><button name="btnborrar" class="button">Aceptar</button> 
<button type="button" class="button" onClick="location.href=\'v_consultas.php\'">Cancelar</button></div></p>
	
		
	</form></div></div>
';
}
?>	

</div>
<?php include_once('../inc/footer.php') ?>
</div>
</body></html>