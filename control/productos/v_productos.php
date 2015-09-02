<?php header('Content-Type: text/html; charset=utf-8');
include_once('../resources/control.php');
include_once('helper_titulos.php');
require_once('../../libs.php');
?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once('../resources/control.php'); ?>
	<title>Productos Nufarm</title>
	<link rel="stylesheet" type="text/css" media="all" href="../layout/base.css" />
	<link rel="stylesheet" type="text/css" media="all" href="layout/main.css" />
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
<div class="prod_container">
<div class="three_444 contenedor-default contenedor-A">

<!-- SIDEBAR
<div class="item-group-btn">
	<a class="btn-fill" href="<?php  echo BASEURL.'/productos/n_producto.php?activo=2&sub=d';?>"><span><p>Crear nuevo producto</p></span></a>
	<a class="btn-fill"href="<?php  echo BASEURL.'/categorias/v_categorias.php?activo=2&sub=d';?>"><span><p>Administrar Categorías</p></span></a>
	<a class="btn-fill" href="<?php  echo BASEURL.'/talles/v_talles.php?activo=2&sub=d';?>"><span><p>Administrar Talles</p></span></a>
	<a class="btn-fill" href="<?php  echo BASEURL.'/colores/v_color.php?activo=2&sub=d';?>"><span><p>Administrar Colores</p></span></a>
</div>-->
<?php

if($_SESSION['msg_ok']){echo '<div class="notificacion notify_ok"><p>'.$_SESSION['msg_ok'].'</p></div>'; unset($_SESSION['msg_ok']);}
if($_SESSION['msg_error']){echo '<div class="notificacion notify_error"><p>'.$_SESSION['msg_error'].'</p></div>'; unset($_SESSION['msg_error']);}
if($_SESSION['msg_warning']){echo '<div class="notificacion notify_warning"><p>'.$_SESSION['msg_warning'].'</p></div>'; unset($_SESSION['msg_warning']);}


$pagina=$_GET['page'];
$ipp=$_GET['ipp'];
if(!$pagina){
$pagina==0;
}
$orden= $_GET['orden'];

if($orden==1){
$orden = "StrNombre DESC";
}
if($orden==2){
$orden = "StrNombre ASC";
}
if($orden==3){
$orden = "StrNombre ASC";
}
if($orden==""){
$orden = "StrNombre ASC";
}

echo '<div class="menuorden"><a href="v_productos.php?orden=1"><img src="../layout/btn-orden1.png" alt="desc"/></a><a href="v_productos.php?orden=2"><img src="../layout/btn-orden2.png" alt="desc"/></a></div>';
/* SELECT */
//echo '<div id="content-prod">';
echo '<div>';
$productos = new Producto();
$all = $productos->all();

?>
<div class="barra-prod"><span>Productos</span></div>


<?php foreach($all as $k => $v): ?>


<table>
           <tbody>
                <tr class=" tablaProductos">
                  <td class="colA" align="center">
			<img class="img" src="../../images_productos/<?php echo($v->strImagen) ?>" alt="">
                  </td>
                  <td class="colB tdBackground" align="center">
                    <span><?php echo($v->dblPrecio) ?> <span>
                  </td>
                  <td class="colC tdBackground" align="center">
                    <span><?php echo($v->strNombre) ?></span>
                  </td>
                  <td class="colD tdBackground" align="center">
                    <span><?php echo substr($v->strDetalle, 0, 30) ?>...</span>
                  </td>
                   <td class="colE tdBackground" align="center">
                    <span><p>STOCK: <?php echo($v->intStock) ?></p></span>
                  </td>
                  <td class="colF tdBackground" align="center">
                    <span>
			<?php if((int)$v->intMinCompra > 0): ?>
			<p>MIN: <?php echo($v->intMinCompra) ?></p>
			<?php endif; ?>

			<?php if((int)$v->intMaxCompra > 0): ?>
			<p>MAX: <?php echo($v->intMaxCompra) ?></p>
			<?php endif; ?> </span>
                  </td>
                  <td class="colG ">
                     		<div class="botones">
		              <div class="item editar">
		                <a href="e_producto.php?id=<?php echo($v->idProducto) ?>&amp;activo=2&amp;sub=d">
		                  <img class="imagen" src="../layout/editar.png" alt="">
		                </a>
		              </div>
		              <div class="item borrar">
		                <a href="d_producto.php?id=<?php echo($v->idProducto) ?>&amp;activo=2&amp;sub=d">
		                  <img class="imagen" src="../layout/borrar.png" alt="">
		                </a>
		              </div>
		           </div>
                  </td>
                </tr>

           </tbody>
</table>
<?php endforeach; ?>
<!-- include_once("classes/class.productos.php");
$productos= new productos();
$productos->select_all($pagina, $orden); -->

</div>
</div>
	
</div>


</body>
</html>