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

<form method="post" action="c_consulta.php" id="simpleform" >
<fieldset>
<legend><strong> &nbsp; consultas &nbsp; </strong></legend>

<div class="form-item">

<label for="cidUsuario">IdUsuario</label>
<p><input type="text" name="idUsuario" id="idUsuario" /></p>

</div>

<div class="form-item">

<label for="cstrAsunto">StrAsunto</label>
<p><input type="text" name="strAsunto" id="strAsunto" /></p>

</div>

<div class="form-item">

<label for="cstrCampo">StrCampo</label>
<p><input type="text" name="strCampo" id="strCampo" /></p>

</div>


<div class="form-item">
<p><button type="submit">Aceptar</button> <button type="reset">Borrar</button> <button type="button" class="button" onClick="location.href=\'v_consultas.php\'">Cancelar</button></p>
</div>

</fieldset>
</form>
	</div>

<div class="one_4"><h4>Opciones</h4>

		<ul class="menusidebar">

			<!--<li><a class="active" href="n_<?php echo $singular; ?>.php">Crear <?php echo $singular; ?></a></li>-->
			
			<li>
			<?php  
			include_once("classes/class.consultas.php");
			$consu= new consultas();
			$consu->sin_responder();
			?>
			</li>

		</ul>

		
	</div>


</div>

<?php include_once('../inc/footer.php') ?>