<?php 
	if(!isset($_SESSION)):
		session_start();
		if(empty($_SESSION["MM_Username"])):
			header('location: login.php');
			exit();
		endif;
	endif;
	require('libs.php');
	$TempMaxCompra = new TempMaxCompra();
	$TempMaxCompra->init();
?>

<!DOCTYPE html>
<html lang="es">
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

		<!-- CSS de Bootstrap -->
		<link href="assets/bootstrap-3.3.4/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="assets/bootstrap-3.3.4/css/bootstrap-social.css" rel="stylesheet" media="screen">

		<!-- CSS de font-awesome-4.3.0 para iconos sociales-->
		<link href="assets/fonts/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" media="screen">

		<!-- CSS -->
		<link href="assets/css/estilos.css?v=05" rel="stylesheet" media="screen">
	</head>


	<body>

		<div class="head">
			<div class="contenedor">
				<img src="assets/images/Nufarm-max-logo.png" id="Nufarm" title="Nufarm" alt="Imagen no encontrada">
				<div class="block">
					<select class="form-control">
						<option class="text-uppercase">MARKETING NET</option>
						<option class="text-uppercase">PLAN DE NEGOCIOS</option>
						<option class="text-uppercase">VENDEDOR ESTRELLA</option>
					</select>
					<div class="logout">
						<a href="salir.php"><p class="text-uppercase">salir</p></a>
						<img src="assets/images/cerrar.png" id="Nufarm" title="Nufarm" alt="Imagen no encontrada">
					</div>
				</div>
			</div>
		</div>

		<!-- MENU************************************************************************-->
		<nav class="menu navbar col-xs-12 col-sm-12 col-md-12 ol-lg-12">
			<div class="contenedor">

				<!-- boton menu mobile -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-menu">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<!--// boton menu mobile -->

				<!-- Contenido menu-->
				<div class="collapse navbar-collapse background-menu" id="navbar-menu">
					<ul class="nav navbar-nav">
						<li class="text-uppercase catalogo">
							<a href="catalogo.php">
								<img src="assets/images/menu-1.png" alt="">
								<span class="text-a">CATÁLOGO</span>
								<span class="text-b">DE PRODUCTOS</span>
							</a>
						</li>
						<li class="text-uppercase">
							<a href="historial.php">
								<img src="assets/images/menu-2.png" alt="">
								<span class="text-a">HISTORIAL</span>
								<span class="text-b">DE CANJES REALIZADOS</span>
							</a>
						</li>
						<li class="text-uppercase dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="assets/images/menu-3.png" alt="">
								<span class="text-a">MI CUENTA</span>
								<span class="text-b">DATOS Y CONSULTAS</span>
							</a>
						</li>
					</ul>
				</div>
				<!-- //Contenido menu-->

				<!-- ver carrito-->
				<div class="ver-carrito">
					<a href="carrito.php" >
						<span class="text text-uppercase">ver carrito</span>
						<img src="assets/images/carrito.png" alt="">
						<div class="num"><?php echo ShoppingCart::sum() ?></div>
					</a>
				</div>
				<!-- end / ver carrito-->

			</div>
		</nav>
		<!-- //MENU************************************************************************-->


		<!-- CONTENEDOR GENERAL***********************************************************-->
		<div class="contenedor contenedor-body ">

			<!--base-->
			<div class="base">

				<!--titulo-->
				<div class="titulo col-xs-12 col-sm-12 col-md-12 ol-lg-12">
					<img src="assets/images/menu-1-verde.png" alt="">
					<div class="texto">
						<h3 class="text-a">CATÁLOGO</h3>
						<h3 class="text-b">DE PRODUCTOS</h3>
					</div>
					<div class="block-right">
						<p class="text-a text-uppercase">nombre usuario</p>
						<p class="num"><?php echo Auth::User()->dblCredito; ?></p>
						<p class="text-b text-uppercase">PUNTOS DISPONIBLES 
							<br>HASTA 31/07/2016
						</p>
						<span class="sombra"></span>
					</div>
				</div>
				<!--end / titulo-->

				<!--contenido-->
				<div class="contenido col-xs-12 col-sm-12 col-md-12 ol-lg-12">

					