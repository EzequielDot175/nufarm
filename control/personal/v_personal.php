<?php include_once('../resources/control.php'); error_reporting(0); header('Content-Type: text/html; charset=utf-8');

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
$(function() {
$("#fecha").datepicker({altFormat: 'yy-mm-dd'});

});
</script>
</head>
<body>
<!-- Header -->

	<?php include_once('../inc/header.php') ?>	

<div class="block">
	
<div class="general_container">
<div class="three_444 contenedor-default contenedor-A">

<!-- SIDEBAR
<div class="product_filter_consulta_column">
<div class="item">
<a href="v_personal.php?activo=2&sub=h"><div class="olive-bar_new3"><span>VER TODOS</span></div></a>
</div><div class="item">
	<a href="v_personal.php?activo=2&sub=h&filtro_personal=1"><div class="pub-eve"><span>ADMINISTRADOR</span></div></a>
	<a href="v_personal.php?activo=2&sub=h&filtro_personal=2"><div class="pub-eve"><span>MARKETING</span></div></a>
	<a href="v_personal.php?activo=2&sub=h&filtro_personal=3"><div class="pub-eve"><span>VENDEDOR</span></div></a>
	</div>
</div>		
-->

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
$orden = "id DESC";
}
if($orden==2){
$orden = "id ASC";
}
if($orden==3){
$orden = "id ASC";
}
if($orden==""){
$orden = "id ASC";
}

echo '<div class="menuorden"><a href="v_personal.php?orden=1"><img src="../layout/btn-orden1.png" alt="desc"/></a><a href="v_personal.php?orden=2"><img src="../layout/btn-orden2.png" alt="desc"/></a></div>';
/* SELECT */
echo '<div id="content-consultas">';
echo '
	<table>
	     <tr class="tablacolor3 tablaPersonal" >
	       <td  class="colA" align="center" >IMG</td>  
	       <td class="colB" align="center">EMPRESA</td>
	       <td  class="colC" align="center" >LOGIN</td>  
	       <td class="colD" align="center">TIPO DE USUARIO</td>
	       <td></td>
	     </tr>
	</table>
    ';
include_once("classes/class.personal.php");
$personal= new personal();
$personal->select_all($pagina, $orden);
echo '</div>';
?>	
</div>
</div>
<?php include_once('../inc/footer.php') ?></div>


</body>
</html>