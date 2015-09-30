<?php header('Content-Type: text/html; charset=utf-8');
include_once('../resources/control.php');
include_once('helper_titulos.php');
include_once('../resources/includes.php'); 
include_once('../../libs.php');

$usuarios = new Usuario();

if(isset($_POST['submit'])):
	// $usuarios->byFilter();
	$collection = $usuarios->byFilter();
else:
	$collection = $usuarios->getAll();
endif;


$vSelected = (isset($_POST['vendedor']) ? $_POST['vendedor'] : '');
$cSelected = (isset($_POST['cliente']) ? $_POST['cliente'] : '');

?>
<!DOCTYPE html>
<html>
<head>
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
	<input type="hidden" name="client" value="<?php echo $cSelected ?>">
	<div class="block">
		<div class="filtros_container">
			<div class="filtros-Default filtros-100">   
				<form action="" method="POST"> 
					<input type="hidden" name="filter"> 
					<h3> FILTRAR POR:</h3>   
					<select name="vendedor" id="svendedor">                     
						<option value="">VENDEDOR</option>   
						<?php Vendedor::options($vSelected); ?>  
					</select>    

					<select name="cliente"  id="scliente">    
						<option value="">CLIENTE</option> 
						<?php Cliente::options($cSelected); ?> 
					</select>  

					<button class="button-image" type="submit" ><img src="../layout/ver.png" alt=""> VER LISTADO DE RESULTADOS </button>     
					<input type="hidden" name="submit"> 
					<a href="n_usuario.php?activo=2&sub=e"><button class="button-image btn-new-client" type="submit" ><img src="../layout/ver.png" alt=""> NUEVO CLIENTE </button></a>     
				</form>    
			</div>   
		</div>
		<div class="prod_container">
			<div class="three_444 contenedor-default contenedor-A">

				<div class="three_444 contenedor-default contenedor-A">




					<table>
						<tbody><tr class="tablacolor3 tablaClientes">
							<td class="colA" align="center">IMG</td>  
							<td class="colB" align="center">EMPRESA</td>
							<td class="colC" align="center">CONTACTO</td>  
							<td class="colD" align="center">EMAIL</td>
							<td class="colE" align="center">CRÉDITO DISPONIBLE</td>
							<td></td>
						</tr>
					</tbody></table>
					<div class="item-content">
						<?php foreach($collection as $kcol => $vcol): ?>
							<table>
								<tbody>
									<tr class=" tablaClientes">
										<td class="colA" align="center">
											<img id="preview5" src="../../images_productos/default.png" alt="" width="100">
										</td>
										<td class="colB tdBackground" align="center">
											<span><?php echo $vcol->strEmpresa ?> <span>
											</span></span></td>
											<td class="colC tdBackground" align="center">
												<span><?php echo $vcol->strApellido ?> <?php echo $vcol->strNombre ?> </span>
											</td>
											<td class="colD tdBackground" align="center">
												<span><?php echo $vcol->strEmail ?></span>
											</td>
											<td class="colE tdBackground" align="center">
												<span> <?php echo $vcol->dblCredito ?> </span>
											</td>
											<td class="colF ">
												<div class="botones">
													<div class="item editar">
														<a href="e_usuario.php?id=<?php echo $vcol->idUsuario ?>&amp;activo=2&amp;sub=e">
															<img class="imagen" src="../layout/editar.png" alt="">
														</a>
													</div>
													<div class="item borrar">
														<a href="d_usuario.php?id=<?php echo $vcol->idUsuario ?>&amp;activo=2&amp;sub=e">
															<img class="imagen" src="../layout/borrar.png" alt="">
														</a>
													</div>
												</div>
											</td>
										</tr>

									</tbody>
								</table>
							<?php endforeach; ?>




							<div class="navigate">
								<?php 
								$paginas = $usuarios->getPages();
								for ($i=1; $i < $paginas; $i++):

									?>
								<a class="paginate" 
								title="Go to page <?php echo $i ?> of <?php echo $paginas ?>" 
								href="?page=<?php echo $i ?>&amp;activo=2&amp;sub=e&amp;"><?php echo $i ?></a>
								<?php
								endfor;
								?>
							</div>


						</div>	
					</div>

				</div>
			</div>
			<?php include_once('../inc/footer.php') ?>

		</div>

<script>
			jQuery(document).ready(function($) {
				$('#svendedor').change(function(event) {
					event.preventDefault();
					$.post('../compras/ajax.php', {comboFiltro: '' , vendedor: $(this).val()}, function(data, textStatus, xhr) {
						$('#scliente').html(data);
						$('input[name="client"]').trigger('click'); 
					});
				});

				var client_val = $('input[name="client"]').val();
				if (client_val != "") {
					$('#svendedor').trigger('change');
		        // $('option[value="'+client_val+'"]').attr('selected', 'true');
		        $('input[name="client"]').on('click', function(event) {
		        	$('option[value="'+client_val+'"]').attr('selected', '');
		        });
		    };


    $('#svendedor').trigger('change');


    $('.confirm-link').click(function(event) {
    	if (!confirm('¿Esta seguro que desea borrar este item?')) {
    		event.preventDefault();
    	};
    });


    $('.btn-new-client').click(function(event) {
    	event.preventDefault();
    	var url = $(this).parent().attr('href');
    	window.location.href = url;
    });
});
</script>

</body>
</html>