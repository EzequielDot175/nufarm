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
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview4').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
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

<style>
	#historial-usuario {
	width: 96% !important;
	margin: 0 17px 0 0 !important;
	display: block;
	float: right;
	color: #333;
	overflow: hidden;
	}
	.pubeev-historial {
	margin: 0 40px 0 0 !important;
	}
</style>

</head>
<body>
<!-- Header -->
	<?php include_once('../inc/header.php') ?>
<div class="block">
	 <div class="general_container ">

      <div class="three_444 contenedor-default ">

<!-- botones administrar -->
	<!--
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
-->
<?php

$id =$_GET['id'];
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
$dblAsignado=$usuarios->getdblAsignado();
$dblConsumido=$usuarios->getdblConsumido();

$direccion=$usuarios->getdireccion();
$telefono=$usuarios->gettelefono();
$nombre_contacto1=$usuarios->getnombre_contacto1();
$apellido_contacto1=$usuarios->getapellido_contacto1();
$email_contacto1=$usuarios->getemail_contacto1();

$nombre_contacto2=$usuarios->getnombre_contacto2();
$apellido_contacto2=$usuarios->getapellido_contacto2();
$email_contacto2=$usuarios->getemail_contacto2();

$logo=$usuarios->getlogo();

$vigencia_credito=$usuarios->getvigencia_credito();

$vendedor=$usuarios->getvendedor();


list($anio, $mes, $dia) = explode('-', $vigencia_credito);
$vigencia_credito = $dia.'-'.$mes.'-'.$anio;  

?>
<div class="editar_container">
<div class="barra-prod"><span>CLIENTE</span></div>

<form method="post" action="u_usuario.php" id="simpleform" enctype="multipart/form-data" >

<div class="columna_form_c">

<div class="box-col-left">
<?php if($logo != ""){echo '<img id="preview1" src="../../images-clientes/'.$logo.'" alt="" width="120" />';}else{echo '<img id="preview4" src="../../images_productos/default.png" alt="" width="100" />';}  ?>
<div class="upload3">
<input type="file" name="logo" id="banner-logo"  value="<?php echo $logo ; ?>" onchange="readURL(this);" /></div>
</div>

<div class="box-col-right">
<div class="tiform6">Empresa</div>
<input type="text" name="strEmpresa" class="campo-prod" value="<?php echo $strEmpresa;?>" />
</div>

</div>

<div class="row">
<!-- Columna 1 -->

<div class="columna_form">


<div class="form-item">
<div class="tiform6">Dirección</div>
<input type="text" name="direccion" class="campo-prod" value="<?php echo $direccion ; ?>"  /></div>

<div class="form-item">
<div class="tiform6">Teléfono</div>
<input type="text" name="telefono" class="campo-prod" value="<?php echo $telefono ; ?>"  /></div>

<div class="form-item">
<div class="tiform6">Nombre</div>
<input type="text" name="strNombre" class="campo-prod" value="<?php echo $strNombre;?>" />
</div>

<div class="form-item">
<div class="tiform6">Apellido</div>
<input type="text" name="strApellido" class="campo-prod" value="<?php echo $strApellido;?>" />
</div>

<div class="form-item">
<div class="tiform6">Cargo</div>
<input type="text" name="strCargo" class="campo-prod" value="<?php echo $strCargo;?>" />
</div>

<div class="form-item">
<div class="tiform6">Vigencia del crédito</div>
<input type="text" name="vigencia_credito" class="campo-prod" value="<?php echo $vigencia_credito ;?>"  /></div>





<div class="form-item">
<div class="tiform6">Vendedor</div>
<select name="vendedor" class="campo-prod">
	<?php echo 'adasd'.$vendedor; include_once('../personal/classes/class.personal.php');
		$ven = new personal();
		$ven->select_vendedores($vendedor);
	?>
</select>
</div>

</div>
<!-- Columna 2 -->
<div class="columna_form">


<div class="form-item">
<div class="tiform6">Email</div>
<input type="text" name="strEmail" class="campo-prod" value="<?php echo $strEmail;?>" />
</div>


<div class="form-item">
<div class="tiform6">Password</div>
<input type="text" name="strPassword" class="campo-prod" value="<?php echo $strPassword;?>" />
</div>
<div class="form-item">
<div class="tiform6">Puntos Asignados</div>
<input type="text" disabled class="campo-prod" value="<?php echo $dblAsignado;?>" />
</div>

<div class="form-item">
<div class="tiform6">Puntos Consumidos</div>
<input type="text" disabled class="campo-prod" value="<?php echo $dblConsumido?>" />
</div>

<div class="form-item">
<div class="tiform6">Puntos Disponibles</div>
<input type="text" name="dblCredito" class="campo-prod" value="<?php echo $dblCredito;?>" />
</div>

<br />




</div>

<!-- Columna 3 -->



<div class="historial-c">
<div class="credit-update">
<p style="font-size:18px;color:#008752;margin-bottom: -8px">Crédito actual</p>
<p style="font-size: 27px;padding-bottom:10px;color:#008752"><?php  echo "$ $dblCredito"; ?></p>
</div>	
<?php  
	include_once('../historiales/classes/class.historiales.php');
	$hist = new historiales();

	$usuarioitem = $hist->show_by_usuario($idUsuario);
	echo $usuarioitem;
?>

</div>

<div class="btn-usuario">
<input type="hidden" name="idUsuario" id="f-client" value="<?php echo $idUsuario; ?>" />
<button type="submit" class="button7">GUARDAR CAMBIOS</button> 
<button type="button" class="button7" onclick="javascript:history.back(1)">CANCELAR</button> 
</div>
</div><!-- FIN ROW 2 -->


</form>
</div>

</div>


</div>

</body>
</html>