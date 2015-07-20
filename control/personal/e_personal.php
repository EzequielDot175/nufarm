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

	<div class="product_filter_consulta_column">
<div class="item">

<a href=""><div class="olive-bar_new3"><span>VER TODOS</span></div></a>

</div><div class="item">



	<a href=""><div class="pub-eve"><span>ADMINISTRADOR</span></div></a>

	<a href=""><div class="pub-eve"><span>MARKETING</span></div></a>
	
	<a href=""><div class="pub-eve"><span>VENTA</span></div></a>

	</div></div>		
<?php

$id =$_GET['id'];
/* SELECT */
include_once("classes/class.personal.php");
$personal= new personal();
$personal->select($id);
$id=$personal->getid();
$nombre=$personal->getnombre();
$apellido=$personal->getapellido();
$login=$personal->getlogin();
$role=$personal->getrole();
$password=$personal->getpassword();
$idpersonal = $id;
?>
<div id="content-consultas">
<form method="post" action="u_personal.php" id="form-bg-personal"  >

<div class="respuesta2"><p>Crear personal</p></div>

<div class="colform-personal">
<div class="form-item">
<div class="tiform2">Nombre</div>
<input type="text" name="nombre" class="campo-prod" value="<?php echo $nombre;?>" />
</div>


<div class="form-item">
<div class="tiform2">Apellido</div>
<input type="text" name="apellido" class="campo-prod" value="<?php echo $apellido;?>" />
</div>

<div class="form-item">
<div class="tiform2">Tipo de acceso</div>
<select name="role" class="campo-prod">
<option value="1" <?php if($role ==1){ echo 'selected="selected"';};?>>Administrador</option>
<option value="2" <?php if($role ==2){ echo 'selected="selected"';};?>>Marketing</option>
<option value="3" <?php if($role ==3){ echo 'selected="selected"';};?>>Ventas</option>
</select>

</div>

</div><!-- Fin colform -->

<div class="colform-personal">
<div class="form-item">
<div class="tiform2">Login</div>
<input type="text" name="login" class="campo-prod" value="<?php echo $login;?>" />
</div>


<div class="form-item">
<div class="tiform2">Password</div>
<input type="text" name="password" class="campo-prod" value="<?php echo $password;?>" />
</div>
</div><!-- Fin colform -->




<input type="hidden" name="idpersonal" id="idpersonal" value="<?php echo $idpersonal; ?>" />
<div class="form-item">
<p style="margin-left:23px;float:left"><button type="submit" class="button7">Aceptar</button> <button type="button" class="button7" onclick="javascript:history.back(1)">Cancelar</button></p>
</div>

</fieldset>
</form>
</div>
</div></div>

<?php include_once('../inc/footer.php') ?>
</div></div></div>
</body>
</html>