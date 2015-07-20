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
       strNombre: { 
		required: true, 
		minlength: 2 
		},
		
		strApellido: { 
			required: true, 
			minlength: 2 
			},
			
			strEmail: { 
				required: true, 
				minlength: 2 
				},
		     
      
      },
      messages: {
        strNombre: { 
		required: " Complete Nombre", 
		minlength: "* 2 caracteres minimo." 
		},
		strApellido: { 
		required: " Complete Apellido", 
		minlength: "* 2 caracteres minimo." 
		},
		strEmail: { 
		required: " Complete Email", 
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
$("#vigencia_credito").datepicker({altFormat: 'yy-mm-dd'});

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
	<h2>Clientes</h2>

<form method="post" action="c_usuario.php" id="simpleform" >
<fieldset>
<legend><strong> &nbsp; Crear un nuevo cliente &nbsp; </strong></legend>

<div class="form-item">

<label for="cstrNombre">StrNombre</label>
<p><input type="text" name="strNombre" id="strNombre" /></p>

</div>

<div class="form-item">

<label for="cstrApellido">StrApellido</label>
<p><input type="text" name="strApellido" id="strApellido" /></p>

</div>

<div class="form-item">

<label for="cstrEmail">StrEmail</label>
<p><input type="text" name="strEmail" id="strEmail" /></p>

</div>

<div class="form-item">

<label for="cstrEmpresa">StrEmpresa</label>
<p><input type="text" name="strEmpresa" id="strEmpresa" /></p>

</div>

<div class="form-item">

<label for="cstrCargo">StrCargo</label>
<p><input type="text" name="strCargo" id="strCargo" /></p>

</div>

<div class="form-item">

<label for="cstrPassword">StrPassword</label>
<p><input type="text" name="strPassword" id="strPassword" /></p>

</div>




<div class="form-item">
<label for="direccion">direccion</label><input type="text" name="direccion" id="direccion"  /></div>

<div class="form-item">
<label for="telefono">telefono</label><input type="text" name="telefono" id="telefono"  /></div>

<div class="form-item">
<label for="nombre_contacto1">nombre_contacto1</label><input type="text" name="nombre_contacto1" id="nombre_contacto1"  /></div>

<div class="form-item">
<label for="apellido_contacto1">apellido_contacto1</label><input type="text" name="apellido_contacto1" id="apellido_contacto1"  /></div>

<div class="form-item">
<label for="email_contacto1">email_contacto1</label><input type="text" name="email_contacto1" id="email_contacto1"  /></div>

<div class="form-item">
<label for="nombre_contacto2">nombre_contacto2</label><input type="text" name="nombre_contacto2" id="nombre_contacto2"  /></div>

<div class="form-item">
<label for="apellido_contacto2">apellido_contacto2</label><input type="text" name="apellido_contacto2" id="apellido_contacto2"  /></div>

<div class="form-item">
<label for="email_contacto2">email_contacto2</label><input type="text" name="email_contacto2" id="email_contacto2"  /></div>

<div class="form-item">
<label for="logo">logo</label><input type="text" name="logo" id="logo"  /></div>


<div class="form-item">

<label for="cdblCredito">DblCredito</label>
<p><input type="text" name="dblCredito" id="dblCredito" /></p>

</div>


<div class="form-item">
<label for="vigencia_credito">vigencia_credito</label><input type="text" name="vigencia_credito" id="vigencia_credito"  /></div>

<div class="form-item">
<label for="vendedor">vendedor</label>
<select name="vendedor" id="vendedor">
	<?php  include_once('../personal/classes/class.personal.php');
		$ven = new personal();
		$ven->select_vendedores();
	?>
</select>
</div>



<div class="form-item">
<p><button type="submit">Aceptar</button> <button type="reset">Borrar</button> <button type="button" class="button" onClick="location.href=\'v_usuarios.php\'">Cancelar</button></p>
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

</body>
</html>