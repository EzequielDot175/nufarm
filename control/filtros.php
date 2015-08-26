<?php 
	require('class/class.auth.php');
	Auth::check();
	
 ?>

<!DOCTYPE html>
<html lang="es" ng-app="nufarmMaxx" >
<head>
	<meta charset="UTF-8">
	<title>Nufarm Maxx |  Reportes</title>
	<link rel="stylesheet" href="css/estilos.css">
</head>
<body>
	

	<div class="filtro">
		<div class="menu">
			<ul>
				<li><a href="">MENU</a></li>
				<li><a href="">MENU</a></li>
				<li><a href="">MENU</a></li>
				<li><a href="">MENU</a></li>
				<li><a href="">MENU</a></li>
			</ul>
		</div>

		<div class="panel" ng-controller="FiltroController" >
			<form ng-submit="filter();">
				<fieldset>
					<label for="">Ver filtros en resultados</label>
					<input type="radio" value="1" name="fetchBy">
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
		</div>
	</div>


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