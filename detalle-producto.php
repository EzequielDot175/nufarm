<?php 
	require('inc/header.php');
	$producto = new producto($_GET['producto']);
	$detalles = $producto->details();

	$tempMaxCompra = new TempMaxCompra();
	$tempMaxCompra->haveMaxCompra();
	$limitCompraProd = $tempMaxCompra->getMaxProd();
	$limitCompra = $tempMaxCompra->getMaxCompra();

	$intMinCompra = ($limitCompra - $detalles->intMinCompra < 1 ? 1 : $limitCompra - $detalles->intMinCompra  );

	
?>
<!-- Header -->

<!--detalle productos-->
	<div class="detalle-productos col-xs-12 col-sm-12 col-md-12 col-lg-12">

		<!--buscador-->
		<div class="buscador col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="filtros">
				<!--<input type="text" name="" value="">-->
			</div>
		</div>
		<!--end / buscador-->

		<!--col-a-->
		<div class="col-a block background-a col-xs-12 col-sm-4 col-md-4 col-lg-4">
			<div class="img">
				<img src="images_productos/<?php echo($detalles->strImagen) ?>" alt="">
			</div>
			<div class="logo">
				<div class="inner">
					<img src="assets/images/nufarm-logo-box.png" class="img-responsive">
					<p>
						<strong>
							LOGO: ATENCIÓN!
						</strong>
						Debido a la superficie reducida, este producto admite solo el logo de Nufarm.
					</p>
				</div>
			</div>
		</div>
		<!--end / col-a-->


		<!--col-b-->
		<div class="col-b col-xs-12 col-sm-8 col-md-8 col-lg-8">
			
			<div class=" block block-head background-a col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="block-puntos">
					<p class="num"><?php echo($detalles->dblPrecio) ?></p>
					<p class="text text-uppercase">puntos</p>
				</div>
				<h3 class="text-uppercase sub-titulo"><?php echo($detalles->strNombre) ?></h3>
				<p class="descripcion"><?php echo($detalles->strDetalle) ?></p>
			</div>

			<div class=" block background-b col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<!-- titulo general -->
				<h3 class="text-uppercase sub-titulo">PEDIDO</h3>
				<!--end / titulo general -->
				
				<!-- sub-titulo-->
				<h3 class="text-uppercase sub-titulo-B">
					<span>LÍMITES DE CANJE</span>
				</h3>
				<!-- end / sub-titulo-->
				<?php if(!empty($intMinCompra)): ?>
				<div class="block-num">
					<p class="text text-uppercase">MÍNIMO</p>
					<div class="icon-num">
						<p><?php echo $intMinCompra ?></p>
					</div>
				</div>
				<?php endif; ?>

				<?php if(!is_null($limitCompraProd) ): ?>
				<div class="block-num">
					<p class="text text-uppercase">MÁXIMO</p>
					<div class="icon-num">
						<p><?php echo ($limitCompraProd > 0 ? $limitCompraProd : 0 ) ?></p>
					</div>
				</div>
				<?php endif; ?>

				<?php if(!is_null($limitCompra) && $limitCompra != "notlimit"  ): ?>
				<div class="block-num red">
					<p class="text text-uppercase">MÁXIMO RESTANTE</p>
					<div class="icon-num">
						<p><?php echo($limitCompra); ?></p>
					</div>
				</div>
				<?php endif; ?>

				<form action="carrito_add.php" method="post" id="add_product">
					<input type="hidden" name="type" value="<?php echo($detalles->type) ?>">
					<input type="hidden" id="max" value="<?php echo ($limitCompra) ?>">
					<input type="hidden" id="min" value="<?php echo($intMinCompra) ?>">
				<?php 
				/**
				 * @internal  
				 * SI EL PRODUCTO ES DE TIPO N°1 [TALLES]
				 */
				if($detalles->type == 1):
				?>
				<table class="talles">
					<tbody>
						<tr>
						<?php foreach($detalles->talles as $key => $val): ?>
							<td <?php echo Producto::disable($val->cantidad)->opacity ?> >
								<label  class="talle text-uppercase "><?php echo($val->talle) ?></label >
								<input <?php echo Producto::disable($val->cantidad)->disabled ?>
										 class="input_talle" 
										 type="number" 
										 min="1" 
										 max="<?php echo($val->cantidad) ?>" 
										 name="talle[<?php echo($val->id) ?>]" 
										 value="" >
								<span class="text-uppercase unidades"><?php echo($val->cantidad) ?> u</span>
							</td>
						<?php endforeach; ?>
						</tr>
					</tbody>
				</table>
				<!--end /  talles -->

				<?php
				endif; 
				/**
				 * @internal  
				 * SI EL PRODUCTO ES DE TIPO N°2 [COLORES]
				 */
				if($detalles->type == 2):
				?>
				<?php foreach($detalles->colores as $key => $val):
						if($val->cantidad > 0):
				 ?>
				<h3 class="text-uppercase sub-titulo-B color" <?php echo Producto::disable($val->cantidad)->opacity ?> >
					<span><div class="icon-color color-verde"></div><?php echo($val->color) ?></span>
				</h3>
				<table class="talles talles-unico">
					<tbody>
						<tr>
							<td <?php echo Producto::disable($val->cantidad)->opacity ?> >
								<label  class="talle text-uppercase "></label >
								<input <?php echo Producto::disable($val->cantidad)->disabled ?> class="input_talle" type="number" min="0" max="<?php echo($val->cantidad) ?>" name="color[<?php echo($val->id) ?>]" value="" >
								<span class="text-uppercase unidades"><?php echo($val->cantidad) ?> u</span>
							</td>
						</tr>
					</tbody>
				</table>
				<?php
						endif; 
					endforeach;
				endif; 
				/**
				 * @internal  
				 * SI EL PRODUCTO ES DE TIPO N°3 [TALLES-COLORES]
				 */
				if($detalles->type == 3):
					foreach($detalles->talles_colores as $key => $val):
				?>

				<h3 class="text-uppercase sub-titulo-B color"  >
					<span><div class="icon-color color-verde"></div><?php echo($val['color']->nombre) ?></span>
				</h3>
				<table class="talles">
					<tbody>
						<tr>
							<?php foreach($val['talle'] as $tkey => $tval): ?>
							<td <?php echo Producto::disable($tval->cantidad)->opacity ?> >
								<label  class="talle text-uppercase "><?php echo($tval->nombre) ?></label >
								<input  <?php echo Producto::disable($tval->cantidad)->disabled ?> class="input_talle" type="number" min="0" max="<?php echo($tval->cantidad) ?>" name="pedido[<?php echo($val['color']->id_color) ?>][talle][<?php echo($tval->id_talle) ?>]" value="" >
								<span class="text-uppercase unidades"><?php echo($tval->cantidad) ?> u</span>
							</td>
						<?php endforeach; ?>
						</tr>
					</tbody>
				</table>
				<?php
					endforeach;
				endif;
				/**
				 * @internal  
				 * SI EL PRODUCTO ES DE TIPO N°0 [SOLO CANTIDAD]
				 */
				if($detalles->type == 0):
				?>

				<table class="talles talles-unico">
					<tbody>
						<tr>
							<td <?php echo Producto::disable($detalles->intStock)->opacity ?> >
								<input  <?php echo Producto::disable($detalles->intStock)->disabled ?> class="input_talle" type="number" min="0" max="<?php echo($detalles->intStock) ?>" name="cantidad" value="" >
								<span class="text-uppercase unidades"><?php echo($detalles->intStock) ?> u</span>
							</td>
						</tr>
					</tbody>
				</table>


				<?php endif; ?>

			


				<!-- mensaje error -->
				<div class='mensaje-error hidden' id="error_1">
					<img class="icon" src="assets/images/error-icon.png" alt="">
					<p class="text text-uppercase">CANTIDAD MÁXIMA DE CANJE EXCEDIDO</p>
				</div>
				<!--end /  mensaje error -->

				<!-- botones -->
				<div class='block-botones'>
					<a href="catalogo.php" class="boton href">CANCELAR</a>
					<button class="boton" type="submit">AGREGAR</button>
				</div>
				<!--end /  botones -->
				<input type="hidden" name="idProducto" value="<?php echo($_GET['producto']) ?>">
				</form>
			</div>

		</div>
		<!--end / col-b-->

	</div>
	<!--end / detalle productos-->


<!-- Footer -->
<?php require('inc/footer.php') ?>