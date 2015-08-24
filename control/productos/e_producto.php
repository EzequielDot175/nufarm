<?php include_once('../resources/control.php'); header('Content-Type: text/html; charset=utf-8'); 
include_once('helper_titulos.php');
require_once('../../libs.php');
error_reporting(E_ALL);
ini_set('display_errors', 'On');
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
$prod = new Producto();
$data = $prod->allById($id);
$type = $prod->defineType($id);
echo('<h1>'.$type->type.'</h1>');
?>

<div id="content-prod3">
<div class="barra-prod"><span>Editar Producto</span></div>

<form method="post" action="u_producto.php" id="simpleform"  enctype="multipart/form-data">

<div class="box-form-c">
	
	<div class="tiform6">Nombre</div>
	<input type="text" name="strNombre" class="campo-prod" value="<?php echo $data->strNombre;?>" />

</div>

<div class="box-form">

<div class="tiform6">Detalle</div>
<textarea name="strDetalle" class="campo-prod-detalle"><?php echo $data->strDetalle;?></textarea>

</div>

<div class="box-form">

<div class="tiform6">Precio</div>
<input type="text" name="dblPrecio" class="campo-prod" value="<?php echo $data->dblPrecio;?>" />

<div class="tiform6">Minima cantidad de compra</div>
<input type="number" name="intMinCompra" class="campo-prod" value="<?php echo $data->intMinCompra;?>" />

<div class="tiform6">Maxima cantidad de compra</div>
<input type="number" name="intMaxCompra" class="campo-prod" value="<?php echo $data->intMaxCompra;?>" />

<div class="tiform6">Categoría</div>
<input type="hidden" id="type_talle" value="<?php echo($type->type) ?>">


<select name="intCategoria" id="item-categorias" class="campo-prod" onchange="revisar_talles();">
	<?php 
	$categorias = $prod->categorias();
	foreach($categorias as $k => $v ): 
			if($type->id_cat !=  $v->idCategorias):
		?>
		<option value="<?php echo($v->idCategorias) ?>"><?php echo($v->strDescripcion) ?></option>
	<?php
			else: ?>
		<option selected value="<?php echo($v->idCategorias) ?>"><?php echo($v->strDescripcion) ?></option>
	<?php   endif;
	endforeach; ?>
</select>


<div id="tipotalles">
<?php

// $categorias= new categorias();
// $categorias->select($intCategoria);
// $talles=$categorias->gettalles();
// echo($talles);
if($type->type ==1){
// include_once("../talles/classes/class.talles.php");
// $tll= new talles();
// $talles_disp = $tll->select_all_clean();
		
// foreach($talles_disp as $id_talle_m){
// $talle_n= new talles();
// $talle_n->select($id_talle_m);
// $nombre_talle = $talle_n->getnombre_talle();
// $id_talle_tabla = $talle_n->getid_talle();
		
// include_once("classes/class.talles_productos.php");
	
// $tallprod = new talles_productos();
// $tallprod->select_by_producto($idProducto, $id_talle_m);
// $id_talle_producto = $tallprod->getid();
// #echo $id_talle = $tallprod->getid_talle();
// $id_producto = $tallprod->getid_producto();
// $cantidad = $tallprod->getcantidad();

// echo   '
// <div class="tallebox">
// <p>'.$nombre_talle.'</p>			
// <p><input class="inputshort" type="text" name="talle['.$id_talle_m.']" value="'.$cantidad.'" ></p>
// </div>';
// $id_talle_m ="";
		
// }
		
}else if($type->type == 2){ ?> 
	
	<div class="tallebox">
	<p>'.$value->nombre.'</p>			
	<p><input class="inputshort" type="text" name="color['.$value->idColor.']" value="'.$value->cantidad.'" ></p>
	</div>';

	<div class="tallebox">
	<p>'.$nombre_color.'</p>			
	<p><input class="inputshort" type="text" name="color['.$id_color_m.']" value="'.$cantidad.'" ></p>
	</div>';
	
<?php	
}else{
echo '
<div class="form-item">
<div class="tiform6">Unidades en Stock </div>
<input type="text" name="intStock" class="campo-prod" value="'.$data->intStock.'" />
<div class="tiform-desc"> Ingrese el total del nuevo stock</div>
</div>
';
}

?>


</div>		
</div>



<div class="box-form">

<div class="tiform6">Destacado</div>
<input type="text" name="destacado" class="campo-prod" value="<?php echo $data->destacado;?>" />

<h4>seleccionar imagenes</h4>

<div id="box-img-prod-c">
<div class="box-img-prod-01">
<?php 

if($data->strImagen!=""){
  echo '<img id="preview1" src="../../images_productos/'.$data->strImagen.'" alt="" width="100"/>';
}else{
  echo '<img id="preview1" src="../../images_productos/default.png" alt="" width="100" />';
}
?>
</div>

<div class="box-img-prod-01">
<div class="upload"><input type="file" name="strImagen" id="strImagen" onchange="readURL(this);" value="<?php echo $data->strImagen;?>" /></div>
</div>

</div>


<div class="box-form-btn">
<input type="hidden" name="idProducto" id="idProducto" value="<?php echo $data->idProducto; ?>" />
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
			var color = $(this).parent().children('input[name=id_color]').val() || null;
			var prod = $(this).parent().children('input[name=id_prod]').val() || null;
			var cat = $('#item-categorias').val();
			
			if (confirm('¿Esta seguro de borrar este color y talles?')) {
				if (color != null) {
					$.get('./talles_by_cat.php?idcategoria='+cat+'&idproducto='+prod+'&action=delete&color='+color, function(data) {
						console.log(data);
					});
				};
				$(this).parents('.segmentTalleColor').remove();
				
			};
		});
	});
</script>
</div><?php include_once('../inc/footer.php') ?></div>	</div>



</body>
</html>