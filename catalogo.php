<?php 
	require('inc/header.php');
	$producto = new producto();
	
	
?>

	
	<div class="lista-productos col-xs-12 col-sm-12 col-md-12 ol-lg-12">

		<!--buscador-->
		<div class="buscador col-xs-12 col-sm-12 col-md-12 ol-lg-12">
			<div class="filtros">
				<div class="input-buscador">
					<input type="text" class="find-input-in-results" value="">
					<img src="assets/images/buscador.png" alt="">
				</div>
			</div>
		</div>
		<!--end / buscador-->

		<?php 
			// for ($i=0; $i < 12 ; $i++) {
			foreach($producto->all() as $key => $val):
		 ?>
		 	<a href="detalle-producto.php?producto=<?php echo($val->idProducto) ?>">
		 	<!--item-->
			<div class="item col-xs-12 col-sm-3 col-md-3 ol-lg-3">
				<div class="mask">
					<p class="text-uppercase text-a">canjear</p>
					<p class="text-uppercase text-b">producto</p>
				</div>  
				<div class="img">
					<img src="images_productos/<?php echo($val->strImagen) ?>" alt="<?php echo($val->strNombre) ?>">
				</div>
				<h6 class="text-uppercase find-box-in-results"><?php echo($val->strNombre) ?></h6>
				<p class="descripcion"></p>
				<div class="footer-item">
					<p class="text-left">STOCK <?php echo($val->intStock) ?></p>

					<div class="block-puntos">
						<p class="num"><?php echo($val->dblPrecio) ?></p>
						<p class="text text-uppercase">puntos</p>
					</div>
				</div>
			</div>
			<!--end / item-->
		 	</a>

		<?php 
			endforeach;
		?>

	</div>



<!-- Footer -->
<?php require('inc/footer.php') ?>