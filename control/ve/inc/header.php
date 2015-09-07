
<!DOCTYPE html>
<html lang="es" ng-app="ve">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="auth" content="<?php echo Auth::idAdmin(); ?>">
		<meta name="auth-role" content="<?php echo Auth::userAdmin()->role; ?>">
		<title>Nufarm - Vendedor Estrella</title>

		<!-- librerías opcionales que activan el soporte de HTML5 para IE8 -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->

		<!-- CSS de Bootstrap -->
		<link href="ve/assets/bootstrap-3.3.4/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="ve/assets/bootstrap-3.3.4/css/bootstrap-social.css" rel="stylesheet" media="screen">

		<!-- CSS de font-awesome-4.3.0 para iconos sociales-->
		<link href="ve/assets/fonts/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" media="screen">

		<!-- CSS -->
		<link href="ve/assets/css/estilos.css?v=01" rel="stylesheet" media="screen">
		
		<!-- GRAFICOS -->
		<script src="ve/assets/js/Chart.js"></script>

	</head>
 

	<body>

		<div class="head">
			<div class="contenedor">
                                 	<img src="ve/assets/images/Nufarm-max-logo.png" id="Nufarm" title="Nufarm" alt="Imagen no encontrada">
                     			<div class="block">
                     				<select class="form-control">
				  		<option>MARKETING NET</option>
				  		<option>PLAN DE NEGOCIOS</option>
				  		<option>VENDEDOR ESTRELLA</option>
					</select>
					<div class="logout">
						<a href="logout.php"><p class="text-uppercase">salir</p></a>
						<img src="ve/assets/images/cerrar.png" id="Nufarm" title="Nufarm" alt="Imagen no encontrada">
					</div>
                     			</div>
                         	</div>
                      </div>


		<!-- CONTENEDOR GENERAL***********************************************************-->
		<div class="contenedor">

			<!--base-->
			<div class="base">

				<div class="menu">
				        	<a href="#">
				            	<li class="seleccionado">FACTURACION</li>
				        	</a>
				        	<a href="#">
				        		<li class=" ">PREMIOS</li>
				        	</a>
				</div>

				<!--contenido-->
				<div class="contenido col-xs-12 col-sm-12 col-md-12 ol-lg-12" ng-view>

					
