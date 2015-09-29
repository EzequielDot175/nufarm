<?php 
	@session_start();
	require_once('libs.php');
	Auth::check();
 ?>
<!DOCTYPE html>
<html lang="en" ng-app="Nufarm">
<head>
	<meta charset="UTF-8">
	<title>Formulario - inicio</title>
</head>
<body ng-controller="ctrlAppInicio">
	<section>
		<h1>Domicio Entrega</h1>
		<form ng-submit="basics();">
			<label for="">Empresa</label>
			<input type="text" ng-model="company">
			
			<br>

			<label for="">Direccion</label>
			<input type="text" ng-model="direction">

			<br>

			<label for="">Nombre</label>
			<input type="text" ng-model="name">

			<br>

			<label for="">Ciudad</label>
			<input type="text" ng-model="city">

			<br>

			<label for="">Apellido</label>
			<input type="text" ng-model="lastname">

			<br>

			<label for="">Codigo Postal</label>
			<input type="text" ng-model="cod">

			<br>

			<label for="">Telefono</label>
			<input type="text" ng-model="phone">

			<br>

			<label for="">Provincia</label>
			<input type="text" ng-model="province">

			<br>

			<input type="submit" value="Guardar">
		</form>


		<form action="">
			<h1>Logo de empresa</h1>
			<img src="http://placehold.it/200x100" alt="">
			<h1>Seleccionar archivo jpg, psd, pdf</h1>
			<input type="text" value="nombre de imagen">
			<input type="submit">
		</form>

		<button>Confirmar</button>
	</section>

	<script src="control/js/jquery-1.4.2.min.js"></script>
	<script src="control/js/angular/angular.min.js"></script>
	<script src="control/js/angular/app_init.js"></script>
	<script src="control/js/angular/services.js"></script>
	<script src="control/js/angular/controllers/ctrlAppInicio.js"></script>
</body>
</html>