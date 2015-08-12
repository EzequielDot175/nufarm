<?php 
	require_once('class/autoloader.php');
	Ajax::Angular();
	// Auth::check();

	/**
	 * @internal
	 * @param : Nombre del metodo a llamar dentro de la clase Ajax
	 */
	$ajax = new Ajax($_POST['get']);
	$ajax->init();

 ?>