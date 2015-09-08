<?php 
	require_once('../libs.php');
	Auth::checkAdmin();
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
	
<!-- Header -->
<header>
<!--[if lt IE 9]>
<script type="text/javascript">
   document.createElement("nav");
   document.createElement("header");
   document.createElement("footer");
   document.createElement("section");
   document.createElement("article");
   document.createElement("aside");
   document.createElement("hgroup");
</script>
<![endif]-->

<!--[if lt IE 8]>
<script type="text/javascript">
   document.createElement("nav");
   document.createElement("header");
   document.createElement("footer");
   document.createElement("section");
   document.createElement("article");
   document.createElement("aside");
   document.createElement("hgroup");
</script>
<![endif]-->

<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<div id="top"></div>
<div id="logo">
	<a href="../index.php"><img src="../imagenes/logo2-02.png" alt="Nufarm"> </a>
</div>
<div id="header_bg_img"><div class="subheader"><span class="adminwelcome">Administrador Marketingnet </span>
	<!--<div class="prop"></div>-->
</div></div>
<ul><li class="cerrar_sesion"><a href="http://localhost/ftp/nufarmMaxx/control//logout.php">Cerrar sesion X</a></li></ul>		
</header>


<!-- Header -->



	<!-- PAGE -->
	<div class="block">
		
		<div class="prod_container block-filtros ">

			<!--FILTROS-->
			<div class="filtro">
				<div class="panel filtros-Default filtros-Violeta" ng-controller="FiltroController" >

					<!-- form-->
					<form ng-submit="filter();">

						<div class="filtros-w100 filtros-Verde ">			
							<div class="radio">
								<input type="radio" checked value="1" name="fetchBy">
								<label for="" >Ver filtros en resultados</label>
							</div>
							<div class="radio">
								<input type="radio" value="2" name="fetchBy">
								<label for="">Ver filtros en estadisticas</label>
							</div>
						</div>


						<div class="block-50">
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
						</div>


						<div class="filtros-Default filtros-100 filtro-bottom">
			            			<h3> FILTRAR ACTIVIDAD POR:</h3>
							<div class="filtros-w100 filtros-A">
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
							<div class="filtros-w100 filtros-B">
								<label class="fecha" for="">Desde</label>
								<input type="date" ng-model="filtro.desde" class="typeDate"  placeholder="Date">
								<label class="fecha"  for="">Hasta</label>
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
						
						<div class="block-botones">
							<button class="button-image" type="submit" ><img src="layout/ver.png" alt=""> VER LISTADO DE RESULTADOS </button> 
							<button class="button-image"  > <img src="layout/excel.png" alt="">DESCARGAR RESULTADOS EN EXCEL </button>
						</div>
					</form>
					<!-- end / form-->

					

					<!-- resultados-->
					<div class="resultados">
						<!-- head tabla
						<table>
							<tr class="tablacolor3 tablaDefault">
							     	<td  class="colA" align="center">FECHA</td>  
							     	<td  class="colB" align="center">TOTAL PUNTOS</td>
							     	<td  class="colC" align="center">PRODUCTO</td>
							      	<td class="colD" align="center">CANTIDAD</td>
							      	<td class="colE" align="center">COLOR</td>
							      	<td class="colF" align="center">TALLE</td>
							      	<td class="colG" align="center">REMITO</td>
							     	<td  class="colH" align="center">ESTADO</td>
							</tr>
						</table>
						-->
							
						<!-- item -->
						<div class="item" ng-repeat="(key, value) in filtroData">
						 	<table >
								<tr class="tablaDetalle tablaDefault"  ng-repeat="(k, v) in value" ng-if="k != 'total'">
								     	<td  class="colA"  align="center">
									     	{{ value[0].fecha }}
									</td>  
									<td  class="colB" align="center">
									     	{{value.total}}
									</td>
									<td  class="colC tdBackground"class="colA"  align="center">
										<!--<div class="sub"><img class="imagen" src="../../images_productos/'.$imagen_producto.'"  alt="" /></div>-->
										<div class="sub text "><span>{{v.pagado}}</span></div>
										<span class="sub text">{{v.prod_nombre}}</span>
									</td>
									 <td class="colD tdBackground"  align="center">
									      	<span>{{v.cantidad}} </span>
									 </td>
									 <td class="colE tdBackground" align="center">
										<span>{{v.color}}</span>
									 </td>
									 <td class="colF tdBackground"  align="center">
										<span>{{v.talle}}</span>
									 </td>
									 <td  class="colG tdBackground" align="center">
									      	{{v.remito}}
									</td>
									<td  class="colH tdBackground"  align="center">
									     	<select name="estado_compra_prod'.$i.'" id="estado2">
											<option ng-selected="v.estado == 1" value="1">Pedido realizado</option>
											<option ng-selected="v.estado == 2" value="2"> Pedido en Proceso</option>	
											<option ng-selected="v.estado == 3" value="3"> Pedido enviado</option>	
											<option ng-selected="v.estado == 4" value="4">Pedido entregado</option>	
										</select>
									</td>
								</tr>
								
							 </table>
							

							<!--
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
							-->
						</div>
						<!-- end / item -->


					</div>
					<!-- end / resultados-->

				</div>
			</div>
			<!--END / FILTROS-->

		</div>
	</div>
	<!-- END / PAGE -->


	<script src="js/jquery-1.11.3.min.js"></script>
	<script src="js/angular/angular.min.js"></script>
	<script src="js/angular/app_filtro.js"></script>
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