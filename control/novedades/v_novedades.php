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
 

$pagina=$_GET['page'];

$ipp=$_GET['ipp'];

if(!$pagina){

$pagina==0;

}

$orden= $_GET['orden'];



if($orden==1){

$orden = "idNovedades DESC";

}

if($orden==2){

$orden = "idNovedades ASC";

}

if($orden==3){

$orden = "idNovedades ASC";

}

if($orden==""){

$orden = "idNovedades ASC";

}



echo '<div class="menuorden"><a href="v_novedades.php?orden=1"><img src="../layout/btn-orden1.png" alt="desc"/></a><a href="v_novedades.php?orden=2"><img src="../layout/btn-orden2.png" alt="desc"/></a></div>
<div class="">';

/* SELECT */
include_once("classes/class.novedades.php");
$novedades= new novedades();
$novedades->select_all($pagina, $orden);

?>	</div>
</div>
	<?php include_once('../inc/footer.php') ?>
</div>


</body>
</html>