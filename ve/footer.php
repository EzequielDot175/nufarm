


				</div>
				<!--end / contenido-->

			</div>
			<!--end / base-->

		</div>
		<!-- // CONTENEDOR GENERAL*********************************************-->

		<!-- Librería jS -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="control/ve/assets/bootstrap-3.3.4/js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
		<script src="control/ve/assets/js/eventos.js"></script>
 		<script src="control/js/angular/angular.min.js"></script>
		<script>
			var app = angular.module('nufarmMaxx', []);
		 	app.run(['$rootScope',function(rsp) {
		 		rsp.user = <?php echo Auth::id() ?>;
		 	}]);
		</script>
 		<script src="control/js/angular/services.js"></script>
 		<script src="control/js/angular/controllers/ctrlClientControl.js"></script>
	</body>
</html>