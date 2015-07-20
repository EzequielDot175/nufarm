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
		
		apellido: { 
			required: true, 
			minlength: 2 
			},
			
			login: { 
				required: true, 
				minlength: 2 
				},
				
				password: { 
					required: true, 
					minlength: 5 
					},
		     
      
      },
      messages: {
        nombre: { 
		required: " Complete Nombre", 
		minlength: "* 2 caracteres minimo." 
		},
		apellido: { 
		required: " Complete Apellido", 
		minlength: "* 2 caracteres minimo." 
		},
		login: { 
		required: " Complete Email", 
		minlength: "* 2 caracteres minimo." 
		},
		
		password: { 
		required: " Complete password", 
		minlength: "* 5 caracteres minimo." 
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

	<div class="item">

<form method="post" action="c_personal.php" id="simpleform" >
<div class="olive-bar"><h4>Crear personal</h4></div>

<div class="colform">
<div class="form-item">
<div class="tiform2">Nombre</div>
<input type="text" name="nombre" id="strNombre-2" value="<?php echo $nombre;?>" />
</div>


<div class="form-item">
<div class="tiform2">Apellido</div>
<input type="text" name="apellido" id="strApellido-2" value="<?php echo $apellido;?>" />
</div></div><!-- Fin col form -->

<div class="colform">
<div class="form-item">
<div class="tiform2">Login</div>
<input type="text" name="login" id="strLogin-2" value="" />
</div>


<div class="form-item">
<div class="tiform2">Password</div>
<input type="text" name="password" id="strPassword-2" value="<?php echo $password;?>" />
</div></div><!-- Fin colform -->


<div class="form-item">
<div class="tiform2">Tipo de acceso</div>
<select name="role" id="role">
	<option value="1">Administrador</option>
	<option value="2">Marketing</option>
	<option value="3" selected="selected">Ventas</option>
</select>

</div>


<div class="form-item">
<p><button type="submit" class="button">Aceptar</button> <button type="reset" class="button">Borrar</button> <button type="button" class="button" onClick="javascript:history.back(1)">Cancelar</button></p>
</div>

</fieldset>
</form>

</div></div>
<?php include_once('../inc/footer.php') ?>
</div>
</body>
</html>