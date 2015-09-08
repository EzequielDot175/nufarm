<?php 
require_once('libs.php');
Auth::check();

?>
<!DOCTYPE html>
<html lang="es" ng-app="ve">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>Nufarm - Vendedor Estrella</title>
	<meta name="auth" content="<?php echo Auth::id() ?>">
	<meta name="auth-role" content="">

	<!-- librerías opcionales que activan el soporte de HTML5 para IE8 -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->

		<!-- CSS de Bootstrap -->
		<link href="control/ve/assets/bootstrap-3.3.4/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="control/ve/assets/bootstrap-3.3.4/css/bootstrap-social.css" rel="stylesheet" media="screen">

		<!-- CSS de font-awesome-4.3.0 para iconos sociales-->
		<link href="control/ve/assets/fonts/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" media="screen">

		<!-- CSS -->
		<link href="control/ve/assets/css/estilos.css?v=01" rel="stylesheet" media="screen">
		
		<!-- GRAFICOS -->
		<script src="control/ve/assets/js/Chart.js"></script>
	</head>


	<body>

		<div class="head">
			<div class="contenedor">
				<img src="control/ve/assets/images/Nufarm-max-logo.png" id="Nufarm" title="Nufarm" alt="Imagen no encontrada">
				<div class="block">
					<img class="icon-select " src="control/ve/assets/images/flecha-select.png" id="Nufarm" title="Nufarm" alt="Imagen no encontrada">
					<select class="form-control">
						<option>MARKETING NET</option>
						<option>PLAN DE NEGOCIOS</option>
						<option>VENDEDOR ESTRELLA</option>
					</select>
					<div class="logout">
						<p class="text-uppercase">salir</p>
						<img src="control/ve/assets/images/cerrar.png" id="Nufarm" title="Nufarm" alt="Imagen no encontrada">
					</div>
				</div>
			</div>
		</div>


		<!-- CONTENEDOR GENERAL***********************************************************-->
		<div class="contenedor " ng-controller="ctrlClient">

			<!--base-->
			<div class="base">

				<!-- head -->
				<div class=" head-cliente col-xs-12 col-sm-12 col-md-12 ol-lg-12">
					<h3 class="titulo-A">FACTURACIÓN</h3>
					<select name="" ng-model="periodo" ng-change="selectPeriodo()">   
						<option value="">FACTURACION</option>
						<option value="{{value.inicio}}_{{value.fin}}" ng-repeat="(key, value) in periodos">{{value.inicio | date:'yyyy'}} / {{value.fin | date:'yyyy'}}</option>  
					</select>  
				</div>
				<!-- end / head -->

				<!--contenido-->
				<div class="contenido col-xs-12 col-sm-12 col-md-12 ol-lg-12">

					

					<!--Cliente -->
					<div class="admin col-xs-12 col-sm-12 col-md-12 ol-lg-12">

						

						<!-- contenedor B -->
						<div class="contenedor-B col-xs-12 col-sm-12 col-md-12 ol-lg-12">
							
							<h3 class="titulo-B">SANCHEZ AGRONEGOCIOS S.A.</h3> 

							<div class="block-resumen-A">
								<div class="block-resumen col-xs-12 col-sm-3 col-md-3 ol-lg-3">
								<div class="num">{{total}}</div>
									<hr class="hr-resumen"> 
									<div class="text">
										Facturación total
									</div>
								</div>

								<div class="block-resumen col-xs-12 col-sm-3 col-md-3 ol-lg-3">
									<div class="num">{{procentaje_prod_clave}}%</div>
									<hr class="hr-resumen"> 
									<div class="text">
										Facturación Productos Clave
									</div>
								</div>

								<div class="block-resumen col-xs-12 col-sm-3 col-md-3 ol-lg-3">
									<div class="num">{{progreso}}%</div>
									<hr class="hr-resumen"> 
									<div class="text">
										Avance Total Productos
									</div>
								</div>

								<div class="block-resumen col-xs-12 col-sm-3 col-md-3 ol-lg-3">
									<div class="num">{{ categoria }}</div>
									<hr class="hr-resumen"> 
									<div class="text">
										Accede a categoría
									</div>
								</div>
							</div>

							<hr class="hr-cliente">

							<!-- categoria -->
							<div class="categorias col-xs-12 col-sm-12 col-md-12 ol-lg-12">
								<div class="item col-xs-3 col-sm-3 col-md-3 ol-lg-3">
									<p class="num">0</p>
								</div>
								<div class="item col-xs-3 col-sm-3 col-md-3 ol-lg-3">
									<img class="imagen" src="control/ve/assets/images/premio.png" alt="">
									<p class="num">1</p>
								</div>
								<div class="item col-xs-3 col-sm-3 col-md-3 ol-lg-3">
									<img class="imagen"  src="control/ve/assets/images/premio.png" alt="">
									<p class="num activo">2</p>
								</div>
								<div class="item col-xs-3 col-sm-3 col-md-3 ol-lg-3">
									<img class="imagen"  src="control/ve/assets/images/premio.png" alt="">
									<p class="num">3</p>
								</div>
							</div>
							<!-- end / categoria -->



							<!-- seleccionar -->
							<div class="datos">

								<div class="progressbar col-xs-12 col-sm-12 col-md-12 ol-lg-12">
									<div class="progress">
										<div class="progress-bar" role="progressbar" aria-valuenow="70"
										aria-valuemin="0" aria-valuemax="100" style="width:70%">
										<span class="sr-only">70% Complete</span>
									</div>
								</div>
							</div>

							<div class="seleccionar col-xs-12 col-sm-12 col-md-12 ol-lg-12">
								<p class="text text-uppercase">SELECCIONAR PREMIO CATEGORÍA 2</p>
								<select name="">   
									<option value="">TABLET</option>   
									<option value="">TV LED</option>   
								</select>  

								<img class="ok-seleccion" src="control/ve/assets/images/ok.png" alt="">
							</div>


						</div>
						<!-- end / seleccionar -->


						<!-- meses -->
						<div class="inputs col-xs-12 col-sm-12 col-md-12 ol-lg-12" ng-show="hasMonths" ng-hide="!hasMonths">

							<div class="titulo-meses col-xs-12 col-sm-12 col-md-12 ol-lg-12">
								<h3 class="item item-a">2014</h3>
								<h3 class="item item-b">2015</h3>
							</div>

							<!-- Tabla -->
							<table class="tabla-A tabla-mes" >
								<thead>
									<tr>
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
										<td class=" background-A text-uppercase center">
											{{ meses.Agosto }}
										</td>
										<td class="background-A text-uppercase  col-mes center ">
											{{ meses.Septiembre }}
										</td>
										<td class="background-A text-uppercase  col-mes center">
											{{ meses.Octubre }}
										</td>
										<td class="background-B text-uppercase  col-mes  center">
											{{ meses.Noviembre }}
										</td>
										<td class="background-B text-uppercase  col-mes  center ">
											{{ meses.Diciembre }}
										</td>
										<td class="background-A text-uppercase  col-mes  center ">
											{{ meses.Enero }}
										</td>
										<td class="background-A text-uppercase  col-mes  center" >
											{{ meses.Febrero }}
										</td>
										<td class="background-A text-uppercase  col-mes  center">
											{{ meses.Marzo }}
										</td>

									</tr>
									<!-- end / item-->

								</tbody>
							</table>
							<!-- end / Tabla -->
						</div>
						<!-- end / meses -->

						<!-- Gráfico -->
						<div class="grafico col-xs-12 col-sm-12 col-md-12 ol-lg-12">
							<canvas id="canvas" height="125" width="600"></canvas>
						</div>
						<!-- end / Gráfico -->



								</div>
								<!-- end / contenedor B -->


							</div>
							<!-- end / Cliente -->

							<!--footer-->
							<div class="sub-footer col-xs-12 col-sm-12 col-md-12 ol-lg-12">

							</div>
							<!--end / footer-->


						</div>
						<!--end / contenido-->

					</div>
					<!--end / base-->

				</div>
				<!-- // CONTENEDOR GENERAL*********************************************-->

				<div class="footer" style="position: relative;">
					<img src="control/ve/assets/images/Nufarm-max-logo-verde.png" id="Nufarm" title="Nufarm" alt="Imagen no encontrada">
				</div>


				<!-- Librería jS -->
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
				<script src="control/ve/assets/bootstrap-3.3.4/js/bootstrap.min.js"></script>
				<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
				<script src="control/ve/assets/js/eventos.js"></script>
				<script src="control/js/angular/angular.min.js"></script>
				<script src="control/js/angular/app.js"></script>
				<script src="control/js/angular/services.js"></script>
				<script src="control/js/angular/controllers/ctrlClient.js"></script>

			</body>
			</html>