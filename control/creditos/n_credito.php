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
<div class="block">
	<header>
		<div class="conttitle">
			<h1>Admin</h1>
		</div>
		
		<div class="contnav">
			<nav>
				<ul>
				<?php include('../inc/main_menu.php'); ?>
				</ul>
			</nav>
		</div>
		
	</header>
</div>
<div class="block">
	<div class="one_4"><h4>Opciones</h4>

		<ul class="menusidebar">

			<li><a class="active" href="n_<?php echo $singular; ?>.php">Crear <?php echo $singular; ?></a></li>

		</ul>

		
	</div>
	<div class="three_4">

<form method="post" action="c_credito.php" id="simpleform" >
<fieldset>
<legend><strong> &nbsp; creditos &nbsp; </strong></legend>

<div class="form-item">

<label for="cidUsuario">IdUsuario</label>
<p><input type="text" name="idUsuario" id="idUsuario" /></p>

</div>

<div class="form-item">

<label for="cidProducto">IdProducto</label>
<p><input type="text" name="idProducto" id="idProducto" /></p>

</div>


<div class="form-item">
<p><button type="submit">Aceptar</button> <button type="reset">Borrar</button> <button type="button" class="button" onClick="location.href=\'v_creditos.php\'">Cancelar</button></p>
</div>

</fieldset>
</form>
	</div>
	
</div>

<div class="block">
	<footer>
		<div class="block">
			<div class="full"><h5 style="text-align:right;">Designed/Crafted 2012 | www.BuenosWeb.com</h5></div>
		</div>
		

	</footer>
</div>

<!-- JQuery -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

</body>
</html>