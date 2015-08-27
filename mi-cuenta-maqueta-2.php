<?php 
	require('inc/header.php');
	
	Utils::POST('submit',function(){
		Consulta::newConsulta($_POST);
	});
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

		<form role="form " method="post"  class="form-default">
			<div class="form-group">
				<label for="text" class="text-uppercase">Asunto</label>
				<input type="text" name="asunto">
			</div>

			<div class="form-group">
				<label for="text" class="text-uppercase">Descripción</label>
				<textarea name="descripcion"></textarea>
			</div>

			<!-- botones -->
			<hr class="hr-bottom">
			<div class='block-botones'>
				<button type="submit" class="boton text-uppercase">Enviar</button>
			</div>
			<input type="hidden" name="submit">
			<!--end /  botones -->
		</form>

	</div>
	<!--end / formulario-->

	<!--consultas-->
	<div class="consultas block-b col-xs-12 col-sm-8 col-md-8">

		<h3 class="sub-titulo text-uppercase">Consultas Realizadas</h3>

		
		
		<!--block-items-->
		<div class="block-items col-xs-12 col-sm-12 col-md-12">
			
			<?php foreach(Consulta::all() as $key => $val):
				$respuesta = Consulta::respuesta($val->idConsulta);
			 ?>
				<!--item-->
				<div class="columna-a col-xs-12 col-sm-6 col-md-6">
					<div class="dialog col-xs-12 col-sm-12 col-md-12 ol-lg-12">
						<div class="block-dialog">
							<p class="text fecha "><?php echo $val->fecha ?></p>
							<p class="text "><?php echo $val->strCampo ?></p>
							<p class="text autor "><?php echo $val->strNombre ?></p>
						</div>
					</div>
				</div>
				<!--end / item-->
				<?php if($respuesta): ?>
				<!--item-->
				<div class="columna-b col-xs-12 col-sm-6 col-md-6">
					<div class="dialog dialog-verde col-xs-12 col-sm-12 col-md-12 ol-lg-12">
						<div class="block-dialog">
							<p class="text fecha "><?php echo $respuesta->fecha ?></p>
							<p class="text "><?php echo $respuesta->texto ?></p>
							<p class="text autor "><?php echo $respuesta->strNombre ?></p>
						</div>
					</div>
				</div>
				<!--end / item-->
				<?php endif; ?>

				<hr><!-- cada dos consultas va un HR -->
			<?php endforeach; ?>

		</div>
		<!--end / block-items-->

	</div>
	<!--end / consultas-->

</div>
<!--end / mi cuenta-->


<!-- Footer -->
<?php require('inc/footer.php') ?>