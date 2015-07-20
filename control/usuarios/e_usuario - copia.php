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
<div id="top"></div>
<div id="bg1">
<div id="bg2">
<div id="bg3">
<div id="bg4">
<!-- Header -->
<div class="block">
	<?php include_once('../inc/header.php') ?>	
</div>

<div class="block">
	
	<div class="three_4">
	<div class="green-bar"><h4>Clientes</h4></div>
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
<div class="item">
<form method="post" action="u_usuario.php" id="simpleform" enctype="multipart/form-data" >
<fieldset>
<legend><strong> &nbsp; Editar cliente &nbsp; </strong></legend>


<div class="row">
<!-- Columna 1 -->


<div class="columna_form">

<?php if($logo != ""){echo '<img src="../../images-clientes/'.$logo.'" alt="" width="120" />';}else{echo '<div class="no_img"></div>';}  ?>
<div class="form-item">
<label for="logo">Modificar logo</label>
<input type="file" name="logo" id="logo" value="<?php echo $logo ; ?>"  />
</div>
<div class="form-item">
<label for="cstrEmpresa">StrEmpresa</label>
<input type="text" name="strEmpresa" id="strEmpresa" value="<?php echo $strEmpresa;?>" />
</div>
<div class="form-item">
<label for="direccion">direccion</label><input type="text" name="direccion" id="direccion" value="<?php echo $direccion ; ?>"  /></div>

<div class="form-item">
<label for="telefono">telefono</label><input type="text" name="telefono" id="telefono" value="<?php echo $telefono ; ?>"  /></div>

</div>
<!-- Columna 2 -->
<div class="columna_form">


<div class="form-item">
<label for="cstrNombre">StrNombre</label>
<input type="text" name="strNombre" id="strNombre" value="<?php echo $strNombre;?>" />
</div>


<div class="form-item">
<label for="cstrApellido">StrApellido</label>
<input type="text" name="strApellido" id="strApellido" value="<?php echo $strApellido;?>" />
</div>


<div class="form-item">
<label for="cstrCargo">StrCargo</label>
<input type="text" name="strCargo" id="strCargo" value="<?php echo $strCargo;?>" />
</div>


<div class="form-item">
<label for="cstrEmail">StrEmail</label>
<input type="text" name="strEmail" id="strEmail" value="<?php echo $strEmail;?>" />
</div>


<div class="form-item">
<label for="cstrPassword">StrPassword</label>
<input type="text" name="strPassword" id="strPassword" value="<?php echo $strPassword;?>" />
</div>

<hr />

<div class="form-item">
<label for="nombre_contacto1">nombre_contacto1</label><input type="text" name="nombre_contacto1" id="nombre_contacto1" value="<?php echo $nombre_contacto1 ; ?>"  /></div>

<div class="form-item">
<label for="apellido_contacto1">apellido_contacto1</label><input type="text" name="apellido_contacto1" id="apellido_contacto1" value="<?php echo $apellido_contacto1 ; ?>"  /></div>

<div class="form-item">
<label for="email_contacto1">email_contacto1</label><input type="text" name="email_contacto1" id="email_contacto1" value="<?php echo $email_contacto1 ; ?>"  /></div>

<hr />
<div class="form-item">
<label for="nombre_contacto2">nombre_contacto2</label><input type="text" name="nombre_contacto2" id="nombre_contacto2" value="<?php echo $nombre_contacto2 ; ?>"  /></div>

<div class="form-item">
<label for="apellido_contacto2">apellido_contacto2</label><input type="text" name="apellido_contacto2" id="apellido_contacto2" value="<?php echo $apellido_contacto2 ; ?>"  /></div>

<div class="form-item">
<label for="email_contacto2">email_contacto2</label><input type="text" name="email_contacto2" id="email_contacto2" value="<?php echo $email_contacto2 ; ?>"  /></div>

</div>

<!-- Columna 3 -->
<div class="columna_form">

<?php  
include_once('../historiales/classes/class.historiales.php');
$hist = new historiales();

$usuarioitem = $hist->show_by_usuario($idUsuario);
echo $usuarioitem;
?>
<p>Credito actual</p>

<br />
<?php  echo "$ $dblCredito"; ?>

<div class="form-item">
<label for="vigencia_credito">vigencia_credito</label><input type="text" name="vigencia_credito" id="vigencia_credito" value="<?php echo $vigencia_credito ;?>"  /></div>


<div class="form-item">
<label for="cdblCredito">DblCredito</label>
<input type="text" name="dblCredito" id="dblCredito" value="<?php echo $dblCredito;?>" />
</div>


<div class="form-item">
<label for="vendedor">vendedor</label>
<select name="vendedor" id="vendedor">
	<?php echo 'adasd'.$vendedor; include_once('../personal/classes/class.personal.php');
		$ven = new personal();
		$ven->select_vendedores($vendedor);
	?>
</select>
</div>
</div>


</div><!-- FIN ROW 2 -->






<div class="columna_form"></div>
<div class="columna_form"></div>
<div class="columna_form">

<input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $idUsuario; ?>" />
<div class="form-item">
<p><button type="submit">Aceptar</button> <button type="button" class="btnback" onclick="javascript:history.back(1)">Cancelar</button></p>
</div>

</div>





</fieldset>
</form></div>

<div class="item">
<div class="green-bar"><h4>Canjes realizados</h4></div>
<?php  
include_once('../propuestas/classes/class.propuestas.php');

$canjes = new propuestas();
$canjes->select_by_suario($idUsuario);
?>
</div>
<div class="item">
<div class="green-bar"><h4>Compras realizadas</h4></div>

<?php  
include_once('../compras/classes/class.compras.php');

$com = new compras();
$com->select_by_usuario($idUsuario);
?>
</div>


<div class="item">
<div class="green-bar"><h4>Consultas realizadas</h4></div>
<?php  
include_once('../consultas/classes/class.consultas.php');

$coms = new consultas();
$coms->select_by_usuario($idUsuario);


?>
</div>
</div>



<div class="one_4"><h4>Opciones</h4>

		<ul class="menusidebar">

			<li><a class="active" href="n_<?php echo $singular; ?>.php">Crear <?php echo $singular; ?></a></li>

		</ul>

		
	</div>
	
	
</div>

<?php include_once('../inc/footer.php') ?>
</div></div></div></div>
</body>
</html>