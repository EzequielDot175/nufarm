<?php header('Content-Type: text/html; charset=utf-8');
include_once('../resources/control.php');
include_once('helper_titulos.php');
?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once('../resources/control.php'); ?>
	<title></title>


	<!-- charset -->
	<meta charset="utf-8">
	<!-- Mobile Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<!-- Description -->
	<meta name="description" content="">

<?php include_once('../resources/includes.php'); ?>

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
	function revisar_talles(){
		//$('#tipotalles').html('Aguarde..');
		var idcategoria = $('#item-categorias2').val();
		var idproducto = 0;
		$('#tipotalles').load('talles_by_cat.php?idcategoria='+idcategoria+'&idproducto='+idproducto);
	}
</script>



</head>
<body>

<!-- Header -->
	<?php include_once('../inc/header.php') ?>
<div class="block">
	
<div class="three_4">
   			<div class="prop"><?php  

include_once("../propuestas/classes/class.propuestas.php");
$prop= new propuestas();
$prop->sin_responder();


?></div>


<div class="item-group-btn">
<a class="btn-fill" href="<?php  echo BASEURL.'/productos/n_producto.php?activo=2&sub=d';?>"><span><p>Crear nuevo producto</p></span></a>
<a class="btn-fill"href="<?php  echo BASEURL.'/categorias/v_categorias.php?activo=2&sub=d';?>"><span><p>Administrar Categorías</p></span></a>
<a class="btn-fill" href="<?php  echo BASEURL.'/talles/v_talles.php?activo=2&sub=d';?>"><span><p>Administrar Talles</p></span></a>
<a class="btn-fill" href="<?php  echo BASEURL.'/colores/v_color.php?activo=2&sub=d';?>"><span><p>Administrar Colores</p></span></a>
</div>

<div id="content-prod2">

<div class="barra-prod"><span>Crear Producto</span></div>
<div class="item-form">

<form method="post" action="c_producto.php" id="simpleform" enctype="multipart/form-data">


<div class="box-form-c">
<div class="tiform6">Nombre</div>
<input type="text" name="strNombre" class="campo-prod" />
</div>

<div class="box-form">
<div class="tiform6">Detalle</div>
<textarea name="strDetalle" class="campo-prod-detalle" cols="30" rows="10"></textarea>
</div>

<div class="box-form">
<div class="tiform6">Precio</div>
<input type="text" name="dblPrecio" class="campo-prod" placeholder="$"/>

<div class="tiform6">Categoría</div>
<select class="campo-prod" id="item-categorias2" name="intCategoria" onchange="revisar_talles();">
	<?php
	include_once("../categorias/classes/class.categorias.php");
	$cat= new categorias();
	$cat->categorias_drop_list(0);
	?>
</select>

<div id="tipotalles">
		<input type="text" name="intStock" id="intStock" />
	</div>

</div>

<div class="box-form">
<div class="tiform6">Destacado </div>	
<!-- ajax de tipo de talles -->
<input type="text" name="destacado" class="campo-prod" />


<h4>seleccionar imagenes</h4>

<div id="box-img-prod-c">
<div class="box-img-prod-01">
<img id="preview1" src="../../images_productos/default.png" alt="" width="100" />	
</div>


<div class="box-img-prod-01">
<div class="upload"><input type="file" name="strImagen" id="strImagen" onchange="readURL(this);"/></div>
</div>

</div>

<div class="box-form-btn">
<button type="submit" class="button6">Aceptar</button> 
<button type="button" class="button6" onClick="javascript:history.back(1)">Cancelar</button>
</div>
</div>


</form>
	</div></div></div>
<?php include_once('../inc/footer.php') ?>	
</div>


</body>
</html>