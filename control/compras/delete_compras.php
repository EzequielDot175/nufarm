<?php 
	ob_start();
	session_start();
	require_once('../../libs.php');
	


	if($_SESSION['logged_role'] != 1):
		header('location: v_compras.php');	
	endif;


	$compra = new DetalleCompra();
	
	$compra->refund((int)$_GET['id']);


	// header('location: v_compras.php?activo=1&sub=c');
	// exit();

 ?>