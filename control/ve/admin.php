<?php include 'inc/header.php' ?>


	<!--Admin -->
	<div class="admin col-xs-12 col-sm-12 col-md-12 ol-lg-12">

		<!-- contenedor A -->
		<div class="contenedor-A col-xs-12 col-sm-12 col-md-12 ol-lg-12">
			<div class="sub-contenedor">
				<div class="filtros">   
				            <form action="" method="POST"> 
				            <input type="hidden" name="filter"> 
				                  	<h3> FILTRAR POR:</h3>   
				                 	<select name="">                     
				                  		<option value="">TODOS LOS CLIENTES</option>   
				                 	</select>    
				                  	<select name="">   
				                    		<option value="">FACTURACION 2014/ 2015</option>   
				                    	</select>    
				                  	<button class="button-image" type="submit"><img src="assets/images/ver.png" alt=""> VER RESULTADOS </button>     
				            </form>    
			      	</div>
			</div>
		</div>
		<!-- end / contenedor A -->

		<!-- contenedor B -->
		<div class="contenedor-B col-xs-12 col-sm-12 col-md-12 ol-lg-12">
			<div class="sub-contenedor">

				<h3 class="titulo-A">FACTURACIÓN 2014/2015</h3>
				<hr class="hr-A">  

				<div class="block-resumen">
					<div class="num"> 212.769 </div>
					<hr class="hr-resumen"> 
					 <div class="text">
						Subtotal Clientes<br>
						Facturación total
					</div>
				</div>

				<div class="block-resumen">
					<div class="num">50%</div>
					<hr class="hr-resumen"> 
					 <div class="text">
						Subtotal Clientes<br>
						Facturación Productos Clave
					</div>
				</div>

				<!-- Tabla -->
				<table class="tabla-A format-A">
					<thead>
						<tr>
							<th class="col-1">Empresa</th>
							<th class="col-2">Tipo de cliente</th>
							<th class="col-3">Facturación total</th>
							<th class="col-4">Facturación de Productos Clave</th>
							<th class="col-5">Avance de Productos Clave</th>
							<th class="col-6">Categorías</th>
							<th class="col-7">Premio</th>
							<th class="botones"></th>
						</tr>
					</thead>
					<tbody>
						<?php for ($i=0; $i < 10; $i++) { ?>
							<!-- item-->
							<tr>
								<td class="background-A text-uppercase col-1">
									SANCHEZ AGRONEGOCIOS S.A.
								</td>
								<td class="background-A text-uppercase col-2 gris">
									NUFARM MAXX GOLD
								</td>
								<td class="background-B text-uppercase col-3 center">
									212.789
								</td>
								<td class="background-B text-uppercase col-4 center sub-item">
									<div class="item"><p>212.789</p></div> 
									<div class="item background-A violeta"><p>50%</p></div>
								</td>
								<td class="background-A text-uppercase col-5 center violeta">
									120%
								</td>
								<td class="background-A text-uppercase col-6 center" >
									3
								</td>
								<td class="background-A text-uppercase col-7 center">
									TV LED
								</td>

								<td class="botones">
									<img class="boton" src="assets/images/editar.png" alt="">
								</td>
								
							</tr>
							<!-- end / item-->
						<?php	}?>
					</tbody>
				</table>
				<!-- end / Tabla -->
					
			</div>
		</div>
		<!-- end / contenedor B -->


	</div>
	<!-- end / Admin -->


<?php include 'inc/footer.php' ?>