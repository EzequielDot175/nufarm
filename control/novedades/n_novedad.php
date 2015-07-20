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
	function readURL2(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
        
                        reader.onload = function (e) {
                            $('#preview2').attr('src', e.target.result);
                        }
        
                        reader.readAsDataURL(input.files[0]);
                    }
                }
	
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
<div class="item">

<form method="post" action="c_novedad.php" id="simpleform" enctype="multipart/form-data">

<div class="olive-bar"><h4>Publicar novedad</h4></div>


<div class="colform">
<div class="form-item">
<div class="tiform2">Titulo</div>
<p><input type="text" name="titulo" id="titulo" /></p>
</div></div><!-- Fin colform -->

<div class="colform">
<div class="form-item">
<div class="tiform2">Fecha</div>
<p><input type="text" name="fecha" id="fecha" /></p>
</div></div><!-- Fin colform -->


<div class="form-item">
<div class="tiform2">Cuerpo</div>
<p><textarea name="cuerpo" id="cuerpo" cols="30" rows="10"></textarea></p>
</div>

<div class="olive-bar"><h4>Cargar imagen</h4></div>

<div class="form-item">
<?php 
if($strImagen2!=""){
  echo '<img id="preview2" src="../../images_productos/'.$strImagen2.'" alt=""/><br />';
}else{
 echo '<img id="preview2" src="../../images_productos/default.png" alt="" width="100" /><br />';
}
?>
<p><div class="upload"><input type="file" name="imagen" id="imagen" /></div></p>
</div>


<div class="area-ancha">
<div class="form-item">

<p><button type="submit" class="button">Aceptar</button> <button type="reset" class="button">Borrar</button> <button type="button" class="button" onClick="javascript:history.back(1)">Cancelar</button></p>

</div></div>



</fieldset>

</form>

	</div></div>
<?php include_once('../inc/footer.php') ?></div>

