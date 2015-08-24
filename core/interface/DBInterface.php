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
			
			
			interface DBInterface {

			/**
			 *
			 *	INTEFACE: DBInterface 
			 * 	
			 * 	
			 * 	
			 * 	
			 * 	
			 * 	
			 * 	FUNCTION: La funcion de esta interfaz es tener un store de los sql utilizados por todas las clases a modo organizativo.
			 *
			 *
			 *
			 *
			 * 	VENTAJAS: Llamada de una sql completa mediante self::[QUERY CONSTANT].
			 * 	Reemplazando las variables necesarias mediante PDO::BINDPARAM -> VER PHP.NET
			 *
			 *
			 *
			 *
			 *
			 *
			 * 
			 */


			/**
			 * @internal $sql generales
			 */
			const QUERY_ALL_TABLE = "SELECT * FROM :tb ";

			/**
			 * @internal Class: Producto
			 */
			const PRODUCTO_ALL                  = "SELECT * FROM productos";
			const PRODUCTO_ALLBYID 				= "SELECT * FROM productos WHERE idProducto = :id";
			const PRODUCTO_BYTYPE 				= "SELECT
			ct.idCategorias as id_cat,
			ct.strDescripcion as description,
			ct.talles as type
			FROM
			productos as prd
			LEFT JOIN
			categorias as ct ON ct.idCategorias = prd.intCategoria
			WHERE
			prd.idProducto = :id ";
			const PRODUCTO_TALLESBYPROD 		= "SELECT tp.cantidad, talles.nombre_talle as talle , tp.id_talle as id FROM talles_productos as tp NATURAL JOIN talles WHERE tp.id_producto = :id ";
			const PRODUCTO_COLORESBYPROD 		= "SELECT cp.cantidad, colores.nombre_color as color , cp.id_color as id FROM colores_productos as cp NATURAL JOIN colores WHERE cp.id_producto = :id ";
			const PRODUCTO_TALLES_COLORESBYPROD = "SELECT * FROM colores_talles as ct NATURAL JOIN colores NATURAL JOIN talles WHERE ct.id_producto = :id"; 
			const PRODUCTO_CATEGORIAS 			= "SELECT * FROM categorias ";
			const PRODUCTO_ALLCOLORES 			= "SELECT * FROM colores ";
			const PRODUCTO_ALLTALLES  			= "SELECT * FROM talles ";
			/**
			* @param carrito
			*/
			const CARRITO_BYID                  = "SELECT * FROM carrito WHERE intContador = :id";
			

			/**
			 * @param CLASS: Auth
			 */
			const AUTH_USER 					= "SELECT * FROM usuarios WHERE idUsuario = :id"; 

			
			/**
			* @param class TempMaxCompra
			*/
			const MAXCOMPRA_ALL                 = "SELECT idProducto as id,intMaxCompra as max FROM productos WHERE intStock > 0";
			const MAXCOMPRA_VERIFY              = "SELECT COUNT(id) as sum FROM tempmaxcompra WHERE user = ";
			const MAXCOMPRA_INSERT              = "INSERT INTO tempmaxcompra (user,prod,cant) VALUES ";
			const MAXCOMPRA_INSERTFROMPROD      = "INSERT INTO tempmaxcompra (user,prod,cant) VALUES (:user,:prod,(SELECT intMaxCompra FROM productos WHERE idProducto = :prod  ))";
			const MAXCOMPRA_HAVELIMITCOMPRA     = "SELECT cant FROM tempmaxcompra WHERE user = :user AND prod = :prod";
			const MAXCOMPRA_LIMITBYPROD         = "SELECT intMaxCompra as result FROM productos WHERE idProducto = :prod";
			const MAXCOMPRA_UPDATELIMIT         = "UPDATE tempmaxcompra SET cant = :cant WHERE user = :user AND prod = :prod";
			const MAXCOMPRA_UPDATELIMITFROMPROD = "UPDATE tempmaxcompra SET cant = (SELECT intMaxCompra FROM productos WHERE idProducto = :prod  ) WHERE user = :user AND prod = :prod";
			const MAXCOMPRA_GETMAXCOMPRA        = "SELECT SUM(IFNULL(cant,0) - used) as max, cant FROM tempmaxcompra WHERE prod = :prod AND user = :user";
			const MAXCOMPRA_UPDATEMAXCOMPRA     = "UPDATE tempmaxcompra  SET cant = cant - :cant  WHERE user = :user AND prod = :prod";
			const MAXCOMPRA_VERIFYCURRENTLIMIT  = "SELECT IF (cant = (SELECT intMaxCompra from productos WHERE idProducto = :prod ), '1', '0') as result FROM tempmaxcompra WHERE user = :user AND prod = :prod";
			const MAXCOMPRA_PRODUCTROWEXIST     = "SELECT COUNT(id) AS result FROM tempmaxcompra WHERE user = :user AND prod = :prod";
			const MAXCOMPRA_STORESUM            = "UPDATE tempmaxcompra SET used = used + :used WHERE user = :user AND prod = :prod";
			const MAXCOMPRA_STOREMAINS          = "UPDATE tempmaxcompra SET used = used - :used WHERE user = :user AND prod = :prod";
			const MAXCOMPRA_MAXPROD             = "SELECT intMaxCompra FROM productos WHERE idProducto = :prod";
			
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


			/**
			 * @internal
			 */
			const SHOPPINGCART_ALL = "SELECT 
				cart.idProducto as id_prod,
			    cart.intCantidad as cantidad,
			    cart.talle as id_talle,
			    cart.color as id_color,
			    cart.intContador as id,
			    tal.nombre_talle as talle,
			    clr.nombre_color as color,
                prod.strImagen as img,
                prod.strNombre as name,
                prod.dblPrecio as precio
			    
			FROM carrito as cart
			LEFT JOIN
				colores as clr ON clr.id_color = cart.color
			LEFT JOIN
				talles as tal ON tal.id_talle = cart.talle
            LEFT JOIN 
            	productos as prod ON prod.idProducto = cart.idProducto
			WHERE 
				cart.idUsuario = :id";

			const SHOPPINGCART_SUM = "SELECT IFNULL(SUM(intCantidad),0) as cantidad FROM carrito WHERE idUsuario = :id";


			/**
			 * @internal
			 * Historial
			 */
			
			const HISTORIAL_GET = "SELECT 
				compra.idCompra,
				compra.fthCompra as fecha,
			    dt.estado_producto as estado,
			    dt.cantidad,
			    dt.talle,
			    dt.color,
			    dt.precio_pagado,
			    dt.remito,
			    dt.id as id_detalle,
                prod.strNombre as nombre,
                prod.strImagen as img
			FROM 
				compra
			LEFT JOIN
				detalles_compras as dt ON dt.id_compra = compra.idCompra
			LEFT JOIN
            	productos as prod ON prod.idProducto = dt.id_producto	
			WHERE
				idUsuario = :id";
		}


		?>