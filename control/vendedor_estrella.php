<?php
	error_reporting(0);
	require_once('../libs.php');
	require_once('ve/inc/header.php');
	Auth::checkAdmin();

	$vendedor = new VendedorEstrella();

	$vendedor->setInit();
 ?>

	<!--Admin -->
	<div class="admin col-xs-12 col-sm-12 col-md-12 ol-lg-12" ng-controller="CtrlFilter">

		<!-- contenedor A -->
		<div class="contenedor-A col-xs-12 col-sm-12 col-md-12 ol-lg-12" >
			<div class="sub-contenedor">
				<div class="filtros" ng-cloak>   
					<form ng-submit="submitFilter()"> 
						<input type="hidden" name="filter"> 
						<h3> FILTRAR POR:</h3>

						<select name="vendedor"  ng-model="vendedores"  ng-change="setClientes()" ng-show="isAdmin">
					 		<option value="">TODOS LOS VENDEDORES</option>
					 		<option value="{{v.id}}" ng-repeat="(k, v) in selVendedores">{{v.nombre}} {{v.apellido}}</option>
					 	</select>

						<select  name="clientes" ng-model="clientes" id=""> 
							<option class="text-uppercase" value="">TODOS LOS CLIENTES</option>
							<option class="text-uppercase" value="{{v.id}}" ng-repeat="(k, v) in selClientes">{{v.strEmpresa}}</option>   
						</select>
						<select name="date" ng-model="filter_date" id="" >
							<option value="">FACTURACION</option>
							<option value="{{v.inicio}}_{{v.fin}}" ng-repeat="(k, v) in selFilterDate">FACTURACION {{v.inicio|date: 'yyyy'}}/{{v.fin |date: 'yyyy'}}</option>
						</select>
						<button class="button-image" type="submit"><img src="ve/assets/images/ver.png" alt=""> VER RESULTADOS </button>     
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

				<div class="block-resumen" >
					<div class="num" ng-cloak> {{facturacion_total}} </div>
					<hr class="hr-resumen"> 
					 <div class="text">
						Total Clientes<br>
						Facturación total
					</div>
				</div>

				<div class="block-resumen" >
					<div class="num" ng-cloak> {{facturacion_prod_clave}} </div>
					<hr class="hr-resumen"> 
					 <div class="text">
						Total Clientes<br>
						Facturación Productos Clave
					</div>
				</div>

				<div class="block-resumen col-xs-12 col-sm-3 col-md-3 ol-lg-3" ng-show="inEdit" ng-hide="!inEdit">
						<div class="num">{{avance_producto}}%</div>
						<hr class="hr-resumen"> 
						 <div class="text">
							Avance Facturacion Total
						</div>
					</div>

					<div class="block-resumen col-xs-12 col-sm-3 col-md-3 ol-lg-3" ng-show="inEdit" ng-hide="!inEdit">
						<div class="num">{{accede_categoria}}</div>
						<hr class="hr-resumen"> 
						 <div class="text">
							Accede a categoría
						</div>
					</div>



			
				<!-- Inputs -->
				<div class="inputs col-xs-12 col-sm-12 col-md-12 ol-lg-12" ng-show="inEdit" ng-hide="!inEdit">
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
								<th class="text-uppercase col-mes"></th>
							</tr>
						</thead>
						<tbody>
								<!-- item-->
								<tr>
									<td class="sin-borde">
										P.Total
									</td>

									<td class=" background-A text-uppercase col-mes" >
										<input type="text"  value="" ng-model="meses.agosto.total">
									</td>
									<td class=" background-A text-uppercase col-mes" >
										<input type="text"  value="" ng-model="meses.septiembre.total">
									</td>
									<td class=" background-A text-uppercase col-mes" >
										<input type="text"  value="" ng-model="meses.octubre.total">
									</td>
									<td class=" background-A text-uppercase col-mes" >
										<input type="text"  value="" ng-model="meses.noviembre.total">
									</td>
									<td class=" background-A text-uppercase col-mes" >
										<input type="text"  value="" ng-model="meses.diciembre.total">
									</td>
									<td class=" background-A text-uppercase col-mes" >
										<input type="text"  value="" ng-model="meses.enero.total">
									</td>
									<td class=" background-A text-uppercase col-mes" >
										<input type="text"  value="" ng-model="meses.febrero.total">
									</td>
									<td class=" background-A text-uppercase col-mes" >
										<input type="text"  value="" ng-model="meses.marzo.total">
									</td>


									<td class="botones" >
										<button ng-click="updateFacturacion();"><img class="boton" src="ve/assets/images/editar.png" ></button>
									</td>
								</tr>
								<!-- end / item-->
								<!-- item-->
								<tr>
									<td class="sin-borde">
										P.Clave
									</td>
									<td class=" background-A text-uppercase col-mes" >
										<input type="text"  value="" ng-model="meses.agosto.total_prod_clave">
									</td>
									<td class=" background-A text-uppercase col-mes" >
										<input type="text"  value="" ng-model="meses.septiembre.total_prod_clave">
									</td>
									<td class=" background-A text-uppercase col-mes" >
										<input type="text"  value="" ng-model="meses.octubre.total_prod_clave">
									</td>
									<td class=" background-A text-uppercase col-mes" >
										<input type="text"  value="" ng-model="meses.noviembre.total_prod_clave">
									</td>
									<td class=" background-A text-uppercase col-mes" >
										<input type="text"  value="" ng-model="meses.diciembre.total_prod_clave">
									</td>
									<td class=" background-A text-uppercase col-mes" >
										<input type="text"  value="" ng-model="meses.enero.total_prod_clave">
									</td>
									<td class=" background-A text-uppercase col-mes" >
										<input type="text"  value="" ng-model="meses.febrero.total_prod_clave">
									</td>
									<td class=" background-A text-uppercase col-mes" >
										<input type="text"  value="" ng-model="meses.marzo.total_prod_clave">
									</td>
									<td class="botones">
										<!-- <button ng-click="updateFacturacion();"><img class="boton" src="ve/assets/images/editar.png" ></button> -->
									</td>
								</tr>
								<!-- end / item-->

						</tbody>
					</table>
					<!-- end / Tabla -->
				</div>
				<!-- end / Inputs -->



				<div >
					<!-- Gráfico -->
					<div class="grafico col-xs-12 col-sm-12 col-md-12 ol-lg-12" >
						<canvas id="canvas" height="125" width="600"></canvas>
					</div>
					<!-- end / Gráfico -->
				</div>

				<!-- Tabla -->
				<table class="tabla-A format-A" ng-show="start_app" ng-hide="!start_app">
					<thead>
						<tr>
							<th class="col-1">Empresa</th>
							<th class="col-2">Tipo de cliente</th>
							<th class="col-3">Facturación total</th>
							<th class="col-4">Facturación de Productos Clave</th>
							<th class="col-5">Avance de Periodo Anterior</th>
							<th class="col-6">Categorías</th>
							<th class="col-7">Premio</th>
							<th class="botones"></th>
						</tr>
					</thead>
					<tbody ng-cloak>
							<!-- item-->
							<tr ng-repeat="(key, value) in resultados" >
								<td class="background-A text-uppercase col-1">
									{{ value.cliente }}
								</td>
								<td class="background-A text-uppercase col-2 gris">
									{{ value.gold }}
								</td>
								<td class="background-B text-uppercase col-3 center">
									{{ value.total }}
								</td>
								<td class="background-B text-uppercase col-4 center sub-item">
									<div class="item"><p>{{ value.total_prod_clave}}</p></div> 
									<div class="item background-A violeta"><p>{{ prodClave(value.total,value.total_prod_clave) }} %</p></div>
								</td>
								<td class="background-A text-uppercase col-5 center violeta">
									{{value.progreso || avancetotal(value.total,value.ultimo_total) }} %
								</td>
								<td class="background-A text-uppercase col-6 center" >
									{{ categoria(value.total_prod_clave,value.total, value.ultimo_total) }}
								</td>
								<td class="background-A text-uppercase col-7 center">
									TV LED
								</td>

								<td class="botones" ng-show="canEdit" ng-hide="!canEdit">
									<img class="boton" src="ve/assets/images/editar.png" alt="" ng-click="editItem(value);">
								</td>
								
							</tr>
							<!-- end / item-->
					</tbody>
				</table>
				<!-- end / Tabla -->
					
			</div>
		</div>
		<!-- end / contenedor B -->


	</div>
	<!-- end / Admin -->


<?php 
	require_once('ve/inc/footer.php');
 ?>

