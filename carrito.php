<?php 
	require('inc/header.php');
	$carrito = new ShoppingCart();
	$items = $carrito->all();

	
?>
<!-- Header -->

<!--detalle productos-->
<div class="carrito-productos col-xs-12 col-sm-12 col-md-12 ol-lg-12">

	<!--head-page-->
	<div class="head-page col-xs-12 col-sm-12 col-md-12 ol-lg-12">
		<h3><?php $carrito->cantidad() ?> productos agregados</h3>
	</div>
	<!--end / head-page-->

	<!-- tabla-detalle -->
	<table class="tabla-detalle col-xs-12 col-sm-12 col-md-12 ol-lg-12">

		<thead >
			<tr>
				<th class="col-D text-uppercase">productos</th>
				<th class="col-B text-uppercase">talle</th>
				<th class="col-C text-uppercase">color</th>
				<th class="col-B text-uppercase">unidades</th>
				<th class="col-B text-uppercase">puntos</th>
				<th class="col-A text-uppercase"></th>
				<th class="col-Total text-uppercase">total</th>
			</tr>
		</thead>

		<tbody>
			
			<?php 
			$i= 0;
			foreach($items as $key => $val):
			
				?>
				<!--!item-->
				<tr class="item">
					<td class="col-D">
						<div class="producto">
							<img src="images_productos/<?php echo $val->img ?>" alt="">
						</div>
						<div class="text-producto">
							<p class="text text-uppercase"><?php echo $val->name ?></p>
						</div>
					</td>
					<td class="col-B">
						<!-- SI NO HAY TALLE
							<p class="text-uppercase inactivo">n/a</p>
						-->
						<!-- color-->
						<p class="text-uppercase big-text"><?php echo $val->talle ?></p>
					</td>
					<td class="col-C">
						<!-- color-->
						<?php if($val->color == ''): //si no hay color ?>
							<p class="text-uppercase inactivo">n/a</p>
						<?php elseif(!is_null($val->color)): //si hay color ?>
						<div class="color">
							<span class="icon-color  color-verde " <?php echo Color::get($val->color) ?> ></span>
							<p class=" text-uppercase"><?php echo $val->color ?> </p>
						</div>
						<?php endif;  ?>
						<!-- end / color-->
					</td>
					<td class="col-B">
						<p class="text-uppercase big-text "><?php echo $val->cantidad ?> </p>
					</td>
					<td class="col-B">
						<p class="text-uppercase big-text "><?php echo $val->precio ?></p>
					</td>
					<td class="quitarA col-A">
						<a href="carrito_lista_delete.php?recordID=<?php echo $val->id ?>&require=<?php echo $val->type ?>">
							<p class="text-uppercase">
								quitar
								<img class="cerrar" src="assets/images/cerrar.png" alt="">
							</p>
						</a>
					</td>

					<?php 
					if($i == 0){
						?>
						<!--COLUMNA TOTAL (no se repite rowspan = cantidad de items) -->
						<td class="total col-Total" rowspan="<?php $carrito->cantidad() ?>">
							<div class="block-num">
								<p class="num ">$ <?php $carrito->total(); ?></p>
							</div>
						</td>
						<!--END / COLUMNA TOTAL -->
						<?php 
						$i++;
					}
					?>
				</tr>
				<!--end / item-->

				<?php 
			endforeach;
			?>

		</tbody>

	</table>
	<!--end /  tabla-detalle -->


	<!-- footer carrito -->
	<div class="footer-carrito col-xs-12 col-sm-12 col-md-12 ol-lg-12">

		<!-- botones -->
		<div class="col-xs-12 col-sm-9 col-md-9 ol-lg-9">
			<a href="catalogo.php">
				<div class='block-botones'>
					<button class="boton" type="">AGREGAR MAS PRODUCTOS</button>
				</div>
			</a>
		</div>
		<!--end /  botones -->
		<?php if(ShoppingCart::sum() > 0): ?>
		<!-- botones -->
		<div class="col-xs-12 col-sm-3 col-md-3 ol-lg-3">
			<div class='block-botones'>
				<a href="finalizacion.php">
					<button class="boton " type="">CONFIRMAR</button>
				</a>
			</div>
		</div>
		<!--end /  botones -->
		<?php endif; ?>
	</div>
	<!-- end / footer carrito -->


</div>
<!--end / historial productos-->


<!-- Footer -->
<?php require('inc/footer.php') ?>