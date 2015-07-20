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
$idNovedades = $_POST['idNovedades'];
$titulo=$_POST['titulo'];

$cuerpo=$_POST['cuerpo'];

$imagen=$_POST['imagen'];

$fecha=$_POST['fecha'];



/* UPDATE */
include_once("classes/class.novedades.php");
$novedades= new novedades();
$novedades->select($idNovedades);
$novedades->idNovedades=$idNovedades;
$novedades->titulo=$titulo;
$novedades->cuerpo=$cuerpo;
$novedades->fecha=$fecha;




if($_FILES['imagen']['name']!=""){

      $nombre_final="";

      	$selnov= new novedades();
		$selnov->select($idNovedades);
      	$imagen=$selnov->getimagen();

      if($imagen!=""){
      unlink(BASEURLRAIZ.'images-novedades/'.$imagen);
      unlink(BASEURLRAIZ.'images-novedades/tn_'.$imagen);
      }
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
      /* INSERT */

      /* UPDATE */
		include_once("classes/class.novedades.php");
		$novedades= new novedades();
		$novedades->select($idNovedades);
		$novedades->imagen=$nombre_final;
		$novedades->update($idNovedades);

      }else{
      echo $msg_final .= '<div class="notify"><p>Ocurrio un error al actualizar la imagen1. Imagen1 no actualizada!</p></div>';
      }



}

$novedades->update($idNovedades);




echo '<div class="notify"><p>novedad actualizada!</p><p><a href="v_novedades.php">Regresar</a></p></div>';

?>	</div>
	<div class="one_4">
  <div id="welcome">
  <h3>Bienvenido <br /><?php  echo $_SESSION['logged_name']; ?> </h3>
        <div class="prop"><?php  

include_once("../propuestas/classes/class.propuestas.php");
$prop= new propuestas();
$prop->sin_responder();


?></div>
  </div>
	
			<ul class="menusidebar">
	      <li><a href="<?php  echo BASEURL.'/logout.php'?>">Cerrar sesion</a></li>
        <div style="width:218px;border-top:1px solid #ECCEDF; padding: 4px 0 0 0"></div>
				<li><a href="n_<?php echo $singular; ?>.php">Crear <?php echo $singular; ?></a></li>
	
			</ul>
	
			
		</div>
</div>

<?php include_once('../inc/footer.php') ?>