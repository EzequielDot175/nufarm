<?php header('Content-Type: text/html; charset=utf-8');
include_once('../resources/control.php');
include_once('helper_titulos.php');
?>
<!DOCTYPE html>
<html>
<head>

	<title></title>
	


	<!-- charset -->
	<meta charset="utf-8">
	<!-- Mobile Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<!-- Description -->
	<meta name="description" content="">

	<?php include_once('../resources/includes.php'); ?>



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
$orden = "id_color DESC";
}
if($orden==2){
$orden = "id_color ASC";
}
if($orden==3){
$orden = "id_color ASC";
}
if($orden==""){
$orden = "id_color ASC";
}

echo '<div class="menuorden"><a href="v_color.php?orden=1"><img src="../layout/btn-orden1.png" alt="desc"/></a><a href="v_color.php?orden=2"><img src="../layout/btn-orden2.png" alt="desc"/></a></div>';
/* SELECT */
echo '<div id="content-prod">';
echo '<div class="barra-prod"><span>ADMINISTRAR COLORES</span></div>';
include_once("classes/class.colores.php");
$colores= new colores();
$colores->select_all($pagina, $orden);
echo '<div class="linea-talles"></div>';
echo '<a  class="cat-add" href="n_color.php">CREAR NUEVO</a>';
echo '</div>';
?>	
</div>	
<?php include_once('../inc/footer.php') ?>
</div><!-- end block -->
</body></html>

