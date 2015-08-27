<?php 
	require('class/class.auth.php');
	Auth::check();
	
 ?>

<!DOCTYPE html>
<html lang="es" ng-app="nufarmMaxx">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<title>Marketing Net</title>

		<!-- librerías opcionales que activan el soporte de HTML5 para IE8 -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->

		<!-- CSS de -->
		<link rel="stylesheet" type="text/css" media="all" href="layout/main.css" />

		<style>
			.resultados{
				margin-top: 20px;
			}
			.item{
				width: 100%;
				min-height: 50px;
				background: #F3F3F3;
			}
			.dataCompra{
				width: 15%;
				display: inline-block;

			}
			.dtCompra{
				width: 75%;
				display: inline-block;
			}
			.row{
				display: inline-block;
				width: calc( 100% / 7 ); 
			}
		</style>
	</head>
<body>

	<?php //include_once('inc/header.php') ?>
	<div class="block">
		<div class="prod_container ">

		

			<div class="filtro">
		
				<div class="panel filtros-Default filtros-Violeta" ng-controller="FiltroController" >
					<form ng-submit="filter();">

						<div class="filtros-w100 filtros-Verde">			
							<div class="radio">
								<input type="radio" checked value="1" name="fetchBy">
								<label for="" >Ver filtros en resultados</label>
							</div>
							<div class="radio">
								<input type="radio" value="2" name="fetchBy">
								<label for="">Ver filtros en estadisticas</label>
							</div>
						</div>

						<div class="filtros-Default filtros-50">
			            				<h3> FILTRAR POR:</h3>
							<select name="" id="" ng-model="select_vendedores" ng-change="setCliente()" ng-options="v.value as v.text for (k, v) in vendedores" >
								<option value="">TODOS LOS VENDEDORES</option>
							</select> 
							<select name="" id="" ng-model="filtro.clientes"  ng-options="v.value as v.text for (k, v) in clientes">
								<option value="">TODOS LOS CLIENTES</option>
							</select>
						</div>

						<div class="filtros-Default filtros-50">
			            				<h3> FILTRAR CANJES POR :</h3>
							<select name="" id="" ng-model="filtro.cant_canjes">
								<option value="" selected>CANTIDAD DE CANJES</option>
								<option value="10">Hasta 10 canjes</option>
								<option value="20">Hasta 20 canjes</option>
								<option value="30">Hasta 30 canjes</option>
							</select>
							<select name="" id="" ng-model="filtro.punt_disponibles">
								<option value="" selected>Puntos disponibles</option>
								<option value="0">Entre 0 y 1000</option>
								<option value="1">Entre 1000 y 2000</option>
								<option value="2">Entre 2000 y 3000</option>
								<option value="3">Entre 3000 y 4000</option>
								<option value="4">Entre 4000 y 5000</option>
								<option value="5">Mas de 5000</option>
							</select>
							
						</div>

						<div class="filtros-Default filtros-100">
			            				<h3> FILTRAR ACTIVIDAD POR:</h3>
								<div class="filtros-w100">
									<select name="" id="" ng-model="filtro.prod_canjeado" ng-options="v.value as v.text for (k, v) in select_prod_canjeado">
										<option value="">Producto canjeado</option>
									</select>
									<select name="" id="" ng-model="filtro.estado">
										<option value="">Estado de entrega</option>
										<option value="1">Pendiente</option>
										<option value="2">En Proceso</option>
										<option value="3">Enviado</option>
										<option value="4">Entregado</option>
									</select>
								</div>

								<div class="filtros-w100">
							
									<label for="">Desde</label>
									<input type="date" ng-model="filtro.desde" class="typeDate"  placeholder="Date">
									<label for="">Hasta</label>
									<input type="date" ng-model="filtro.hasta" class="typeDate" >
								
								
									<div class="radio">
										<input type="radio" name="typeSearch" ng-model="filtro.typeSearch" value="'byWeek'" class="typeSelection">
										<label for="">Ultimo semana</label>
									</div>
									<div class="radio">
										<input type="radio" name="typeSearch" ng-model="filtro.typeSearch" value="'byMonth'" class="typeSelection">
										<label for="">Ultimo mes</label>
									</div>	
								</div>	
						</div>
						
						<input type="submit" >
						
					</form>

					<div class="resultados">
						<div class="item" ng-repeat="(key, value) in filtroData">
							<h3 class="nombre">
								{{ value[0].strNombre }} {{ value[0].strApellido }} 
							</h3>
							<div class="dataCompra">
								<span>{{ value[0].fecha }}</span>
								<span>{{value.total}}</span>
							</div>
							<div class="dtCompra">
								<div class="itemdTCompra" ng-repeat="(k, v) in value" ng-if="k != 'total'">
									<div class="row">{{v.pagado}}</div>
									<div class="row">{{v.prod_nombre}}</div>
									<div class="row">{{v.cantidad}}</div>
									<div class="row">{{v.color}}</div>
									<div class="row">{{v.talle}}</div>
									<div class="row">{{v.remito}}</div>
									<div class="row">
										<select name="" id="">
											<option value="">Estado de entrega</option>
											<option ng-selected="v.estado == 1" value="1">Pendiente</option>
											<option ng-selected="v.estado == 2" value="2">En Proceso</option>
											<option ng-selected="v.estado == 3" value="3">Enviado</option>
											<option ng-selected="v.estado == 4" value="4">Entregado</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>

		</div>
	</div>

<?php include_once('inc/footer.php') ?>

	<script src="js/jquery-1.11.3.min.js"></script>
	<script src="js/angular/angular.min.js"></script>
	<script src="js/angular/app.js"></script>
	<script src="js/angular/services.js"></script>
	<script src="js/angular/directives.js"></script>
	<script src="js/angular/controller.js"></script>
	<script>
	jQuery(document).ready(function($) {
		$('.typeDate').on('change', function(event) {
			event.preventDefault();
			$('.typeSelection').prop('checked', false);
		});
		$('.typeSelection').on('change', function(event) {
			event.preventDefault();
			$('.typeDate').val("");
		});
	});
	</script>

</body>
</html>