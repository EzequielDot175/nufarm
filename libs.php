<?php 
	define('APP_DIR', dirname(__FILE__));

	require_once(APP_DIR.'/core/interface/DBInterface.php');
	require_once(APP_DIR.'/core/pdo/DB.constant.php');
	require_once(APP_DIR.'/core/traits/facade.php');
	require_once(APP_DIR.'/core/traits/session.php');


	require_once(APP_DIR.'/core/class/class.redirect.php'); 
	require_once(APP_DIR.'/core/class/class.auth.php'); 
	require_once(APP_DIR.'/core/class/class.estados.php');
	require_once(APP_DIR.'/core/class/class.consultas.php');
	require_once(APP_DIR.'/core/class/class.provincias.php'); 
	require_once(APP_DIR.'/core/class/class.utils.php'); 
	require_once(APP_DIR.'/core/class/class.tempstock.php'); 
	require_once(APP_DIR.'/core/class/class.tempmaxcompra.php'); 
	require_once(APP_DIR.'/core/class/class.usuario.php'); 
	require_once(APP_DIR.'/core/class/class.stock.php'); 
	require_once(APP_DIR.'/core/class/class.compras.php'); 
	require_once(APP_DIR.'/core/class/class.producto.php'); 
	require_once(APP_DIR.'/core/class/class.colores.php'); 
	require_once(APP_DIR.'/core/class/class.shoppingcart.php'); 
	require_once(APP_DIR.'/core/class/class.historial.php'); 

 ?>