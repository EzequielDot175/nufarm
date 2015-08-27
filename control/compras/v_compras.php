<?php 
include_once('../resources/control.php');
include_once('helper_titulos.php');
require_once('../../libs.php');


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



<!--SIDEBAR
<div class="product_filter_vend_column">-->
<?php 
/*include_once("classes/class.compras.php");
$compras2= new compras();
$compras2->select_all_vendedores();*/
?>
<!--</br></br>-->
<?php /*
include_once("classes/class.compras.php");
$compras3= new compras();
$compras3->select_all_states();*/
?>
 <!--</div> -->
<div class="filtros_container">
     <div class="filtros-Default filtros-100">
          <form action="">
                <h3> FILTRAR POR:</h3>
                <select name="">
                  <option value="">VENDEDOR</option>
                  <?php //Vendedor::options() ?>
                </select>

                <select name="">
                  <option value="">ESTADO</option>
                  <option value="1">PEDIDO REALIZADO</option>
                  <option value="2">PEDIDO EN PROCESO</option>
                  <option value="3">PEDIDO ENVIADO</option>
                  <option value="4">PEDIDO ENTREGADO</option>
                </select>

                <select name="" >
                  <option value="">CLIENTE</option>
                  <?php Cliente::options() ?>
                </select>

                <button class="button-image" type="submit" ><img src="../layout/ver.png" alt=""> VER LISTADO DE RESULTADOS </button> 
          </form>
    </div>
</div>

<div class="prod_container">

<div class="three_444 contenedor-default contenedor-A">
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

?>



<hr class="separador">

<div class="menuorden"><a href="v_compras.php?orden=1&activo=1&sub=c"><img src="../layout/btn-orden1.png" alt="desc"/></a><a href="v_compras.php?orden=2&activo=1&sub=c"><img src="../layout/btn-orden2.png" alt="desc"/></a></div>
 <table>
 <tr class="tablacolor3 tablaDefault">
     <td  class="colA" align="center">FECHA</td>  
     <td  class="colB" align="center">TOTAL PUNTOS</td>
     <td  class="colC" align="center">PRODUCTO</td>
      <td class="colD" align="center">CANTIDAD</td>
      <td class="colE" align="center">COLOR</td>
      <td class="colF" align="center">TALLE</td>
      <td class="colG" align="center">REMITO</td>
     <td  class="colH" align="center">ESTADO</td>
   </tr>
 </table>
 <div style="height:10px"></div>
<?php
/* SELECT */
include_once("classes/class.compras.php");
$compras= new compras();
$compras->select_all($pagina, $orden);


?></div>
</div>
<?php include_once('../inc/footer.php') ?></div>


</body>
</html>