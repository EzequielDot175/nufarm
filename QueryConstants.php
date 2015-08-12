			<?php 
			/**
			* @abstract Esta clase supone reemplazar los sql escritos por todo el sitio, definidos como constantes
			*/
			trait Helpers{
			
			public static function session($param){
			return $_SESSION[$param];
			}
			// public static function getPost()
			
			}
			
			
			interface SqlConstant {
			
			
			/**
			* @param carrito
			*/
			const CARRITO_BYID                        = "SELECT * FROM carrito WHERE intContador = :id";
			
			
			/**
			* @param class TempMaxCompra
			*/
			const MAXCOMPRA_ALL                       = "SELECT idProducto as id,intMaxCompra as max FROM productos WHERE intStock > 0";
			const MAXCOMPRA_VERIFY                    = "SELECT COUNT(id) as sum FROM tempmaxcompra WHERE user = ";
			const MAXCOMPRA_INSERT                    = "INSERT INTO tempmaxcompra (user,prod,cant) VALUES ";
			const MAXCOMPRA_INSERTFROMPROD            = "INSERT INTO tempmaxcompra (user,prod,cant) VALUES (:user,:prod,(SELECT intMaxCompra FROM productos WHERE idProducto = :prod  ))";
			const MAXCOMPRA_HAVELIMITCOMPRA           = "SELECT cant FROM tempmaxcompra WHERE user = :user AND prod = :prod";
			const MAXCOMPRA_LIMITBYPROD               = "SELECT intMaxCompra as result FROM productos WHERE idProducto = :prod";
			const MAXCOMPRA_UPDATELIMIT               = "UPDATE tempmaxcompra SET cant = :cant WHERE user = :user AND prod = :prod";
			const MAXCOMPRA_UPDATELIMITFROMPROD       = "UPDATE tempmaxcompra SET cant = (SELECT intMaxCompra FROM productos WHERE idProducto = :prod  ) WHERE user = :user AND prod = :prod";
			const MAXCOMPRA_GETMAXCOMPRA              = "SELECT SUM(IFNULL(cant,0) - used) as max, cant FROM tempmaxcompra WHERE prod = :prod AND user = :user";
			const MAXCOMPRA_UPDATEMAXCOMPRA           = "UPDATE tempmaxcompra  SET cant = cant - :cant  WHERE user = :user AND prod = :prod";
			const MAXCOMPRA_VERIFYCURRENTLIMIT        = "SELECT IF (cant = (SELECT intMaxCompra from productos WHERE idProducto = :prod ), '1', '0') as result FROM tempmaxcompra WHERE user = :user AND prod = :prod";
			const MAXCOMPRA_PRODUCTROWEXIST           = "SELECT COUNT(id) AS result FROM tempmaxcompra WHERE user = :user AND prod = :prod";
			const MAXCOMPRA_STORESUM                  = "UPDATE tempmaxcompra SET used = used + :used WHERE user = :user AND prod = :prod";
			const MAXCOMPRA_STOREMAINS                = "UPDATE tempmaxcompra SET used = used - :used WHERE user = :user AND prod = :prod";
			const MAXCOMPRA_MAXPROD                   = "SELECT intMaxCompra FROM productos WHERE idProducto = :prod";
			
			/**
			* @param class: Compra
			*/
			// const COMPRA_BYID                      = "SELECT "
			const COMPRA_EMPTY = "SELECT IF(COUNT(id_compra) = 0 , '1' , '0' ) as empty FROM detalles_compras WHERE id_compra = :id";
			const COMPRA_DELETE = "DELETE FROM compra WHERE idCompra = :id";
			
			
			/**
			* @param class: DetalleCompra
			*/
			const DTCOMPRA_BYID                       = "SELECT * FROM detalles_compras WHERE id = :id";
			const DTCOMPRA_JOINCOMPRA                 = "SELECT 
			compra.idCompra as compra,
			compra.idUsuario as user,
			compra.dblTotal as total,
			dtcompra.id_producto as producto,
			dtcompra.cantidad as cantidad,
			dtcompra.precio_pagado as pagado,
			talles.id_talle as talle,
			colores.id_color as color
			FROM 
			detalles_compras as dtcompra
			LEFT JOIN compra ON compra.idCompra       = dtcompra.id_compra
			LEFT JOIN talles ON talles.nombre_talle   = dtcompra.talle
			LEFT JOIN colores ON colores.nombre_color = dtcompra.color
			WHERE 
			id                                        = :id";
			const DTCOMPRA_SET_TOTAL                  = "UPDATE compra SET dblTotal  = :num WHERE idUsuario = :user && idCompra = :id ";
			const DTCOMPRA_DELETE                     = "DELETE FROM detalles_compras WHERE id = :id";
			
			
			
			
			
			/**
			* @param class: Usuario
			*/
			
			const USUARIO_SUMCREDITO                 = "UPDATE usuarios SET dblCredito = dblCredito + :num WHERE idUsuario = :user";
			
			
			
			
			/**
			* @internal class: Stock
			*/
			
			const STOCK_SUMSTOCK_TALLE                = "UPDATE talles_productos SET cantidad = cantidad + :num WHERE id_talle = :talle AND id_producto = :prod ";
			const STOCK_SUMSTOCK_COLOR                = "UPDATE colores_productos SET cantidad = cantidad + :num WHERE id_color = :color AND id_producto = :prod";
			const STOCK_SUMSTOCK_TALLECOLOR           = "UPDATE colores_talles SET cantidad = cantidad + :num WHERE id_color = :color AND id_talle = :talle AND id_producto = :prod";
			const STOCK_SUMSTOCK_PROD = "UPDATE productos SET intStock = intStock + :num WHERE idProducto = :prod";
			}
			
			
			
			?>