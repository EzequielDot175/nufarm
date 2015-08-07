<?php 
	require('class/autoloader.php');
	Auth::check();


	$cliente = new Cliente();
	$cliente->objs = "asda";
	echo "<pre>";
	print_r($cliente->objs);
	echo "</pre>";
	die();
 ?>

<!DOCTYPE html>
<html lang="en" ng-app="nufarmMaxx">
<head>
	<meta charset="UTF-8">
	<title>Nufarm Maxx |  Reportes</title>
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

		<div class="panel">
			<form action="">
				<fieldset>
					<label for="">Ver filtros en resultados</label>
					<input type="radio" value="1" name="fetchBy">
					<label for="">Ver filtros en estadisticas</label>
					<input type="radio" value="2" name="fetchBy">
				</fieldset>
				<fieldset>
					<select name="" id="">
						<option value="" selected>VENDEDOR</option>
						<option value="">opcion</option>
						<option value="">opcion</option>
						<option value="">opcion</option>
						<option value="">opcion</option>
					</select>
					<select name="" id="">
						<option value="" selected>CLIENTE</option>
						<option value="">opcion</option>
						<option value="">opcion</option>
						<option value="">opcion</option>
						<option value="">opcion</option>
					</select>
				</fieldset>
				<fieldset>
					<select name="" id="">
						<option value="" selected>Cantidad de canjes</option>
						<option value="">opcion</option>
						<option value="">opcion</option>
						<option value="">opcion</option>
						<option value="">opcion</option>
					</select>
					<select name="" id="">
						<option value="" selected>Puntos disponibles</option>
						<option value="">opcion</option>
						<option value="">opcion</option>
						<option value="">opcion</option>
						<option value="">opcion</option>
					</select>
				</fieldset>
				<div>
					<fieldset>
						<select name="" id="">
							<option value="">Producto canjeado</option>
						</select>
						<select name="" id="">
							<option value="" selected>Desde</option>
						</select>
					</fieldset>
					<fieldset>
						<select name="" id="">
							<option value="">Estado de entrega</option>
						</select>
						<select name="" id="">
							<option value="" selected>Hasta</option>
						</select>
					</fieldset>
				</div>
				<fieldset>
					<label for="">Ultimo semana</label>
					<input type="radio" name="byDate" value="month">
					<label for="">Ultimo mes</label>
					<input type="radio" name="byDate" value="week">
				</fieldset>
			</form>
		</div>
	</div>



	<script src="js/angular/angular.min.js"></script>
	<script src="js/angular/app.js"></script>
	<script src="js/angular/controller.js"></script>
	<script src="js/angular/directives.js"></script>
</body>
</html>