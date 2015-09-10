<?php 
	interface DBInterface {
		/**
		 * @internal $sql generales
		 */
		const QUERY_ALL_TABLE = "SELECT * FROM :tb ";




		/**
		 *	@internal Class: Personal
		 */
		const PERSONAL_BYROLE = "SELECT * FROM personal WHERE role = :role ";
		const PERSONAL_ALLCOMPRAS = "SELECT 
		per.id,
		usr.idUsuario,
		usr.strNombre,
		usr.strApellido,
		compra.idCompra,
        compra.fthCompra as fecha,
		dt.id as dt_id,
		dt.id_producto as producto_id,
		dt.detalle as producto_detalle,
		dt.cantidad as cantidad,
		dt.precio_pagado as pagado,
		dt.color as color,
		dt.talle as talle,
		dt.remito as remito
		FROM
		personal as per
		LEFT JOIN
		usuarios as usr ON usr.vendedor = per.id
		LEFT JOIN
		compra ON compra.idUsuario = usr.idUsuario
		LEFT JOIN
		detalles_compras as dt ON dt.id_compra = compra.idCompra "; 

		/**
		 * @internal Class: Cliente
		 */
		const CLIENTE_BASICS = "SELECT idUsuario, strNombre, strApellido FROM usuarios ";
		const CLIENTE_BASICSBYVENDEDOR = "SELECT idUsuario, strNombre, strApellido FROM usuarios WHERE vendedor = :id";
		const CLIENTE_ALLCOMPRAS = "SELECT
		compra.idCompra,
		compra.fthCompra as fecha,
		usr.idusuario,
		usr.strNombre,
		usr.strApellido,
		usr.strEmpresa,
		per.nombre as v_nombre,
		per.apellido as v_apellido,
		dt.id as dt_id,
		dt.id_producto as producto_id,
		dt.nombre as prod_nombre,
		dt.cantidad as cantidad,
		dt.estado_producto as estado,
		dt.precio_pagado as pagado,
		dt.color as color,
		dt.talle as talle,
		dt.remito as remito
		FROM
		usuarios as usr
		NATURAL JOIN compra
		LEFT JOIN personal as per ON per.id = usr.vendedor
		LEFT JOIN
		detalles_compras as dt ON dt.id_compra = compra.idCompra ";



		/**
		 * @internal Class: Compras
		 */
		const COMPRAS_SEL_PROD = "SELECT DISTINCT prod.idProducto, prod.strNombre FROM detalles_compras as dt LEFT JOIN productos as prod ON prod.idProducto = dt.id_producto GROUP BY dt.id_compra";



		/**
		 * @
		 */
	}

 ?>