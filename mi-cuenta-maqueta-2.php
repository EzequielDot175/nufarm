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
	<div class="formulario block-a col-xs-12 col-sm-4 col-md-4 ol-lg-4">

		<h3 class="sub-titulo text-uppercase">Nueva Consulta</h3>

		<form role="form " class="form-default">
			<div class="form-group">
				<label for="text" class="text-uppercase">Asunto</label>
				<input type="text" id="email">
			</div>

			<div class="form-group">
				<label for="text" class="text-uppercase">Descripción</label>
				<textarea name=""></textarea>
			</div>

			<!-- botones -->
			<hr class="hr-bottom">
			<div class='block-botones'>
				<button type="submit" class="boton text-uppercase">Guardar Datos</button>
			</div>
			<!--end /  botones -->
		</form>

	</div>
	<!--end / formulario-->

	<!--consultas-->
	<div class="consultas block-b col-xs-12 col-sm-8 col-md-8">

		<h3 class="sub-titulo text-uppercase">Consultas Realizadas</h3>

		
		
		<!--block-items-->
		<div class="block-items col-xs-12 col-sm-12 col-md-12">
		
			<?php
				for ($i=1; $i < 3 ; $i++) { 
			?>
				<!--item-->
				<div class="columna-a col-xs-12 col-sm-6 col-md-6">
					<div class="dialog col-xs-12 col-sm-12 col-md-12 ol-lg-12">
						<div class="block-dialog">
							<p class="text fecha ">2015-07-30 10:35:55</p>
							<p class="text ">En la compra me faltan 10 pesos para cerrar la compra. Agradezco la gestión. </p>
							<p class="text autor ">Gabriel Filippa </p>
						</div>
					</div>
				</div>
				<!--end / item-->
				<!--item-->
				<div class="columna-b col-xs-12 col-sm-6 col-md-6">
					<div class="dialog dialog-verde col-xs-12 col-sm-12 col-md-12 ol-lg-12">
						<div class="block-dialog">
							<p class="text fecha ">2015-07-30 10:35:55</p>
							<p class="text ">En la compra me faltan 10 pesos para cerrar la compra. Agradezco la gestión. En la compra me faltan 10 pesos para ...</p>
							<p class="text autor ">Gabriel Filippa </p>
						</div>
					</div>
				</div>
				<!--end / item-->

				<hr><!-- cada dos consultas va un HR -->

				<!--item-->
				<div class="columna-a col-xs-12 col-sm-6 col-md-6">
					<div class="dialog col-xs-12 col-sm-12 col-md-12 ol-lg-12">
						<div class="block-dialog">
							<p class="text fecha ">2015-07-30 10:35:55</p>
							<p class="text ">En la compra me faltan 10 pesos para cerrar la compra. GRACIAS.</p>
							<p class="text autor ">Gabriel Filippa </p>
						</div>
					</div>
				</div>
				<!--end / item-->
				<!--item-->
				<div class="columna-b col-xs-12 col-sm-6 col-md-6">
					<div class="dialog dialog-verde col-xs-12 col-sm-12 col-md-12 ol-lg-12">
						<div class="block-dialog">
							<p class="text fecha ">2015-07-30 10:35:55</p>
							<p class="text ">En la compra me faltan 10 pesos para cerrar la compra. En la compra me faltan 10 pesos para ...</p>
							<p class="text autor ">Gabriel Filippa </p>
						</div>
					</div>
				</div>
				<!--end / item-->

				<hr><!-- cada dos consultas va un HR -->
			<?php
				}
			?>

		</div>
		<!--end / block-items-->

	</div>
	<!--end / consultas-->

</div>
<!--end / mi cuenta-->


<!-- Footer -->
<?php require('inc/footer.php') ?>