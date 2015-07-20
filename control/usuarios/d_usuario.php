<?php session_start(); error_reporting(0); header('Content-Type: text/html; charset=utf-8');
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
	<div class="product_filter_vend_column_users">
<nav id="interna2">
<ul>
	<li><a class="btn-micuenta5" href="n_<?php echo $singular; ?>.php?activo=2&sub=e"><span>Crear cliente nuevo</span></a></li>
	
</ul>
</nav>
<?php 
include_once("../compras/classes/class.compras.php");
$compras2= new compras();
$compras2->select_all_vendedores_clientes();
?>
</div>
<?php

$id=$_GET['id'];

if(!$_POST['confirm'] && $_POST['pulsado']){$msgpulsado ='<div class="notify"><p>Debe marcar el campo de confirmacion para poder eliminar..</p></div>';}else{$msgpulsado="";}
echo $msgpulsado;
/* SELECT */
include_once("classes/class.usuarios.php");
$usuarios= new usuarios();
$usuarios->select($id);
$idUsuario=$usuarios->getidUsuario();
$strNombre=$usuarios->getstrNombre();
$strApellido=$usuarios->getstrApellido();
$strEmail=$usuarios->getstrEmail();
$strEmpresa=$usuarios->getstrEmpresa();
$strCargo=$usuarios->getstrCargo();
$strPassword=$usuarios->getstrPassword();
$dblCredito=$usuarios->getdblCredito();

if($_POST['confirm']){
$id=$_POST['id_usuario'];

/* DELETE */

include_once("classes/class.usuarios.php");
$usuarios= new usuarios();
$usuarios->select($id);
$usuarios->delete($id);

echo '<div class="notify_ok-ok"><p>usuario, eliminado!</p></div>';
$_SESSION['msg_ok'] = 'Usuario, eliminado!';
header('Location: '.BASEURL.'/usuarios/v_usuarios.php');
}
else{
echo '
<div class="item-content-user-edit">
<form action="d_usuario.php?id='.$id.'" id="simpleform" method="post">
	<div class="barra-prod-edit"><span>Eliminar un cliente</span></div>

	<div class="form-item">
	<label for=""></label>
	<span>Confirma Eliminar este usuario? <input type="checkbox" name="confirm" id="confirm" class="checkbox" /></span>
	<input type="hidden" name="id_usuario" name="id_usuario" value="'.$id.'" />
	<input type="hidden" name="pulsado" value="1" />
			
<div class="form-item" style="margin-left:10px;">
<button name="btnborrar" class="button">Aceptar</button> 
<button type="button" class="button" onClick="location.href=\'v_usuarios.php?activo=2&sub=e\'">Cancelar</button>
</div>
</div>
</form></div>
';
}
?>
</div>
<?php include_once('../inc/footer.php') ?></div>


</body>
</html>