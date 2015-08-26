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

		<!-- CSS de Bootstrap -->
		<link href="../assets/bootstrap-3.3.4/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="../assets/bootstrap-3.3.4/css/bootstrap-social.css" rel="stylesheet" media="screen">

		<!-- CSS de font-awesome-4.3.0 para iconos sociales-->
		<link href="../assets/fonts/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" media="screen">

		<!-- CSS -->
		<link href="../assets/css/estilos.css?v=05" rel="stylesheet" media="screen">
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

	<div class="filtro">
	

		<div class="panel" ng-controller="FiltroController" >
			<form ng-submit="filter();">
				<fieldset>
					<label for="" >Ver filtros en resultados</label>
					<input type="radio" checked value="1" name="fetchBy">
					<label for="">Ver filtros en estadisticas</label>
					<input type="radio" value="2" name="fetchBy">
				</fieldset>
				<fieldset>
					<label for="">FILTRAR POR :</label>
					<select name="" id="" ng-model="select_vendedores" ng-change="setCliente()" ng-options="v.value as v.text for (k, v) in vendedores" >
						<option value="">Todos los vendedores</option>
					</select> 
					<select name="" id="" ng-model="filtro.clientes"  ng-options="v.value as v.text for (k, v) in clientes">
						<option value="">Todos los clientes</option>
					</select>
				</fieldset>
				<fieldset>
					<label for="">FILTRAR CANJES POR :</label>
					<select name="" id="" ng-model="filtro.cant_canjes">
						<option value="" selected>Cantidad de canjes</option>
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
				</fieldset>
				<label for="">FILTRAR ACTIVIDAD POR:</label>
				<fieldset>
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
				</fieldset>
				<fieldset>
					<label for="">Desde</label>
					<input type="date" ng-model="filtro.desde" class="typeDate" >
					<label for="">Hasta</label>
					<input type="date" ng-model="filtro.hasta" class="typeDate" >
				</fieldset>
				<fieldset>
					<label for="">Ultimo semana</label>
					<input type="radio" name="typeSearch" ng-model="filtro.typeSearch" value="'byWeek'" class="typeSelection">
					<label for="">Ultimo mes</label>
					<input type="radio" name="typeSearch" ng-model="filtro.typeSearch" value="'byMonth'" class="typeSelection">
				</fieldset>
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