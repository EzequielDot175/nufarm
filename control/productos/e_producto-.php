<?php include_once('../resources/control.php'); header('Content-Type: text/html; charset=utf-8'); 
include_once('helper_titulos.php');
?>
<!DOCTYPE html>
<html>
<head>
	
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
      	strNombre: { 
			required: true, 
			minlength: 2 
			},
			strDetalle: { 
				required: true, 
				minlength: 2 
				},



	      },
	      messages: {
	        nombre: { 
			required: " Complete nombre", 
			minlength: "* 2 caracteres minimo." 
			},

			 strDetalle: { 
				required: " Complete Detalle", 
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

<script type="text/javascript">
	function revisar_talles(){
		//$('#tipotalles').html('Aguarde..');
		var idcategoria = $('#categorias').val();
		var idproducto = $('#idProducto').val();
		$('#tipotalles').load('talles_by_cat.php?idcategoria='+idcategoria+'&idproducto='+idproducto);
	}
</script>
</head>
<body>
<div id="top"></div>
<div id="bg1">
<div id="bg2">
<div id="bg3">
<div id="bg4">


<!-- Header -->
<div class="block">
	<?php include_once('../inc/header.php') ?>	
</div>



<div class="block">
	
<div class="three_4">
<div class="green-bar"><h4>Editar Producto</h4></div>
<?php

$id =$_GET['id'];
/* SELECT */
include_once("classes/class.productos.php");
$productos= new productos();
$productos->select($id);
$idProducto=$productos->getidProducto();
$strNombre=$productos->getstrNombre();
$strDetalle=$productos->getstrDetalle();
$intCategoria=$productos->getintCategoria();
$dblPrecio=$productos->getdblPrecio();
$intStock=$productos->getintStock();
$strImagen=$productos->getstrImagen();
$strImagen2=$productos->getstrImagen2();
$strImagen3=$productos->getstrImagen3();

?>
<form method="post" action="u_producto.php" id="simpleform"  enctype="multipart/form-data">
<div class="item">

<div class="colform">
<div class="form-item">
<div class="tiform">Nombre del producto</div>
<input type="text" name="strNombre" id="strNombre" value="<?php echo $strNombre;?>" />
</div>


<div class="form-item">
<div class="tiform">Detalle</div>
<textarea name="strDetalle" id="strDetalle"><?php echo $strDetalle;?></textarea>
</div>


<div class="form-item">
<div class="tiform">Categoria</div>
<select id="intCategorias" name="intCategoria" onchange="revisar_talles();">


<?php

include_once("../categorias/classes/class.categorias.php");
$cat= new categorias();
$cat->categorias_drop_list($intCategoria);



?>
</select>
</div></div>

<div class="colform">
<div class="form-item">
<div class="tiform">Precio</div>
<input type="text" name="dblPrecio" id="dblPrecio" value="<?php echo $dblPrecio;?>" />
</div>



<div class="form-item">

<p>
	<!-- ajax de tipo de talles -->
	<div id="tipotalles">
<?php

$categorias= new categorias();
$categorias->select($intCategoria);
$talles=$categorias->gettalles();


if($talles ==1){
	include_once("../talles/classes/class.talles.php");
	$tll= new talles();
	$talles_disp = $tll->select_all_clean();
	
	
	foreach($talles_disp as $id_talle_m){
		$talle_n= new talles();
		$talle_n->select($id_talle_m);
		$nombre_talle = $talle_n->getnombre_talle();
		$id_talle_tabla = $talle_n->getid_talle();

		
		
		include_once("classes/class.talles_productos.php");
	
		$tallprod = new talles_productos();
		$tallprod->select_by_producto($idProducto, $id_talle_m);
		$id_talle_producto = $tallprod->getid();
		#echo $id_talle = $tallprod->getid_talle();
		$id_producto = $tallprod->getid_producto();
		$cantidad = $tallprod->getcantidad();
		
		echo   '
		<div class="tallebox">
			<p>'.$nombre_talle.'</p>
			
			<p><input class="inputshort" type="text" name="talle['.$id_talle_m.']" value="'.$cantidad.'" ></p>
		</div>';
		$id_talle_m ="";
		
	}
	
	
}else{
	echo '
		<div class="form-item">
		<div class="tiform">Stock</div>
		<input type="text" name="intStock" id="intStock" value="'.$intStock.'" />
		</div>
	';
}



?>
</div>

</div>



<div class="form-item">
<div class="tiform">Imagen</div>
<?php 

if($strImagen!=""){
  echo '<div class="box-img2"><img src="../../images_productos/'.$strImagen.'" alt="" width="100"/></div>';
}else{
  echo '<p>Sin imagen</p>';
}
?>
<p><input type="file" name="strImagen" id="strImagen" value="<?php echo $strImagen;?>" /></p>
</div></div>

<div class="colform">
<div class="form-item">
<div class="tiform">Imagen 2</div>
<?php 
if($strImagen2!=""){
  echo '<div class="box-img2"><img src="../../images_productos/'.$strImagen2.'" alt="" width="100"/></div>';
}else{
  echo '<p>Sin imagen</p>';
}
?>
<p><input type="file" name="strImagen2" id="strImagen2" value="<?php echo $strImagen2;?>" /></p>
</div></div>

<div class="colform">
<div class="form-item">
<div class="tiform">Imagen 3</div>
<?php 

if($strImagen3!=""){
  echo '<div class="box-img2"><img src="../../images_productos/'.$strImagen3.'" alt="" width="100"/></div>';
}else{
  echo '<p>Sin imagen</p>';
}
?>
<p><input type="file" name="strImagen3" id="strImagen3" value="<?php echo $strImagen3;?>" /></p>
</div></div>

<input type="hidden" name="idProducto" id="idProducto" value="<?php echo $idProducto; ?>" />
<div class="form-item">
<p><button type="submit">Aceptar</button> <button type="button" class="btnback" onclick="javascript:history.back(1)">Cancelar</button></p>
</div>

</div>
</form>
	</div>
<div class="one_4"><h4>Opciones</h4>

		<ul class="menusidebar">

			<li><a class="active" href="n_<?php echo $singular; ?>.php">Crear <?php echo $singular; ?></a></li>

		</ul>

		
	</div>
</div>

<?php include_once('../inc/footer.php') ?>
</div></div></div></div>
</body>
</html>