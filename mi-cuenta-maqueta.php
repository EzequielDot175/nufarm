<?php 
	require('inc/header.php');
	Utils::POST('submit',function(){
		$x = new Usuario();
		$x->edit($_POST);
	});
	$user = Auth::User();
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

		<form role="form" action="" method="post" class="form-default">
			<!--form-a-->
			<div class="form-a col-xs-12 col-sm-6 col-md-6 ol-lg-6">
				<div class="form-group">
					<label for="text" class="text-uppercase">Empresa</label>
					<input type="text" name="strEmpresa" value="<?php echo $user->strEmpresa ?>">
				</div>

				<div class="form-group">
					<label for="text" class="text-uppercase">Nombre</label>
					<input type="text" name="strNombre"  value="<?php echo $user->strNombre ?>">
				</div>

				<div class="form-group">
					<label for="text" class="text-uppercase">Apellido</label>
					<input type="text" name="strApellido"  value="<?php echo $user->strApellido ?>">
				</div>

				<div class="form-group">
					<label for="text" class="text-uppercase">Teléfono</label>
					<input type="text" name="telefono" value="<?php echo $user->telefono ?>">
				</div>

				<div class="form-group">
					<label for="text" class="text-uppercase">Dirección</label>
					<input type="text" name="direccion"  value="<?php echo $user->direccion ?>">
				</div>

				<div class="form-group">
					<label for="text" class="text-uppercase">Ciudad</label>
					<input type="text" name="ciudad"  value="<?php echo $user->ciudad ?>">
				</div>

				<div class="form-group">
					<label for="text" class="text-uppercase">Código Postal</label>
					<input type="text" name="cp"  value="<?php echo $user->cp ?>">
				</div>

				<div class="form-group">
					<label for="text" class="text-uppercase">Provincia</label>
					<select name="provincia">
						<?php Provincia::options($user->provincia); ?>
					</select>
				</div>
			</div>
			<!--end / form-a-->

			<!--form-b-->
			<div class="form-b col-xs-12 col-sm-6 col-md-6 ol-lg-6">
				<div class="form-group">
					<label for="text" class="text-uppercase">E-mail / Usuario</label>
					<input type="text" name="strEmail" value="<?php echo $user->strEmail ?>">
				</div>

				<div class="form-group">
					<label for="text" class="text-uppercase">Contraseña</label>
					<input type="text" name="strPassword">
				</div>

				<div class="form-group">
					<label for="text" class="text-uppercase">Fecha de nac</label>
					<input type="text" name="cumpleanos"  value="<?php echo Auth::BirthDay($user->cumpleanos); ?>" placeholder="dd/mm/yyyy">
				</div>

				<div class="form-group">
					<label for="text" class="text-uppercase">Cargo</label>
					<input type="text" name="strCargo" value="<?php echo $user->strCargo ?>">
				</div>
<!-- 
				<div class="form-group">
					<label for="text" class="text-uppercase">Ciudad</label>
					<input type="text"  id="email" value="<?php echo $user->telefono ?>">
				</div>

				<div class="form-group">
					<label for="text" class="text-uppercase">Código Postal</label>
					<input type="text"  id="email" value="<?php echo $user->telefono ?>">
				</div>

				<div class="form-group">
					<label for="text" class="text-uppercase">Provincia</label>
					<input type="text" id="email" value="<?php echo $user->telefono ?>">
				</div>

				<div class="form-group">
					<label for="text" class="text-uppercase">Código Postal</label>
					<input type="text"  id="email" value="<?php echo $user->telefono ?>">
				</div> -->

			</div>
			<!--end / form-b-->

			
			<!-- botones -->
			<input type="hidden" name="submit">

			<hr class="hr-bottom">
			<div class='block-botones-A'>
				<button type="submit" class="boton-A text-uppercase">Guardar Datos</button>
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
			<?php $asignados = $user->dblCredito +  Auth::consumido() ;?>
			<span class="num" ><?php echo $asignados//$user->puntos_asignados ?></span>
		</div>

		<div class="item col-xs-12 col-sm-12 col-md-12 ol-lg-12">
			<!--<img class="image" src="assets/images/sidebar-icon-2.png" alt="">-->
			<!--grafico-->
			<div id="canvas-holder">
				<canvas class="image" id="item1Data" width="30" height="30"/>
			</div>
			<!--end / grafico-->
			<p class="text text-uppercase"> Puntos <br> consumidos</p>
			<span class="num" ><?php echo Auth::consumido() ?></span>
		</div>

		<div class="item col-xs-12 col-sm-12 col-md-12 ol-lg-12">
			<!--<img class="image" src="assets/images/sidebar-icon-3.png" alt="">-->
			<!--grafico-->
			<div id="canvas-holder">
				<canvas class="image" id="item2Data" width="30" height="30"/>
			</div>
			<!--end / grafico-->
			<p class="text text-uppercase"> Puntos <br> disponibles</p>
			<span class="num" ><?php echo $user->dblCredito; ?></span>
		</div>
		
		<input type="hidden" id="asignado" value="<?php echo $asignados //$user->puntos_asignados ?>">
		<input type="hidden" id="disponible" value="<?php echo $user->dblCredito ?>">
		<input type="hidden" id="consumido" value="<?php echo Auth::consumido() ?>">

		<div id="canvas-holder">
			<canvas id="chart-area" width="30" height="30"/>
		</div>

		<script>
		var item1Data = [
			{
				value: parseInt(document.getElementById('asignado').value),
				color:"#d1d1d1",
			},
			{
				value: parseInt(document.getElementById('consumido').value),
				color: "#fff",
			},

		];

		var item2Data = [
			{
				value: parseInt(document.getElementById('consumido').value),
				color:"#d1d1d1",
			},
			{
				value: parseInt(document.getElementById('asignado').value),
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
				<p class="text "><?php echo Consulta::last()->strCampo ?></p>
				<p class="text autor "><?php echo $user->strNombre ?> </p>
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