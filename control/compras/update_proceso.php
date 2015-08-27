<?php session_start();
ob_start();
require_once("../../libs.php");

foreach($_POST['detalles'] as $key => $val):
	/**
	 * @param estado
	 * @param id_detalle_producto
	 */
	DetalleCompra::upd($val,$key);
endforeach;


@header('Location: v_compras.php?activo=1&sub=c');

?>