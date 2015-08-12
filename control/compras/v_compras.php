<?php 
include_once('../resources/control.php');
include_once('helper_titulos.php');
if(!isset($_SESSION)):
  session_start();
endif;
$_SESSION['last_page'] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

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

Modernizr.load({
  test: Modernizr.fontface && Modernizr.backgroundsize && Modernizr.borderradius && Modernizr.generatedcontent,
  yep : 'geo.js',
  nope: 'geo-polyfill.js'
});



$( ".producto_comprado:even" ).css( "background-color", "#eee" );

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
<div class="prod_container">
<div class="product_filter_vend_column">
<?php 
include_once("classes/class.compras.php");
$compras2= new compras();
$compras2->select_all_vendedores();
?>
</br></br>
<?php 
include_once("classes/class.compras.php");
$compras3= new compras();
$compras3->select_all_states();
?>
 </div>	
<div class="three_444">
<!-- /////////////////////////////////////////////BACKEND CANJES //////////////////////////////////////////////////////////-->
<?php
 if($_SESSION['msg_ok']){echo '<div class="notify_ok"><p>'.$_SESSION['msg_ok'].'</p></div>'; unset($_SESSION['msg_ok']);}
 if($_SESSION['msg_error']){echo '<div class="notify_error"><p>'.$_SESSION['msg_error'].'</p></div>'; unset($_SESSION['msg_error']);}
 if($_SESSION['msg_warning']){echo '<div class="notify_warning"><p>'.$_SESSION['msg_warning'].'</p></div>'; unset($_SESSION['msg_warning']);}
 
 
$pagina=$_GET['page'];
$ipp=$_GET['ipp'];
if(!$pagina){
$pagina==0;
}
$orden= $_GET['orden'];

if($orden==1){
$orden = "idCompra DESC";
}
if($orden==2){
$orden = "idCompra ASC";
}
if($orden==3){
$orden = "idCompra ASC";
}
if($orden==""){
$orden = "idCompra DESC";
}

echo '
<div class="menuorden"><a href="v_compras.php?orden=1&activo=1&sub=c">
<img src="../layout/btn-orden1.png" alt="desc"/></a><a href="v_compras.php?orden=2&activo=1&sub=c"><img src="../layout/btn-orden2.png" alt="desc"/></a></div>
 <table>
 <tr class="tablacolor3">
     <td  class="rotate2" width="15%" height="5" align="left">Valor Canjeado</td>  
     <td  class="rotate2" width="39%" height="5" align="left">Producto</td>
     <td  class="rotate2" width="6%" height="5" align="left">Unidades</td>
	 <td  class="rotate2" width="8%" height="5" align="left">Talle / Color</td>
	 <td></td>
     <td  width="25%" height="20px" align="center">Estado</td>
   </tr>
 </table>
 <div style="height:10px"></div>
';
/* SELECT */
include_once("classes/class.compras.php");
$compras= new compras();
$compras->select_all($pagina, $orden);


?></div>
</div>
<?php include_once('../inc/footer.php') ?></div>


</body>
</html>