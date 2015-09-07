<?php header('Content-Type: text/html; charset=utf-8');
include_once('../resources/control.php');
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
$(document).ready(function(){
    $("#simpleform").validate({
      event: "blur",
      rules: {
       strNombre: { 
		required: true, 
		minlength: 2 
		},
		
		strApellido: { 
			required: true, 
			minlength: 2 
			},
			
			strEmail: { 
				required: true, 
				minlength: 2 
				},
		     
      
      },
      messages: {
        strNombre: { 
		required: " Complete Nombre", 
		minlength: "* 2 caracteres minimo." 
		},
		strApellido: { 
		required: " Complete Apellido", 
		minlength: "* 2 caracteres minimo." 
		},
		strEmail: { 
		required: " Complete Email", 
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
$("#vigencia_credito").datepicker({altFormat: 'yy-mm-dd'});

});
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
        </script>
</head>
<body>

<!-- Header -->
	<?php include_once('../inc/header.php') ?>	
<div class="block">
	
	<div class="three_4">


<div class="item-content-usuarios">
<div class="barra-prod"><span>CLIENTE</span></div>
<form method="post" action="c_usuario.php" id="simpleform" enctype="multipart/form-data">

<div class="columna_form_c">
<div class="box-col-left">
<img id="preview1" src="../../images_productos/default.png" alt="" width="100" /><br />
<div class="upload4"><input type="file" name="logo" id="logo"  onchange="readURL(this);"/></div>
</div>

<div class="box-col-right">
<div class="tiform6">Empresa</div>
<input type="text" name="strEmpresa" class="campo-prod" />
</div>


</div>

<div class="columna_form2">

<div class="tiform6">Nombre</div>
<input type="text" name="strNombre" class="campo-prod"/>

<div class="tiform6">Apellido</div>
<input type="text" name="strApellido" class="campo-prod"/>

<div class="tiform6">Email</div>
<input type="text" name="strEmail" class="campo-prod"/>

<div class="tiform6">Cargo</div>
<input type="text" name="strCargo" class="campo-prod"/>

<div class="tiform6">Password</div>
<input type="text" name="strPassword" class="campo-prod"/>


<div class="tiform6">Dirección</div>
<input type="text" name="direccion" class="campo-prod"/>

<div class="tiform6">Teléfono</div>
<input type="text" name="telefono" class="campo-prod"/>


</div>
<!-- columna_form -->


<div class="columna_form2">


<div class="tiform6">Crédito</div>
<input type="text" name="dblCredito" class="campo-prod"/>

<div class="tiform6">Vigencia crédito</div>
<input type="text" name="vigencia_credito" class="campo-prod"/>

<div class="tiform6">Vendedor</div>
<select name="vendedor" class="campo-prod">
	<?php  include_once('../personal/classes/class.personal.php');
		$ven = new personal();
		$ven->select_vendedores();
	?>
</select>


<button type="submit" class="button">Aceptar</button> <button type="reset" class="button">Borrar</button> <button type="button" class="button" onclick="javascript:history.back(1)">Cancelar</button>
</div><!-- columna_form -->

</form>

</div></div>
<?php include_once('../inc/footer.php') ?>
</div>


</body>
</html>