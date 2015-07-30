<?php session_start();
	require_once('TempStock.php');
	if(isset($_POST['check'])):
		$x = new TempStock();
		$result = $x->fechaVencimiento($_SESSION['MM_IdUsuario']);
		echo ($result ? "true" : "false");

	endif;

 ?>