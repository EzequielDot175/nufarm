<?php 
	require('inc/header.php');
?>
<!-- Header -->


<!--detalle productos-->
<div class="mi-cuenta col-xs-12 col-sm-12 col-md-12 ol-lg-12">

	<!--head-page-->
	<div class="head-page col-xs-12 col-sm-12 col-md-12 ol-lg-12">
		
	</div>
	<!--end / head-page-->

	<!--formulario-->
	<div class="formulario formularioSidebar block-a col-xs-12 col-sm-7 col-md-7 ol-lg-7">

		<h3 class="sub-titulo text-uppercase">Datos</h3>

		<form role="form " class="form-default">
			<!--form-a-->
			<div class="form-a col-xs-12 col-sm-6 col-md-6 ol-lg-6">
				<div class="form-group">
					<label for="text" class="text-uppercase">Empresa</label>
					<input type="text" id="email">
				</div>

				<div class="form-group">
					<label for="text" class="text-uppercase">Nombre</label>
					<input type="text"  id="email">
				</div>

				<div class="form-group">
					<label for="text" class="text-uppercase">Apellido</label>
					<input type="text"  id="email">
				</div>

				<div class="form-group">
					<label for="text" class="text-uppercase">Teléfono</label>
					<input type="text" id="email">
				</div>

				<div class="form-group">
					<label for="text" class="text-uppercase">Dirección</label>
					<input type="text"  id="email">
				</div>

				<div class="form-group">
					<label for="text" class="text-uppercase">Ciudad</label>
					<input type="text"  id="email">
				</div>

				<div class="form-group">
					<label for="text" class="text-uppercase">Código Postal</label>
					<input type="text"  id="email">
				</div>

				<div class="form-group">
					<label for="text" class="text-uppercase">Provincia</label>
					<select >
						<option class="text-uppercase">Buenos Aires</option>
						<option class="text-uppercase">Formosa</option>
						<option class="text-uppercase">Santiago del Estero</option>
					</select>
				</div>
			</div>
			<!--end / form-a-->

			<!--form-b-->
			<div class="form-b col-xs-12 col-sm-6 col-md-6 ol-lg-6">
				<div class="form-group">
					<label for="text" class="text-uppercase">Dirección</label>
					<input type="text" id="email">
				</div>

				<div class="form-group">
					<label for="text" class="text-uppercase">Ciudad</label>
					<input type="text"  id="email">
				</div>

				<div class="form-group">
					<label for="text" class="text-uppercase">Código Postal</label>
					<input type="text"  id="email">
				</div>

				<div class="form-group">
					<label for="text" class="text-uppercase">Provincia</label>
					<input type="text" id="email">
				</div>

				<div class="form-group">
					<label for="text" class="text-uppercase">Ciudad</label>
					<input type="text"  id="email">
				</div>

				<div class="form-group">
					<label for="text" class="text-uppercase">Código Postal</label>
					<input type="text"  id="email">
				</div>

				<div class="form-group">
					<label for="text" class="text-uppercase">Provincia</label>
					<input type="text" id="email">
				</div>

				<div class="form-group">
					<label for="text" class="text-uppercase">Código Postal</label>
					<input type="text"  id="email">
				</div>

			</div>
			<!--end / form-b-->

			
			<!-- botones -->
			<hr class="hr-bottom">
			<div class='block-botones'>
				<button type="submit" class="boton text-uppercase">Guardar Datos</button>
			</div>
			<!--end /  botones -->
		</form>

	</div>
	<!--end / formulario-->


	<!--sidebar-->
	<div class="sidebar block-b col-xs-12 col-sm-5 col-md-5 ol-lg-5">

		<h3 class="sub-titulo text-uppercase">Puntos</h3>

		<div class="item col-xs-12 col-sm-12 col-md-12 ol-lg-12">
			<img class="image" src="assets/images/sidebar-icon-1.png" alt="">
			<p class="text text-uppercase"> Puntos <br> asignados</p>
			<span class="num" >20.500</span>
		</div>

		<div class="item col-xs-12 col-sm-12 col-md-12 ol-lg-12">
			<!--<img class="image" src="assets/images/sidebar-icon-2.png" alt="">-->
			<!--grafico-->
			<div id="canvas-holder">
				<canvas class="image" id="item1Data" width="30" height="30"/>
			</div>
			<!--end / grafico-->
			<p class="text text-uppercase"> Puntos <br> consumidos</p>
			<span class="num" >3.500</span>
		</div>

		<div class="item col-xs-12 col-sm-12 col-md-12 ol-lg-12">
			<!--<img class="image" src="assets/images/sidebar-icon-3.png" alt="">-->
			<!--grafico-->
			<div id="canvas-holder">
				<canvas class="image" id="item2Data" width="30" height="30"/>
			</div>
			<!--end / grafico-->
			<p class="text text-uppercase"> Puntos <br> disponibles</p>
			<span class="num" >17.000</span>
		</div>

		<div id="canvas-holder">
			<canvas id="chart-area" width="30" height="30"/>
		</div>

		<script>
		var item1Data = [
			{
				value: 1000,
				color:"#d1d1d1",
			},
			{
				value: 300,
				color: "#fff",
			},

		];

		var item2Data = [
			{
				value: 300,
				color:"#d1d1d1",
			},
			{
				value: 1000,
				color: "#fff",
			},

		];

		window.onload = function(){
			var ctx = document.getElementById("item1Data").getContext("2d");
			window.myPie = new Chart(ctx).Pie(item1Data);

			var ctx = document.getElementById("item2Data").getContext("2d");
			window.myPie = new Chart(ctx).Pie(item2Data);
		};

		</script>

		<h3 class="sub-titulo sub-titulo-bottom text-uppercase">Consultas</h3>

		<div class="dialog col-xs-12 col-sm-12 col-md-12 ol-lg-12">
			<div class="block-dialog">
				<p class="text ">En la compra me faltan 10 pesos para cerrar la compra. Agradezco la gestión. </p>
				<p class="text autor ">Gabriel Filippa </p>
			</div>
		</div>
		
		<!-- botones -->
		<hr class="hr-bottom">
		<div class='block-botones'>
			<a href="mi-cuenta-maqueta-2.php">
				<button  class="boton text-uppercase">Ver Consultas</button>
			</a>
		</div>
		<!--end /  botones -->

	</div>
	<!--end / sidebar-->

</div>
<!--end / mi cuenta-->


<!-- Footer -->
<?php require('inc/footer.php') ?>