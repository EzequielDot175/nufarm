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
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview1').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        
        function readURL2(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
        
                        reader.onload = function (e) {
                            $('#preview2').attr('src', e.target.result);
                        }
        
                        reader.readAsDataURL(input.files[0]);
                    }
                }
                
                function readURL3(input) {
                            if (input.files && input.files[0]) {
                                var reader = new FileReader();
                
                                reader.onload = function (e) {
                                    $('#preview3').attr('src', e.target.result);
                                }
                
                                reader.readAsDataURL(input.files[0]);
                            }
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
		var idcategoria = $('#item-categorias').val();
		var idproducto = $('#idProducto').val();
		$('#tipotalles').load('talles_by_cat.php?idcategoria='+idcategoria+'&idproducto='+idproducto);
	}
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

$id =$_GET['id'];
/* SELECT */
include_once("classes/class.productos.php");
$productos= new productos();
$productos->select($id);


$idProducto=$productos->getidProducto();
$strNombre=$productos->getstrNombre();
$intMinCompra = $productos->getMinCompra();
$intMaxCompra = $productos->getMaxCompra();
$strDetalle=$productos->getstrDetalle();
$intCategoria=$productos->getintCategoria();
$dblPrecio=$productos->getdblPrecio();
$intStock=$productos->getintStock();
$strImagen=$productos->getstrImagen();
$strImagen2=$productos->getstrImagen2();
$strImagen3=$productos->getstrImagen3();
$destacado=$productos->getdestacado();



?>
<div id="content-prod3">
<div class="barra-prod"><span>Editar Producto</span></div>

<form method="post" action="u_producto.php" id="simpleform"  enctype="multipart/form-data">

<div class="box-form-c">
	
	<div class="tiform6">Nombre</div>
	<input type="text" name="strNombre" class="campo-prod" value="<?php echo $strNombre;?>" />

</div>

<div class="box-form">

<div class="tiform6">Detalle</div>
<textarea name="strDetalle" class="campo-prod-detalle"><?php echo $strDetalle;?></textarea>

</div>

<div class="box-form">

<div class="tiform6">Precio</div>
<input type="text" name="dblPrecio" class="campo-prod" value="<?php echo $dblPrecio;?>" />

<div class="tiform6">Minima cantidad de compra</div>
<input type="number" name="intMinCompra" class="campo-prod" value="<?php echo $intMinCompra;?>" />

<div class="tiform6">Maxima cantidad de compra</div>
<input type="number" name="intMaxCompra" class="campo-prod" value="<?php echo $intMaxCompra;?>" />

<div class="tiform6">Categoría</div>
<select name="intCategoria" id="item-categorias" class="campo-prod" onchange="revisar_talles();">


<?php

include_once("../categorias/classes/class.categorias.php");
$cat= new categorias();
$cat->categorias_drop_list($intCategoria);



?>
</select>


<div id="tipotalles">
<?php

$categorias= new categorias();
$categorias->select($intCategoria);
$talles=$categorias->gettalles();
echo($talles);
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
		
}else if($talles == 2)
{
	include_once("../colores/classes/class.colores.php");
	include_once("classes/class.colores_productos.php");

	$id_product = $_GET["id"];
	$tll= new colores();
	$colores_disp = $tll->select_all_clean();
	$cat = new colores_productos();
	$row = $cat->getAllCategories($id_product);

	// echo("<pre>");
	foreach ($row as $key => $value) {
		echo   '
	 	<div class="tallebox">
	 	<p>'.$value->nombre.'</p>			
	 	<p><input class="inputshort" type="text" name="color['.$value->idColor.']" value="'.$value->cantidad.'" ></p>
	 	</div>';
	}
	// die();
	// echo("asda");
	// foreach($colores_disp as $id_color_m)
	// {
		
	// 	$color_n= new colores();
	// 	$color_n->select($id_color_m);


	// 	$nombre_color = $color_n->getnombre_color();
	// 	$id_color_tabla = $color_n->getid_color();

		
		
	
	// 	$colprod = new colores_productos();
	// 	$colprod->select_by_producto($idProducto, $id_color_m);
	// 	$id_color_producto = $colprod->getid();
	// 	#echo $id_talle = $tallprod->getid_talle();
	// 	$id_producto = $colprod->getid_producto();
	// 	$cantidad = $colprod->getcantidad();

	// 	echo   '
	// 	<div class="tallebox">
	// 	<p>'.$nombre_color.'</p>			
	// 	<p><input class="inputshort" type="text" name="color['.$id_color_m.']" value="'.$cantidad.'" ></p>
	// 	</div>';
	// 	// $id_color_m ="";
		
	// }
		
}else{
echo '
<div class="form-item">
<div class="tiform6">Unidades en Stock </div>
<input type="text" name="intStock" class="campo-prod" value="'.$intStock.'" />
<div class="tiform-desc"> Ingrese el total del nuevo stock</div>
</div>
';
}

?>


</div>		
</div>



<div class="box-form">

<div class="tiform6">Destacado</div>
<input type="text" name="destacado" class="campo-prod" value="<?php echo $destacado;?>" />

<h4>seleccionar imagenes</h4>

<div id="box-img-prod-c">
<div class="box-img-prod-01">
<?php 

if($strImagen!=""){
  echo '<img id="preview1" src="../../images_productos/'.$strImagen.'" alt="" width="100"/>';
}else{
  echo '<img id="preview1" src="../../images_productos/default.png" alt="" width="100" />';
}
?>
</div>

<div class="box-img-prod-01">
<div class="upload"><input type="file" name="strImagen" id="strImagen" onchange="readURL(this);" value="<?php echo $strImagen;?>" /></div>
</div>

</div>


<div class="box-form-btn">
<input type="hidden" name="idProducto" id="idProducto" value="<?php echo $idProducto; ?>" />
<button type="submit" class="button7">ACEPTAR</button> 
<button type="button" class="button7" onclick="window.location = 'v_productos.php';">CANCELAR</button>
</div>

</div>

</div>

</form>



<script>
	$(function() {
		$('#item-categorias').trigger('change');
		$(document).on('click', '.newColor', function(event) {
			event.preventDefault();
			var cat = $('#item-categorias').val();
			var id = window.location.search.match(/id=.*[0-9].&/ig);
				id = parseInt(id[0].replace(/id=/ig,'').replace(/&/ig,''));
			$.get('./talles_by_cat.php?idcategoria='+cat+'&idproducto='+id+'&action=add', function(data) {
				console.log(data);
				$('#tipotalles').append(data);
			});
		});
		$(document).on('click', '.removeColor', function(event) {
			event.preventDefault();
			var color = $(this).parent().parent().children('select').val();
			var cat = $('#item-categorias').val();
			var id = window.location.search.match(/id=.*[0-9].&/ig);
				id = parseInt(id[0].replace(/id=/ig,'').replace(/&/ig,''));
			if (confirm('¿Esta seguro de borrar este color y talles?')) {
				$(this).parents('.segmentTalleColor').remove();
				$.get('./talles_by_cat.php?idcategoria='+cat+'&idproducto='+id+'&action=delete&color='+color, function(data) {
					console.log(data);
				});
			};
		});
	});
</script>
</div><?php include_once('../inc/footer.php') ?></div>	</div>



</body>
</html>