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
<?php

$titulo=$_POST['titulo'];

$cuerpo=$_POST['cuerpo'];

$imagen=$_POST['imagen'];

$fecha=$_POST['fecha'];




list($dia, $mes, $anio) = explode('-',$fecha);

$fecha = $anio.'-'.$mes.'-'.$dia;
/* INSERT */
include_once("classes/class.novedades.php");
$novedades= new novedades();
$novedades->titulo=$titulo;
$novedades->cuerpo=$cuerpo;
$novedades->fecha=$fecha;

if($_FILES['imagen']['name']!=""){


include_once('../resources/class.upload.php');
      $yukle = new upload;
      $yukle->set_max_size(99999999);
      $yukle->set_directory('../../images-novedades');
      $yukle->set_tmp_name($_FILES['imagen']['tmp_name']);
      $yukle->set_file_size($_FILES['imagen']['size']);
      $yukle->set_file_type($_FILES['imagen']['type']);
      //random
      $random = substr(md5(rand()),0,6);
      $avatarname= $random.'_'.$_FILES['imagen']['name'];
      $nombre_final = str_replace(' ','-',$avatarname);
      $yukle->set_file_name($nombre_final);
      $yukle->start_copy();
      $yukle->resize(620,0);
      $yukle->set_thumbnail_name('tn_'.$nombre_final);
      $yukle->create_thumbnail();
      $yukle->set_thumbnail_size(300, 0);
      if($yukle->is_ok()){

      $imagen =$nombre_final;
      $novedades->imagen=$imagen;
      
      }else{
      //si hay error cargo sin imagen
      $imagen ="";

      }



}


#save
$novedades->insert();

echo '<div class="notify"><p>novedad Creada!</p><p><a class="btn-micuenta4" href="v_novedades.php?activo=2&sub=g">Regresar</a></p></div>';

?>	</div>
<?php include_once('../inc/footer.php') ?>
</div>

