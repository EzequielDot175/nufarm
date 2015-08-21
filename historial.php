<?php 
	require_once('inc/header.php');
	/*Historial::get();
	die();*/
?>
		
	<!--detalle productos-->
	<div class="historial-productos col-xs-12 col-sm-12 col-md-12 ol-lg-12">

		<!--head-page-->
		<div class="head-page col-xs-12 col-sm-12 col-md-12 ol-lg-12">
			<div class="filtros">
				<p class="text-uppercase">filtro</p>
				<input type="text" name="" value="">
				<select name="" >
					<option class="opciones" value="opciones">opciones</option>
					<option class="opciones" value="opciones">opciones</option>
					<option class="opciones" value="opciones">opciones</option>
				</select>
			</div>
		</div>
		<!--end / head-page-->


		<!--acordeon historial-->
		<div class="acordeon-general panel-group" id="accordion">

			<!-- head tabla-detalle -->
			<table class="tabla-detalle">
				<thead>
					<tr>
						<th class="text-uppercase col-A" colspan="2">canje</th>
						<th class="text-uppercase col-Auto">productos</th>
						<th class="text-uppercase col-B">talle</th>
						<th class="text-uppercase col-C">color</th>
						<th class="text-uppercase col-B">unidades</th>
						<th class="text-uppercase col-B">puntos</th>
						<th class="text-uppercase col-D">estado</th>
						<th class="text-uppercase col-D">remito</th>
					</tr>
				</thead>

			</table>
			<!--end /  head tabla-detalle -->

			<?php 
				$cantItems = 6;
				for ($i=0; $i < $cantItems ; $i++) { 
			 ?>

			<!--ITEM accordeon-->
			<div class="item">

				<!--head accordeon-->
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i;?>" class="<?php if($i != 0){echo 'collapsed';}; //accordeon abierto ?> ">
					<div class="panel-heading">
						<h4>
							2015/03/20 10:38:40
						</h4>
						<div class="flecha"></div>
					</div>
				</a>
				<!--end / head accordeon-->

				<!--body accordeon-->
				<div id="collapse<?php echo $i;?>" class="panel-collapse collapse <?php if($i == 0){echo 'in';}; //accordeon abierto ?> ">
					<div class="panel-body">
						<!-- tabla-detalle -->
						<table class="tabla-detalle">

							<tbody>

								<?php 
									$cantPedidos = 6;
									for ($x=0; $x < $cantPedidos ; $x++) { 
								 ?>
								 

								<!--*********** ITEM *********-->
								<tr>	
									<!--total puntos (columna no se repite ->rowspan = cantidad de items) -->
									<?php   if($x == 0){   ?>
									<td class=" vertical-align-top" rowspan="<?php echo $cantItems ?>">
										<div class="puntos">
											<p class="num">450</p>
											<span class="text-uppercase">puntos</span>
										</div>
									</td>
									<?php } ?>
									<!--end / total puntos -->
									
									<!-- img -->
							 		<td class="">
										<div class="producto">
											<img src="assets/images/producto.png" alt="">
										</div>
									</td>
									<!--end /  img -->
									
									<!--nombre -->
									<td class="col-Auto">
										<div class="background-2">
											<p class="text text-uppercase">camisa escosesa</p>
										</div>
									</td>
									<!--end /  nombre -->
									
									<!-- talle -->
									<td class="col-B">
										<div class="background-2">
											<!-- SI NO HAY TALLE-->
											<!-- <p class="text-uppercase inactivo">n/a</p>-->
											<p class="text-uppercase big-text">m</p>
										</div>
									</td>
									<!--end /  talle -->

									<!--color -->
									<td class="col-C">
										<div class="background-2">
											<!-- SI NO HAY COLOR-->
											<!-- <p class="text-uppercase inactivo">n/a</p>-->
											<div class="color">
												<span class="icon-color  color-verde "></span>
												<p class=" text-uppercase">gris oscuro </p>
											</div>
										</div>
									</td>
									<!--end /  color -->

									<!--unidades -->
									<td class="col-B">
										<div class="background-2">
											<p class="text-uppercase big-text ">15</p>
										</div>
									</td>
									<!--end / unidades -->
									
									<!--puntos -->
									<td class="col-B">
										<div class="background-2">
											<p class="text-uppercase big-text ">450</p>
										</div>
									</td>
									<!--end / puntos -->
									
									<!--estado -->
									<td class="col-D">
										<div class="background-1 pendiente">
											<!-- IMAGEN PARA DIFERENTES ESTADOS-->
											<!-- <img src="assets/images/entregado.png" alt="">-->
											<!-- <img src="assets/images/enviado.png" alt="">-->
											<img src="assets/images/entregado.png" alt="">
											<p class="text text-uppercase">entregado</p>
										</div>
									</td>
									<!--end / estado -->
									
									<!--remito -->
									<td class="col-D">
										<div class="background-1">
											<p class="medium-text text-uppercase">Nº 04517</p>
										</div>
									</td>
									<!--end / remito -->
								</tr>
								<!--***********END /  ITEM *********-->

								<?php 
									}
								?>

							</tbody>

						</table>
						<!--end /  tabla-detalle -->
	        				</div>
				</div>
				<!--end / body accordeon-->
	    		</div>
			<!--end / ITEM accordeon-->

			
			<?php 
				}
			?>

		</div>
		<!--end / acordeon historial-->
		

	</div>
	<!--end / historial productos-->


<!-- Footer -->
<?php require('inc/footer.php') ?>
