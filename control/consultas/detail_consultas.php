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
<div class="block">
	<?php include_once('../inc/header.php') ?>	
</div>




<div class="block">

<div class="three_4">
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
echo "<p>De:: ".$nombre_usuario." ".$apellido_usuario.", <!--<a href=\"mailto:$email_usuario\">".$email_usuario."</a> --> Empresa: ".$empresa_usuario."</p>";
?>
<form method="post" action="u_consulta.php" id="simpleform"  >
<fieldset>
<legend><strong> &nbsp; consultas &nbsp; </strong></legend>





<div class="form-item">
<label for="cstrAsunto">StrAsunto</label>
<input type="text" name="strAsunto" id="strAsunto" value="<?php echo $strAsunto;?>" />
</div>


<div class="form-item">
<label for="cstrCampo">StrCampo</label>

<textarea name="strCampo" id="strCampo" cols="30" rows="10"><?php echo $strCampo;?></textarea>
</div>

<input type="hidden" name="idConsulta" id="idConsulta" value="<?php echo $idConsulta; ?>" />
<div class="form-item">
<p><button type="submit">Aceptar</button> <button type="button" class="btnback" onclick="javascript:history.back(1)">Cancelar</button></p>
</div>

</fieldset>
</form>

</div>

<div class="one_4"><h4>Opciones</h4>

		<ul class="menusidebar">

			<li><a class="active" href="n_<?php echo $singular; ?>.php">Crear <?php echo $singular; ?></a></li>

		</ul>

		
	</div>



</div>

<?php include_once('../inc/footer.php') ?>