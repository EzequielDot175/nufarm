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
	<div class="three_4">

	<div class="product_filter_consulta_column">
<div class="item">

<a href="v_personal.php?activo=2&sub=h"><div class="olive-bar_new3"><span>VER TODOS</span></div></a>

</div><div class="item">



	<a href="v_personal.php?activo=2&sub=h&filtro_personal=1"><div class="pub-eve"><span>ADMINISTRADOR</span></div></a>

	<a href="v_personal.php?activo=2&sub=h&filtro_personal=2"><div class="pub-eve"><span>MARKETING</span></div></a>
	
	<a href="v_personal.php?activo=2&sub=h&filtro_personal=3"><div class="pub-eve"><span>VENDEDOR</span></div></a>

</div></div>

<?php



$id=$_GET['id'];

if(!$_POST['confirm'] && $_POST['pulsado']){$msgpulsado ='<div class="notify"><p>Debe marcar el campo de confirmacion para poder eliminar..</p></div>';}else{$msgpulsado="";}
echo $msgpulsado;
/* SELECT */
include_once("classes/class.personal.php");
$personal= new personal();
$personal->select($id);

$nombre=$personal->getnombre();
$apellido=$personal->getapellido();
$login=$personal->getlogin();
$role=$personal->getrole();


if($_POST['confirm']){
$id=$_POST['id_personal'];

/* DELETE */

include_once("classes/class.personal.php");
$personald= new personal();
$personald->select($id);
$personald->delete($id);

echo '<div class="notify"><p>personal, eliminado!</p><p><a href="v_personal.php">Regresar</a></p></div>';
$_SESSION['msg_ok'] = 'personal, eliminado!';
header('Location: '.BASEURL.'/personal/v_personal.php');
}
else{
echo '
<div class="item-content-prod-edit">
<form action="d_personal.php?id='.$id.'" id="simpleform" method="post">
		<div class="barra-prod-edit"><span>Eliminar personal</span></div>
	
			<div class="form-item">
				<label for=""></label>
				<span>Confirma Eliminar este personal? <input type="checkbox" name="confirm" id="confirm" class="checkbox" /></span>
			<input type="hidden" name="id_personal" name="id_personal" value="'.$id.'" />
			<input type="hidden" name="pulsado" value="1" />
			
	
<div class="form-item">
<p><button name="btnborrar" class="button">Aceptar</button> 
<button type="button" class="button" onClick="location.href=\'v_personal.php?activo=2&sub=h\'">Cancelar</button></div></p>
</div>
		
	</form>
	</div>
';
}
?>	</div>	
<?php include_once('../inc/footer.php') ?>	
</div>
</body>
</html>