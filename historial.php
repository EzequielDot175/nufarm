<?php 
	require_once('inc/header.php');

	$historial = new Historial();
	$collection = $historial->getById(); 

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
				$i = 0;
				foreach($collection->compras as $keycompras => $valcompras):
			?>

			<!--ITEM accordeon-->
			<div class="item">

				<!--head accordeon-->
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $keycompras;?>" class="<?php if($i != 0){echo 'collapsed';}; //accordeon abierto ?> ">
					<div class="panel-heading">
						<h4>
							<?php 
								foreach($valcompras as $key => $val):
									$date = new DateTime($val->fecha);
									echo $date->format('Y/m/d H:i:s');
									break;
								endforeach;
							 ?>
						</h4>
						<div class="flecha"></div>
					</div>
				</a>
				<!--end / head accordeon-->

				<!--body accordeon-->
				<div id="collapse<?php echo $keycompras;?>" class="panel-collapse collapse <?php if($i == 0){echo 'in';$i++;}; //accordeon abierto ?> ">
					<div class="panel-body">
						<!-- tabla-detalle -->
						<table class="tabla-detalle">

							<tbody>

								<?php
									$x = 0;
									foreach($valcompras as $keydetalles => $valdetalles):
									
								 ?>
								 

								<!--*********** ITEM *********-->
								<tr>	
									<!--total puntos (columna no se repite ->rowspan = cantidad de items) -->
									<?php   if($x == 0){   ?>
									<td class=" vertical-align-top" rowspan="<?php echo count($valcompras) ?>">
										<div class="puntos">
											<p class="num"><?php echo($collection->totales[$keycompras]) ?></p>
											<span class="text-uppercase">puntos</span>
										</div>
									</td>

									<?php $x++;} ?>
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
											<p class="text text-uppercase"><?php echo($valdetalles->nombre) ?></p>
										</div>
									</td>
									<!--end /  nombre -->
									
									<!-- talle -->
									<td class="col-B">
										<div class="background-2">
											<!-- SI NO HAY TALLE-->
											<?php if(is_null($valdetalles->talle) || empty($valdetalles->talle) ): ?>
											 	<p class="text-uppercase inactivo medium-text">n/a</p>
											<?php else: ?>
											<p class="text-uppercase big-text"><?php echo($valdetalles->talle) ?></p>
											<?php endif; ?>
										</div>
									</td>
									<!--end /  talle -->

									<!--color -->
									<td class="col-C">
										<div class="background-2">
											<!-- SI NO HAY COLORs-->
											<?php if(is_null($valdetalles->color) || empty($valdetalles->talle)): ?>
											 	<p class="text-uppercase inactivo medium-text">n/a</p>
											<?php else: ?>
												<div class="color">
													<span class="icon-color  color-verde " <?php echo Color::get($valdetalles->color) ?> ></span>
													<p class=" text-uppercase"><?php echo($valdetalles->color) ?> </p>
												</div>
											<?php endif; ?>
										</div>
									</td>
									<!--end /  color -->

									<!--unidades -->
									<td class="col-B">
										<div class="background-2">
											<p class="text-uppercase big-text "><?php echo($valdetalles->cantidad) ?></p>
										</div>
									</td>
									<!--end / unidades -->
									
									<!--puntos -->
									<td class="col-B">
										<div class="background-2">
											<p class="text-uppercase big-text "><?php echo($valdetalles->precio_pagado) ?></p>
										</div>
									</td>
									<!--end / puntos -->
									
									<!--estado -->
									<td class="col-D">
										<div class="background-1 pendiente">
											<?php switch(Estado::get($valdetalles->estado)):
											case 'REALIZADO': ?>
											 <!-- <img src="assets/images/enviado.png" alt=""> -->
											<?php break;
											case 'EN PROCESO': ?>
											  <!-- <img src="assets/images/enviado.png" alt=""> -->
											<?php break;
											case 'ENVIADO': ?>
											 <img src="assets/images/enviado.png" alt="">
											<?php break;
											case 'ENTREGADO': ?>
											 <img src="assets/images/entregado.png" alt="">
											<?php break; ?>

											<?php endswitch; ?>
											<p class="text text-uppercase"><?php echo Estado::get($valdetalles->estado);?></p>
										</div>
									</td>
									<!--end / estado -->
									
									<!--remito -->
									<td class="col-D">
										<div class="background-1">
											<p class="medium-text text-uppercase">Nº <?php echo($valdetalles->remito) ?></p>
										</div>
									</td>
									<!--end / remito -->
								</tr>
								<!--***********END /  ITEM *********-->

								<?php 
									endforeach;
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
				endforeach;
			?>

		</div>
		<!--end / acordeon historial-->
		

	</div>
	<!--end / historial productos-->


<!-- Footer -->
<?php require('inc/footer.php') ?>
