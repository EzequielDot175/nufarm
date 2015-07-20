<?php header('Content-Type: text/html; charset=utf-8');
include_once('../resources/control.php');
include_once('helper_titulos.php');
?>
<!DOCTYPE html>
<html>
<head>

	<?php include_once('../resources/includes.php'); ?>
	
	
	<style type="text/css">
	.item_respuesta{
		width: 93%; float: left; margin: .5em 0;padding: 0; 
	}
	</style>
	

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

$(document).ready(function(){$('#strCampo').focus()});
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
		<div class="item2">

<div class="product_filter_consulta_column2">
<div class="item">

<a href=""><div class="olive-bar_new3"><span>VER TODOS</span></div></a>

</div><div class="item">



	<a href=""><div class="pub-eve"><span>NO LEIDO</span></div></a>

	<a href=""><div class="pub-eve2"><span>PENDIENTE</span></div></a>
	
	<a href=""><div class="pub-eve4"><span>RESPONDIDA</span></div></a>

	</div></div>		
		
<?php

$id =$_GET['id'];
/* SELECT */
include_once("classes/class.consultas.php");
$consultas= new consultas();
$consultas->select($id);
$idConsulta=$consultas->getidConsulta();
$idUsuario=$consultas->getidUsuario();
$strAsunto=$consultas->getstrAsunto();
$strCampo=$consultas->getstrCampo();

?>

<?php
include_once("../usuarios/classes/class.usuarios.php");
$user_info= new usuarios();
$user_info->select($idUsuario);
$nombre_usuario = $user_info->getstrNombre();
$apellido_usuario = $user_info->getstrApellido();
$email_usuario = $user_info->getstrEmail();
$empresa_usuario = $user_info->getstrEmpresa();

echo "
<div id='content-consultas'>
<div class='bar-consultas'>

<span>CLIENTE: ".$nombre_usuario."  ".$apellido_usuario."  Empresa: ".$empresa_usuario."  Email: ".$email_usuario."</span>
</div>
";

?>
<form method="post" action="process_consulta.php" id="simpleform"  >


<div class="form-item">

</div>

<div class="item_respuesta2">
<?php
	
 echo '
<div class="box-consulta-g">
<div class="box-asunto-consulta"><span>Asunto: <h4>'.utf8_decode($strAsunto).'</h4></span> </div>
</div>

<div style="margin:10px 0 0 10px;float:left;color:#008B39">
'.utf8_decode($strCampo).'	
</div>

 ';

 ?>

</div>

<div style="width:100%;margin-top:40px; float:left;">
<div class="form-item-consultas">
<div class="tiform6">Respuesta:</div>

<textarea name="strCampo" id="strDetalle-consulta" style="width: 93%" rows="10">
</textarea>
</div>

<input type="hidden" name="idConsulta" id="idConsulta" value="<?php echo $idConsulta; ?>" />
<div class="form-item">
<p><button type="submit" class="button">Aceptar</button> <button type="button" class="button" onclick="javascript:history.back(1)">Cancelar</button>
</div>


</form></div>

</div></p></div></div>
	
	
	
	
<?php include_once('../inc/footer.php') ?></div>


</body>
</html>