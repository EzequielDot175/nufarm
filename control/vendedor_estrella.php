<?php 
	require_once('../libs.php');
 ?>

 <!DOCTYPE html>
 <html lang="es" ng-app="ve">
 <head>
 	<meta charset="UTF-8">
 	<title>Vendedor Estrella</title>
 </head>
 <body ng-controller="CtrlFilter">
	
	<div class="filtro">
		<form ng-submit="submitFilter()">
		 	<select name="vendedor"  ng-model="vendedores"  ng-change="setClientes()">
		 		<option value="">Vendedor</option>
		 		<option value="{{v.id}}" ng-repeat="(k, v) in selVendedores">{{v.nombre}} {{v.apellido}}</option>
		 	</select>
		 	<select name="clientes" ng-model="clientes" id="">
		 		<option value="">Cliente</option>
		 		<option value="{{v.id}}" ng-repeat="(k, v) in selClientes">{{v.nombre}} {{v.apellido}}</option>
		 	</select>
		 	<select name="date" ng-model="filter_date" id="" >
		 		<option value="{{v.k}}" ng-repeat="(k, v) in selFilterDate">{{v.val}}</option>
		 	</select>
		 	<input type="submit">
		</form>
	</div>


	<div class="resultados">
		
	</div>
 	
 	<script src="js/jquery-1.11.3.min.js"></script>
 	<script src="js/angular/angular.min.js"></script>
 	<script src="js/angular/ve.js"></script>
 	<script src="js/angular/services.js"></script>
 	<script src="js/angular/controllers/ctrlFilter.js"></script>
 </body>
 </html>
