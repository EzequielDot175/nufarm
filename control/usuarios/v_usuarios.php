<?php header('Content-Type: text/html; charset=utf-8');
include_once('../resources/control.php');
include_once('helper_titulos.php');
?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once('../resources/control.php'); ?>
	<title></title>
	<link rel="stylesheet" type="text/css" media="all" href="../layout/main.css" />
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
	<div class="filtros_container">   
       <div class="filtros-Default filtros-100">   
            <form action="" method="POST"> 
            <input type="hidden" name="filter"> 
                  <h3> FILTRAR POR:</h3>   
                  <select name="vendedor"><option value="">VENDEDOR</option>   
                 </select>    
     
                  <select name="cliente" >    
                    <option value="">CLIENTE</option>    
                  </select>    
     
                  <select name="estado">   
                    <option value="">ESTADO</option>   
                  </select>    
     
                  <button class="button-image" type="submit" ><img src="../layout/ver.png" alt=""> VER LISTADO DE RESULTADOS </button>     
            </form>    
      </div>   
  </div>
<div class="prod_container">
<div class="three_444 contenedor-default contenedor-A">

<!--SIDEBAR
<div class="product_filter_vend_column_users">
<nav id="interna2">
<ul>
	<li><a class="btn-micuenta5" href="n_<?php echo $singular; ?>.php?activo=2&sub=e"><span>Crear cliente nuevo</span></a></li>	
</ul>
</nav>
<?php 
include_once("../compras/classes/class.compras.php");
$compras2= new compras();
$compras2->select_all_vendedores_clientes();
?>
</div>
-->

<?php
if($_SESSION['msg_ok']){echo '<div class="notify_ok-ok"><p>'.$_SESSION['msg_ok'].'</p></div>'; unset($_SESSION['msg_ok']);}
if($_SESSION['msg_error']){echo '<div class="notify_error"><p>'.$_SESSION['msg_error'].'</p></div>'; unset($_SESSION['msg_error']);}
if($_SESSION['msg_warning']){echo '<div class="notify_warning"><p>'.$_SESSION['msg_warning'].'</p></div>'; unset($_SESSION['msg_warning']);}


$pagina=$_GET['page'];
$ipp=$_GET['ipp'];
if(!$pagina){
$pagina==0;
}
$orden= $_GET['orden'];

if($orden==1){
$orden = "idUsuario DESC";
}
if($orden==2){
$orden = "idUsuario ASC";
}
if($orden==3){
$orden = "idUsuario ASC";
}
if($orden==""){
$orden = "idUsuario ASC";
}

//echo '<div class="menuorden"><a href="v_usuarios.php?orden=1"><img src="../layout/btn-orden1.png" alt="desc"/></a><a href="v_usuarios.php?orden=2"><img src="../layout/btn-orden2.png" alt="desc"/></a></div>';
/* SELECT */
echo '
	<table>
	         <tr class="tablacolor3 tablaClientes" >
	           <td class="colA" align="center">IMG</td>  
	           <td class="colB" align="center">EMPRESA</td>
	           <td class="colC" align="center">CONTACTO</td>  
	           <td class="colD" align="center">EMAIL</td>
	           <td class="colE" align="center">CRÉDITO DISPONIBLE</td>
	           <td></td>
	         </tr>
      	</table>
       ';
echo '<div class="item-content">';
include_once("classes/class.usuarios.php");
$usuarios= new usuarios();
$usuarios->select_all($pagina, $orden);
echo '</div>';
?>	
</div>
</div>
<?php include_once('../inc/footer.php') ?>
</div>

</body>
</html>