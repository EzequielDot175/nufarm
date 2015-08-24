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
	
<div class="three_4">

<div class="item-group-btn">
<a class="btn-fill" href="<?php  echo BASEURL.'/productos/n_producto.php?activo=2&sub=d';?>"><span><p>Crear nuevo producto</p></span></a>
<a class="btn-fill"href="<?php  echo BASEURL.'/categorias/v_categorias.php?activo=2&sub=d';?>"><span><p>Administrar Categorías</p></span></a>
<a class="btn-fill" href="<?php  echo BASEURL.'/talles/v_talles.php?activo=2&sub=d';?>"><span><p>Administrar Talles</p></span></a>
<a class="btn-fill" href="<?php  echo BASEURL.'/colores/v_color.php?activo=2&sub=d';?>"><span><p>Administrar Colores</p></span></a>


</div>

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
echo '<div id="content-prod">';

$productos = new Producto();
$all = $productos->all();
echo "<pre>";
print_r($all[0]);
echo "</pre>";
?>
<div class="barra-prod"><span>Productos</span></div>

<?php foreach($all as $k => $v): ?>
<div class="item-content-prod">

	<div class="box-image-prod-item">
		<img src="../../images_productos/<?php echo($v->strImagen) ?>" alt="">
	</div>


	<div class="box-prod-item-2">

		<div class="box-prod-item-1 ">
			<span>													
				<?php echo($v->dblPrecio) ?> 
			</span>
		</div>

		<div class="nom-desc">
			<p style="color: #646363;text-transform: uppercase;font-weight: bold;"><?php echo($v->strNombre) ?></p>
			<p style="color:#7A7474"><?php echo substr($v->strDetalle, 0, 30) ?>...</p>
		</div>
		<div class="stock-detalle">
			<p>STOCK: <?php echo($v->intStock) ?></p>
			<?php if((int)$v->intMinCompra > 0): ?>
			<p>MIN: <?php echo($v->intMinCompra) ?></p>
			<?php endif; ?>

			<?php if((int)$v->intMaxCompra > 0): ?>
			<p>MIN: <?php echo($v->intMaxCompra) ?></p>
			<?php endif; ?>
		</div>
		<div class="box-detalle2">

		</div>

		<div class="box-btn-prod-edit">
			<p>
				<a class="btn-prod-edit" href="e_producto.php?id=<?php echo($v->idProducto) ?>&amp;activo=2&amp;sub=d"><span>ADMINISTRAR</span></a>

				<a class="btn-prod-edit" href="d_producto.php?id=<?php echo($v->idProducto) ?>&amp;activo=2&amp;sub=d"><span>ELIMINAR</span></a>
			</p>
		</div>
	</div>
</div>
<?php endforeach; ?>
<!-- include_once("classes/class.productos.php");
$productos= new productos();
$productos->select_all($pagina, $orden); -->

</div>

	
</div>


</body>
</html>