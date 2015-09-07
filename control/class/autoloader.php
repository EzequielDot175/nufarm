<?php
	
	// define('APP_DIR', dirname(__FILE__));
	/**
	 * @internal Inclusion de interfaces
	 */
	require_once('interface/db.interface.php');


	/**
	* @internal clases
	*/ 
	require_once('DB.constant.php');
	require_once('class.template.php');
	require_once('class.auth.php');
	require_once('class.personal.php');
	require_once('class.cliente.php');
	require_once('class.vendedor.php');
	require_once('class.compra.php');
	require_once('class.filtro.php');



	/**
	 * @internal AJAX - Controller
	 */

	require_once('class.ajax.php');

 ?>