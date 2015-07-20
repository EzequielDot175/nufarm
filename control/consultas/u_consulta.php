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
<div class="block">
	<?php include_once('../inc/header.php') ?>	
</div>




<div class="block">
	
	<div class="three_4">
<?php
$idConsulta = $_POST['idConsulta'];
$idUsuario=$_POST['idUsuario'];
$strAsunto=$_POST['strAsunto'];
$strCampo=$_POST['strCampo'];


/* UPDATE */
include_once("classes/class.consultas.php");
$consultas= new consultas();

$consultas->select($idConsulta);
$consultas->idConsulta=$idConsulta;
$consultas->idUsuario=$idUsuario;
$consultas->strAsunto=$strAsunto;
$consultas->strCampo=$strCampo;
$consultas->update($idConsulta);


echo '<div class="notify"><p>consulta actualizada!</p><p><a href="v_consultas.php">Regresar</a></p></div>';

?>	

</div>



<div class="one_4"><h4>Opciones</h4>

		<ul class="menusidebar">

			<li><a class="active" href="n_<?php echo $singular; ?>.php">Crear <?php echo $singular; ?></a></li>

		</ul>

		
	</div>
	
	
		
</div>

<?php include_once('../inc/footer.php') ?>