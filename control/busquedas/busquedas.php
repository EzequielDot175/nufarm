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
	

<?php

$search = $_POST['busqueda'];

if(strlen($search) > 0){
	echo '<div class="three_4">
	<div class="resultado-busqueda">
	<div class="tit_busqueda">Busqueda para "'.$search.'" en Productos.</div>
	<div class="cont_busqueda">';
	include_once("../productos/classes/class.productos.php");
	$prod= new productos();
	$prod->select_busqueda($search);
	echo'</div>';
	
	// echo '<div class="tit_busqueda">Busqueda para "'.$search.'" en Canjes.</div>
	// <div class="cont_busqueda">';
	// include_once("../compras/classes/class.compras.php");
	// $canj= new compras();
	// $canj->select_busqueda($search);
	// echo'</div>';
	
	echo '<div class="tit_busqueda">Busqueda para "'.$search.'" en Clientes.</div>
	<div class="cont_busqueda">';
	include_once("../usuarios/classes/class.usuarios.php");
	$cli= new usuarios();
	$cli->select_busqueda($search);
	echo'</div>';
}else{

echo 'Debe ingresar una palabra a buscar.</div>';
echo '</div>';
}



?>
<div class="resultado-bottom"></div>
</div>
<?php include_once('../inc/footer.php') ?>
</body>
</html>