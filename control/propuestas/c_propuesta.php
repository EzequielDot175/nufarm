<?php header('Content-Type: text/html; charset=utf-8');
include_once('../resources/control.php');
include_once('helper_titulos.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
<meta name= "title" content="" /> 
<meta name= "author" content="Gabriel Hubermann" /> 
<meta name= "description" content="" /> 
<meta name= "keywords" content=""/> 
<meta name= "copyright" content="Â© 2011" /> 
<meta name= "designer" content="Gabriel Hubermann | Web Designer, PHP Ajax CSS Programming | http://www.hubermann.com" /> 
<meta name= "publisher" content="" /> 
<meta name= "distribution" content="Local" /> 
<meta name= "robots" content="all" /> 

<?php include("../inc/metas.php"); ?>

<?php include("../inc/title.php"); ?>

<?php include_once('../resources/includes.php'); ?>
<script type="text/javascript">
function changueoferta(div){
$('#oferta'+div).load('changue_oferta.php?id='+div);
}
</script>
<script type="text/javascript"> 
$(document).ready(function(){
    $(".formvalid").validate({
      event: "blur",
      rules: {
       titulo: { 
		required: true, 
		minlength: 2 
		},
		     
      
      },
      messages: {
        titulo: { 
		required: " Complete titulo", 
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
<!--[if !IE]> WRAPPER <![endif]-->
<div id="wrapper">

<!--[if !IE]> HEADER <![endif]-->
<div id="header" class="full"> <div class="inside"></div></div>
<!--[if !IE]> END HEADER <![endif]-->

<!--[if !IE]> MENU <![endif]-->
<div id="menu" class="full">
<ul>
<?php include('../inc/main_menu.php'); ?>
</ul>
</div>
<!--[if !IE]> END MENU <![endif]-->

<!--[if !IE]> CONTENT <![endif]-->
<div id="content">

<!--[if !IE]> SIDEBAR <![endif]-->
<div id="sidebar" class="three_1">
<div class="inside">
<ul>
<li><a class="active" href="n_<?php echo $singular; ?>.php">Crear <?php echo $singular; ?></a></li>
</ul>
<div id="menuinterno">
<?php //include_once('inc/menu_lenguaje.php'); ?>
</div>
</div>
</div>
<!--[if !IE]> END SIDEBAR <![endif]-->

<!--[if !IE]> COLUMN BIG <![endif]-->
<div id="columnBig" class="three_2">
<div class="inside">
<!-- inicio de contenido columna grande -->
<h3><?php echo $plural; ?></h3>

<?php 
$id_usuario = $_POST['id_usuario'];
$nombre_evento = $_POST['nombre_evento'];
$lugar = $_POST['lugar'];
$cant_invitados = $_POST['cant_invitados'];
$fecha_estimada = $_POST['fecha_estimada'];
$caracteristicas = $_POST['caracteristicas'];
$monto = $_POST['monto'];
$aprobado = $_POST['aprobado'];
$leido = $_POST['leido'];
$aprobado_fecha = $_POST['aprobado_fecha'];

/* INSERT */

include_once("classes/class.propuestas.php");
$propuestas= new propuestas();
$propuestas->id_usuario=$id_usuario;
$propuestas->nombre_evento=$nombre_evento;
$propuestas->lugar=$lugar;
$propuestas->cant_invitados=$cant_invitados;
$propuestas->fecha_estimada=$fecha_estimada;
$propuestas->caracteristicas=$caracteristicas;
$propuestas->monto=$monto;
$propuestas->aprobado=$aprobado;
$propuestas->leido=$leido;
$propuestas->aprobado_fecha=$aprobado_fecha;
$propuestas->insert();


echo '<div class="notify"><p> Creada!</p><p><a href="v_propuestas.php">Regresar</a></p></div>';

?>
<!--fin contenido columna Grande -->
</div>
</div>
<!--[if !IE]> END COLUMN BIG <![endif]-->


</div>
<!--[if !IE]> END CONTENT <![endif]-->

<!--[if !IE]> FOOTER <![endif]-->
<div id="footer" class="full"> 
<?php include('../inc/footer.php'); ?>
</div>
<!--[if !IE]> END FOOTER <![endif]-->


<!--[if !IE]> END WRAPPER <![endif]-->
</div>
</body>
</html>