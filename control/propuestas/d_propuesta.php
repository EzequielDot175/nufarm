<?php
include_once('../resources/control.php');
include_once('helper_titulos.php');
?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once('../resources/control.php'); ?>
	<title></title>
	<link rel="stylesheet" type="text/css" media="all" href="../layout/main.css" />
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
<?php
$id=$_GET['id'];
if(!$_POST['confirm'] && $_POST['pulsado']){$msgpulsado ='<div class="notify"><p>Debe marcar el campo de confirmacion para poder eliminar..</p></div>';}else{$msgpulsado="";}
echo $msgpulsado;
/* SELECT */
include_once("classes/class.propuestas.php");
$propuestas= new propuestas();
$propuestas->select($id);
$id_usuario=$propuestas->getid_usuario();
$nombre_evento=$propuestas->getnombre_evento();
$lugar=$propuestas->getlugar();
$cant_invitados=$propuestas->getcant_invitados();
$fecha_estimada=$propuestas->getfecha_estimada();
$caracteristicas=$propuestas->getcaracteristicas();
$monto=$propuestas->getmonto();
$aprobado=$propuestas->getaprobado();
$leido=$propuestas->getleido();
$aprobado_fecha=$propuestas->getaprobado_fecha();

if($_POST['confirm']){
$id=$_POST['id_propuesta'];


/* DELETE */

include_once("classes/class.propuestas.php");
$propuestas= new propuestas();
$propuestas->select($id);
$propuestas->delete($id);

 echo '<div class="notify"><p>propuesta, eliminada!</p><p><a class="btn-micuenta4" href="v_propuestas.php">Regresar</a></p></div>';

$_SESSION['msg_ok'] = 'Propuesta eliminada!';
header('Location: '.BASEURL.'/propuestas/v_propuestas.php');

}
else{
echo '<div class="item"><div class="dividerclean"><form action="d_propuesta.php?id='.$id.'" class="formvalid" method="post">
            <div class="olive-bar"><h4>Eliminar propuesta</h4></div>
			
			<p>
				<label for="confirmacion"></label>
				<p>Confirma Eliminar este propuesta? <input type="checkbox" name="confirm" id="confirm" class="checkbox" /></p>
			</p> <input type="hidden" name="id_propuesta" name="id_propuesta" value="'.$id.'" />
			<input type="hidden" name="pulsado" value="1" />
	
<p><button name="btnborrar" class="button">Aceptar</button> <button type="button" class="button" onClick="location.href=\'v_propuestas.php\'">Cancelar</button></p>
	
	</form></div></div>';

}?>
</div>
<?php include_once('../inc/footer.php') ?>
</div>


</body>
</html>