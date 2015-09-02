<?php
	require_once('../libs.php');
	require_once('ve/inc/header.php');
	Auth::checkAdmin();

	$vendedor = new VendedorEstrella();

	$vendedor->setInit();
 ?>

	<!--Admin -->
	<div class="admin col-xs-12 col-sm-12 col-md-12 ol-lg-12" ng-controller="CtrlFilter">

		<!-- contenedor A -->
		<div class="contenedor-A col-xs-12 col-sm-12 col-md-12 ol-lg-12">
			<div class="sub-contenedor">
				<div class="filtros">   
					<form ng-submit="submitFilter()"> 
						<input type="hidden" name="filter"> 
						<h3> FILTRAR POR:</h3>
						<?php if($vendedor->isAdmin()): ?>
						<select name="vendedor"  ng-model="vendedores"  ng-change="setClientes()">
					 		<option value="">TODOS LOS VENDEDORES</option>
					 		<option value="{{v.id}}" ng-repeat="(k, v) in selVendedores">{{v.nombre}} {{v.apellido}}</option>
					 	</select>
					 	<?php endif; ?>
						<select  name="clientes" ng-model="clientes" id=""> 
							<option class="text-uppercase" value="">TODOS LOS CLIENTES</option>
							<option class="text-uppercase" value="{{v.id}}" ng-repeat="(k, v) in selClientes">{{v.nombre}} {{v.apellido}}</option>   
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

				<div class="block-resumen">
					<div class="num" > {{facturacion_total}} </div>
					<hr class="hr-resumen"> 
					 <div class="text">
						Subtotal Clientes<br>
						Facturación total
					</div>
				</div>

				<div class="block-resumen">
					<div class="num"> {{facturacion_prod_clave}} % </div>
					<hr class="hr-resumen"> 
					 <div class="text">
						Subtotal Clientes<br>
						Facturación Productos Clave
					</div>
				</div>

				<!-- Tabla -->
				<table class="tabla-A format-A">
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
									<div class="item background-A violeta"><p>{{ percentage(value.total,value.total_prod_clave) }} %</p></div>
								</td>
								<td class="background-A text-uppercase col-5 center violeta">
									{{value.progreso}} %
								</td>
								<td class="background-A text-uppercase col-6 center" >
									{{ categoria(value.total,value.total_prod_clave) }}
								</td>
								<td class="background-A text-uppercase col-7 center">
									TV LED
								</td>

								<td class="botones">
									<img class="boton" src="ve/assets/images/editar.png" alt="">
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

