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

	<?php include_once('../inc/header.php') ?>

<div class="block">
	
	<div class="three_4">
<?php
if($_SESSION['msg_ok']){echo '<div class="notify_ok"><p>'.$_SESSION['msg_ok'].'</p></div>'; unset($_SESSION['msg_ok']);}
if($_SESSION['msg_error']){echo '<div class="notify_error"><p>'.$_SESSION['msg_error'].'</p></div>'; unset($_SESSION['msg_error']);}
if($_SESSION['msg_warning']){echo '<div class="notify_warning"><p>'.$_SESSION['msg_warning'].'</p></div>'; unset($_SESSION['msg_warning']);}
$id =$_GET['id'];

/* SELECT */
include_once("classes/class.propuestas.php");
$propuestas= new propuestas();
$propuestas->select($id);
$id_propuesta=$propuestas->getid_propuesta();
$id_usuario=$propuestas->getid_usuario();
$nombre_evento=$propuestas->getnombre_evento();
$lugar=$propuestas->getlugar();
$cant_invitados=$propuestas->getcant_invitados();
$fecha_estimada=$propuestas->getfecha_estimada();
$caracteristicas=$propuestas->getcaracteristicas();
$monto=$propuestas->getmonto();
$aprobado=$propuestas->getaprobado();
$leido=$propuestas->getleido();
$detalle_admin=$propuestas->getdetalle_admin();
$aprobado_fecha=$propuestas->getaprobado_fecha();
$estado=$propuestas->getestado();


include_once('../usuarios/classes/class.usuarios.php');

$usr = new usuarios();
$usr->select($id_usuario);
$nombre_usr = $usr->getstrNombre();
$apellido_usr = $usr->getstrApellido();
$email_usr = $usr->getstrEmail();
$monto_usuario = $usr->getdblCredito();

?>
<div class="product_filter_vend_column">
<?php 
include_once("../compras/classes/class.compras.php");
$compras2= new compras();
$compras2->select_all_vendedores_pub_eve();
?>
</div>			

<div class="three_45">

<div class="item">


<p>
<div class="barra-prod"><span>Publicidad & Eventos</span></div>
<?php echo utf8_decode($caracteristicas); ?></p>
<span class="fecha_ed_form"><p>FECHA: <?php echo $fecha_estimada; ?></p></div>



<form method="post" action="u_propuesta.php" class="formvalid" >

<input type="hidden" name="id_propuesta" value="<?php echo $id_propuesta; ?>" />
<input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>" />

<span>Credito del cliente: $<?php  echo $monto_usuario; ?>  </span>  
</p></p>

<div class="tiform5">Monto a descontar:
<input type="text" name="monto" id="monto2" value=""/> 

</div>





<div class="tiform5">Modificar Estado
<select name="estado" id="estado">
	<option value="1" <?php  if($estado ==1){echo 'selected="selected"';} ?>>NO LEIDO</option>
	<option value="2" <?php  if($estado ==2){echo 'selected="selected"';} ?>>PENDIENTE</option>
	<option value="3" <?php  if($estado ==3){echo 'selected="selected"';} ?>>APROBADO</option>
	<option value="4" <?php  if($estado ==4){echo 'selected="selected"';} ?>>NO APROBADO</option>
	<option value="5" <?php  if($estado ==5){echo 'selected="selected"';} ?>>ENTREGADO</option>
</select>
</div>

<p>

<div class="tiform">Observaciones admin</div>
<textarea name="detalle_admin" id="detalle_admin" rows="10"><?php echo $detalle_admin; ?></textarea>


<p><button type="submit" class="button">Aceptar</button> <button type="reset" class="button">Borrar</button> <button type="button" class="button" onClick="location.href='v_propuestas.php?activo=1&sub=a'">Cancelar</button></p>
</p>

</form>

</div></div>
<?php include_once('../inc/footer.php') ?>
</div>
</div><!-- end block -->
</body>
</html>