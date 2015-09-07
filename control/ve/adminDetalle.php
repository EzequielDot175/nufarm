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
				                  		<option value="">CRISTIAN CARDETTI</option>   
				                 	</select>    
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
				<h3 class="titulo-B">SANCHEZ AGRONEGOCIOS S.A.</h3> 

				<div class="block-resumen-A">
					<div class="block-resumen col-xs-12 col-sm-3 col-md-3 ol-lg-3">
						<div class="num">212.769</div>
						<hr class="hr-resumen"> 
						 <div class="text">
							Facturación total
						</div>
					</div>

					<div class="block-resumen col-xs-12 col-sm-3 col-md-3 ol-lg-3">
						<div class="num">50%</div>
						<hr class="hr-resumen"> 
						 <div class="text">
							Facturación Productos Clave
						</div>
					</div>

					<div class="block-resumen col-xs-12 col-sm-3 col-md-3 ol-lg-3">
						<div class="num">129%</div>
						<hr class="hr-resumen"> 
						 <div class="text">
							Avance Productos Clave
						</div>
					</div>

					<div class="block-resumen col-xs-12 col-sm-3 col-md-3 ol-lg-3">
						<div class="num">2</div>
						<hr class="hr-resumen"> 
						 <div class="text">
							Accede a categoría
						</div>
					</div>
				</div>


				<!-- Inputs -->
				<div class="inputs col-xs-12 col-sm-12 col-md-12 ol-lg-12">
    					<!-- Tabla -->
					<table class="tabla-A tabla-mes" >
						<thead>
							<tr>
								<th class="text-uppercase col-mes"></th>
								<th class="text-uppercase col-mes">Agosto</th>
								<th class="text-uppercase col-mes">Septiembre</th>
								<th class="text-uppercase col-mes">Octubre</th>
								<th class="text-uppercase col-mes">Noviembre</th>
								<th class="text-uppercase col-mes">Diciembre</th>
								<th class="text-uppercase col-mes">Enero</th>
								<th class="text-uppercase col-mes">Febrero</th>
								<th class="text-uppercase col-mes">Marzo</th>
							</tr>
						</thead>
						<tbody>
							<!-- item-->
							<tr>
								<td class="sin-borde">
									P.Total
								</td>
								<td class=" background-A text-uppercase   col-mes">
									<input type="text" name="" value="10.789">
								</td>
								<td class="background-A text-uppercase   col-mes">
									<input type="text" name="" value="30.100">
								</td>
								<td class="background-A text-uppercase ">
									<input type="text" name="" value="50.789">
								</td>
								<td class="background-B text-uppercase  col-mes">
									<input type="text" name="" value="20.889">
								</td>
								<td class="background-B text-uppercase  col-mes ">
									<input type="text" name="" value="10.000">
								</td>
								<td class="background-A text-uppercase  col-mes ">
									<input type="text" name="" value="51.000">
								</td>
								<td class="background-A text-uppercase  col-mes" >
									<input type="text" name="" value="40.020">
								</td>
								<td class="background-A text-uppercase  col-mes">
									<input type="text" name="" value="100.789">
								</td>
								
							</tr>
							<!-- end / item-->
							<!-- item-->
							<tr>
								<td class="sin-borde">
									P.Clave
								</td>
								<td class=" background-A text-uppercase ">
									<input type="text" name="" value="10.789">
								</td>
								<td class="background-A text-uppercase  col-mes ">
									<input type="text" name="" value="30.100">
								</td>
								<td class="background-A text-uppercase  col-mes ">
									<input type="text" name="" value="50.789">
								</td>
								<td class="background-B text-uppercase  col-mes ">
									<input type="text" name="" value="20.889">
								</td>
								<td class="background-B text-uppercase  col-mes  ">
									<input type="text" name="" value="10.000">
								</td>
								<td class="background-A text-uppercase  col-mes  ">
									<input type="text" name="" value="51.000">
								</td>
								<td class="background-A text-uppercase  col-mes " >
									<input type="text" name="" value="40.020">
								</td>
								<td class="background-A text-uppercase  col-mes ">
									<input type="text" name="" value="100.789">
								</td>
								
							</tr>
							<!-- end / item-->

						</tbody>
					</table>
					<!-- end / Tabla -->
				</div>
				<!-- end / Inputs -->

				<!-- Gráfico -->
				<div class="grafico col-xs-12 col-sm-12 col-md-12 ol-lg-12">
					<canvas id="canvas" height="125" width="600"></canvas>
				</div>
				<!-- end / Gráfico -->


				<!-- ScriptGráfico -->
				<script>
					var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
					var lineChartData = {
						//labels : ["Agosto","Septiembre","Octubre","Noviembre","Diciembre","Enero","Febrero","Marzo"], con labels
						labels : ["","","","","","","",""], // sin labels
						datasets : [
							{
								fillColor : "rgba(0,0,0,0.1)",
								strokeColor : "rgba(220,220,220,1)",
								pointColor : "#666666",
								pointStrokeColor : "#666666",
								pointHighlightFill : "#666666",
								pointHighlightStroke : "rgba(220,220,220,1)",
								data : ['0.5','0.8','0.5','1','1.5','1.8','2','2.5'] //valor correspondiente a la categoria de 0 a 3 por mes
							},
						]

					}

					window.onload = function(){
						var ctx = document.getElementById("canvas").getContext("2d");
						window.myLine = new Chart(ctx).Line(lineChartData, {
							responsive: true
						});
					}
				</script>
				<!-- end / SciptGráfico -->



				<!-- Tabla -->
				<table class="tabla-A format-B">
					<thead>
						<tr>
							<th class="col-1">RTC Nufarm</th>
							<th class="col-2">Empresa</th>
							<th class="col-3">Tipo de cliente</th>
							<th class="col-4">Facturación total</th>
							<th class="col-5">Facturación de Productos Clave</th>
							<th class="col-6">Avance de Productos Clave</th>
							<th class="col-7">Categorías</th>
							<th class="col-8">Premio</th>
							<th class="botones"></th>
						</tr>
					</thead>
					<tbody>
						<?php for ($i=0; $i < 10; $i++) { ?>
							<!-- item-->
							<tr>
								<td class="background-A text-uppercase col-1">
									CRISTIAN CARDETTI
								</td>
								<td class="background-A text-uppercase col-2">
									SANCHEZ AGRONEGOCIOS S.A.
								</td>
								<td class="background-A text-uppercase col-3 gris">
									NUFARM MAXX GOLD
								</td>
								<td class="background-B text-uppercase col-4 center">
									212.789
								</td>
								<td class="background-B text-uppercase col-5 center sub-item">
									<div class="item"><p>212.789</p></div> 
									<div class="item background-A violeta"><p>50%</p></div>
								</td>
								<td class="background-A text-uppercase col-6 center violeta">
									120%
								</td>
								<td class="background-A text-uppercase col-7 center" >
									3
								</td>
								<td class="background-A text-uppercase col-8 center">
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