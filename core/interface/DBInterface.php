			<?php 
			
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
			const PRODUCTO_UPDCAT 				= "UPDATE productos SET intCategoria = :cat WHERE idProducto = :prod";
			const PRODUCTO_STOCKSUMTALLE 		= "SELECT SUM(IF(ISNULL(talles.nombre_talle), 0 , tal_prod.cantidad)) as stock FROM talles_productos as tal_prod LEFT JOIN talles ON talles.id_talle = tal_prod.id_talle WHERE tal_prod.id_producto = :id";
			const PRODUCTO_STOCKSUMCOLOR 		= "SELECT SUM(IF(ISNULL(colores.nombre_color), 0 , col_prod.cantidad)) as stock FROM colores_productos as col_prod LEFT JOIN colores ON colores.id_color = col_prod.id_color WHERE col_prod.id_producto = :id";
			const PRODUCTO_STOCKSUMTALLECOLOR	= "SELECT SUM(cantidad) as stock FROM colores_talles WHERE id_producto = :id";
			/**
			* @param carrito
			*/
			const CARRITO_BYID                  = "SELECT * FROM carrito WHERE intContador = :id";
			

			/**
			 * @param CLASS: Auth
			 */
			const AUTH_USER 					= "SELECT * FROM usuarios WHERE idUsuario = :id"; 
			const AUTH_USEDPOINTS				= "SELECT SUM(dblTotal) as total FROM compra WHERE idUsuario = :id ";
			const AUTH_USERADMIN 				= "SELECT * FROM personal WHERE id = :id";
			
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
			const COMPRA_ALL = "SELECT
			 compra.fthCompra,
			 compra.dblTotal,
			 compra.idCompra as id_compra,
			 compra.estado,
			 dt.nombre as prodNombre,
			 dt.remito,
			 dt.color,
			 dt.talle,
			 dt.precio_pagado,
			 dt.cantidad,
			 dt.estado_producto as estado_detalle,
			 dt.id as id_detalle,
			 usr.strNombre as nombre,
			 usr.strApellido as apellido,
			 usr.strEmail as email,
             usr.idUsuario as user_id,
             prs.nombre as v_nombre,
             prs.apellido as v_apellido,
             prs.id as v_id,
             prod.strNombre as prod_nombre,
             prod.strImagen as prod_imagen

			FROM
				compra
			LEFT JOIN
				detalles_compras as dt ON dt.id_compra = compra.idCompra
			LEFT JOIN
				usuarios as usr ON usr.idUsuario = compra.idUsuario
            LEFT JOIN
            	personal as prs ON prs.id = usr.vendedor
           	LEFT JOIN 
           		productos as prod ON prod.idProducto = dt.id_producto";

           	const COMPRA_ALL_BY_STATE = "SELECT
			 compra.fthCompra,
			 compra.dblTotal,
			 compra.idCompra as id_compra,
			 compra.estado,
			 dt.nombre as prodNombre,
			 dt.remito,
			 dt.color,
			 dt.talle,
			 dt.precio_pagado,
			 dt.cantidad,
			 dt.estado_producto as estado_detalle,
			 dt.id as id_detalle,
			 usr.strNombre as nombre,
			 usr.strApellido as apellido,
			 usr.strEmail as email,
             usr.idUsuario as user_id,
             prs.nombre as v_nombre,
             prs.apellido as v_apellido,
             prs.id as v_id,
             prod.strNombre as prod_nombre,
             prod.strImagen as prod_imagen

			FROM
				compra
			LEFT JOIN
				detalles_compras as dt ON dt.id_compra = compra.idCompra
			LEFT JOIN
				usuarios as usr ON usr.idUsuario = compra.idUsuario
            LEFT JOIN
            	personal as prs ON prs.id = usr.vendedor
           	LEFT JOIN 
           		productos as prod ON prod.idProducto = dt.id_producto WHERE compra.estado = :estado";



           	const COMPRA_ALL_BY_VENDEDOR = "SELECT
			 compra.fthCompra,
			 compra.dblTotal,
			 compra.idCompra as id_compra,
			 compra.estado,
			 dt.nombre as prodNombre,
			 dt.remito,
			 dt.color,
			 dt.talle,
			 dt.precio_pagado,
			 dt.cantidad,
			 dt.estado_producto as estado_detalle,
			 dt.id as id_detalle,
			 usr.strNombre as nombre,
			 usr.strApellido as apellido,
			 usr.strEmail as email,
             usr.idUsuario as user_id,
             prs.nombre as v_nombre,
             prs.apellido as v_apellido,
             prs.id as v_id,
             prod.strNombre as prod_nombre,
             prod.strImagen as prod_imagen

			FROM
				compra
			LEFT JOIN
				detalles_compras as dt ON dt.id_compra = compra.idCompra
			LEFT JOIN
				usuarios as usr ON usr.idUsuario = compra.idUsuario
            LEFT JOIN
            	personal as prs ON prs.id = usr.vendedor
           	LEFT JOIN 
           		productos as prod ON prod.idProducto = dt.id_producto WHERE prs.id = :id ";

           	const COMPRA_ALL_BY_CLIENTE = "SELECT
			 compra.fthCompra,
			 compra.dblTotal,
			 compra.idCompra as id_compra,
			 compra.estado,
			 dt.nombre as prodNombre,
			 dt.remito,
			 dt.color,
			 dt.talle,
			 dt.precio_pagado,
			 dt.cantidad,
			 dt.estado_producto as estado_detalle,
			 dt.id as id_detalle,
			 usr.strNombre as nombre,
			 usr.strApellido as apellido,
			 usr.strEmail as email,
             usr.idUsuario as user_id,
             prs.nombre as v_nombre,
             prs.apellido as v_apellido,
             prs.id as v_id,
             prod.strNombre as prod_nombre,
             prod.strImagen as prod_imagen

			FROM
				compra
			LEFT JOIN
				detalles_compras as dt ON dt.id_compra = compra.idCompra
			LEFT JOIN
				usuarios as usr ON usr.idUsuario = compra.idUsuario
            LEFT JOIN
            	personal as prs ON prs.id = usr.vendedor
           	LEFT JOIN 
           		productos as prod ON prod.idProducto = dt.id_producto WHERE usr.idUsuario = :id ";

           	const COMPRA_ALL_BY_CLIENTE_BY_STATE = "SELECT
			 	compra.fthCompra,
			 	compra.dblTotal,
			 	compra.idCompra as id_compra,
			 	compra.estado,
			 	dt.nombre as prodNombre,
			 	dt.remito,
			 	dt.color,
			 	dt.talle,
			 	dt.precio_pagado,
			 	dt.cantidad,
			 	dt.estado_producto as estado_detalle,
			 	dt.id as id_detalle,
			 	usr.strNombre as nombre,
			 	usr.strApellido as apellido,
			 	usr.strEmail as email,
             	usr.idUsuario as user_id,
             	prs.nombre as v_nombre,
             	prs.apellido as v_apellido,
             	prs.id as v_id,
             	prod.strNombre as prod_nombre,
             	prod.strImagen as prod_imagen

			FROM
				compra
			LEFT JOIN
				detalles_compras as dt ON dt.id_compra = compra.idCompra
			LEFT JOIN
				usuarios as usr ON usr.idUsuario = compra.idUsuario
            LEFT JOIN
            	personal as prs ON prs.id = usr.vendedor
           	LEFT JOIN 
           		productos as prod ON prod.idProducto = dt.id_producto WHERE usr.idUsuario = :id AND compra.estado = :estado";


			
			const COMPRA_ALL_BY_VENDEDOR_BY_STATE = "SELECT
			 compra.fthCompra,
			 compra.dblTotal,
			 compra.idCompra as id_compra,
			 compra.estado,
			 dt.nombre as prodNombre,
			 dt.remito,
			 dt.color,
			 dt.talle,
			 dt.precio_pagado,
			 dt.cantidad,
			 dt.estado_producto as estado_detalle,
			 dt.id as id_detalle,
			 usr.strNombre as nombre,
			 usr.strApellido as apellido,
			 usr.strEmail as email,
             usr.idUsuario as user_id,
             prs.nombre as v_nombre,
             prs.apellido as v_apellido,
             prs.id as v_id,
             prod.strNombre as prod_nombre,
             prod.strImagen as prod_imagen

			FROM
				compra
			LEFT JOIN
				detalles_compras as dt ON dt.id_compra = compra.idCompra
			LEFT JOIN
				usuarios as usr ON usr.idUsuario = compra.idUsuario
            LEFT JOIN
            	personal as prs ON prs.id = usr.vendedor
           	LEFT JOIN 
           		productos as prod ON prod.idProducto = dt.id_producto WHERE prs.id = :id AND dt.estado_producto = :estado";

           	const COMPRA_COUNT = "SELECT COUNT(idCompra) AS count FROM compra";
			
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
			const DTCOMPRA_UPDESTADO 				  = "UPDATE detalles_compras as dt SET dt.estado_producto = :estado WHERE dt.id = :dtid";
			
			
			
			
			
			/**
			* @param class: Usuario
			*/
			
			const USUARIO_SUMCREDITO                 = "UPDATE usuarios SET dblCredito = dblCredito + :num WHERE idUsuario = :user";
			const USUARIO_EDIT 						 = "UPDATE usuarios :QUERY WHERE idUsuario = :id";
			const USUARIO_BY_ID 					 = "SELECT * FROM usuarios WHERE idUsuario = :id";
			
			
			
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


			/**
			 * @internal
			 * Consultas
			 */

			const CONSULTA_GET = "SELECT cons.*, usr.strNombre FROM consultas as cons LEFT JOIN usuarios as usr ON usr.idUsuario = cons.idUsuario WHERE cons.idUsuario = :id";
			const CONSULTA_LAST = "SELECT * FROM consultas WHERE idUsuario = :id ORDER BY idConsulta DESC LIMIT 1";
			const CONSULTA_GETRESPONSE = "SELECT 
					cons.strCampo as texto,
				    cons.fecha,
				    usr.strNombre
				FROM consultas as cons
				LEFT JOIN  
					usuarios as usr ON usr.idUsuario =  cons.idUsuario

				WHERE
					cons.respuesta_de = :id";
			const CONSULTA_NEW = "INSERT INTO consultas (idUsuario,strAsunto,strCampo,fecha,respondido,tipo,respuesta_de) VALUES (:id,:asunto,:campo,NOW(),0,1,0) ";
			const CONSULTA_GET_USER_BY_CONS = "SELECT 
						usr.strNombre,
					   	usr.strApellido,
					   	usr.strEmail,
					FROM 
						consultas as cons
					LEFT JOIN 
						usuarios as usr ON usr.idUsuario = cons.idUsuario
					WHERE 
						idConsulta = :id";
			const CONSULTA_BY_ID = "SELECT * FROM consultas WHERE idConsulta = :id";



			/**
			 * @internal 
			 * Clientes
			 */
			
			const CLIENTE_OPTIONS = "SELECT idUsuario as id, strEmpresa FROM usuarios";
			const CLIENTE_BYVENDEDOR = "SELECT idUsuario as id, strEmpresa FROM usuarios WHERE vendedor = :id";

			/**
			 * @internal
			 * Vendores
			 */
			
			const VENDEDOR_OPTIONS = "SELECT id , nombre, apellido FROM personal WHERE role = 3";


			/**
			 * @internal
			 * Vendedor Estrella
			 */
			const VE_HASFACTURACION         = "SELECT IF(COUNT(id) = 0, 0, 1) as result FROM `facturacion` WHERE id_user = :id ";
			const VE_INSERT                 = "INSERT INTO facturacion (id_user,data,start_year, end_year) VALUES (:id,:data, :start, :end)";		
			const VE_GETFACTURACION         = "SELECT * FROM facturacion WHERE id_user = :id";
			const VE_ANUAL                  = "SELECT DATE_FORMAT(fecha_inicio, '%Y-%m-%d') as inicio, DATE_FORMAT(fecha_fin, '%Y-%m-%d') as fin FROM ve_registro_anual GROUP BY fecha_inicio, fecha_fin ";
			const VE_ALL_NO_DATE            = "SELECT ve.*, IF(usr.gold = 1, 'NUFARM MAX GOLD' , 'NUFARM MAX' ) AS gold FROM ve_registro_anual as ve LEFT JOIN usuarios as usr ON usr.idUsuario = id_cliente WHERE id_vendedor = :id";
			const VE_ALL_DATE               = "SELECT ve.*, IF(usr.gold = 1, 'NUFARM MAX GOLD' , 'NUFARM MAX' ) AS gold FROM ve_registro_anual as ve LEFT JOIN usuarios as usr ON usr.idUsuario = id_cliente WHERE id_vendedor = :id AND fecha_inicio >= :inicio AND fecha_fin <= :fin";
			const VE_ALL_DATE_BY_CLIENT     = "SELECT ve.*, IF(usr.gold = 1, 'NUFARM MAX GOLD' , 'NUFARM MAX' ) AS gold FROM ve_registro_anual as ve LEFT JOIN usuarios as usr ON usr.idUsuario = id_cliente WHERE id_cliente = :id AND fecha_inicio >= :inicio AND fecha_fin <= :fin";
			const VE_CATPREMIOS             = "SELECT * FROM categorias_premios";
			const VE_USERFACTURACION        = "SELECT usr.idUsuario, fact.id_user, usr.vendedor  FROM `usuarios` as usr LEFT JOIN facturacion as fact ON fact.id_user = usr.idUsuario WHERE usr.vendedor = :id";
			const VE_ALL_USERFACTURACION    = "SELECT usr.idUsuario, fact.id_user, usr.vendedor  FROM `usuarios` as usr LEFT JOIN facturacion as fact ON fact.id_user = usr.idUsuario ";
			const VE_INS_FACT_INCIAL        = "INSERT INTO facturacion (id_user,id_vendedor,data,fact_total,fact_prod_clave,periodo_inicial,periodo_final) VALUES (:id,:vendedor, :data, 0, 0, :start, :end)"; 
			const VE_CLIENTFACTBYID         = "SELECT
													fact.id,
													fact.data as facturacion,
													fact.fact_total as total,
												    fact.fact_prod_clave as total_prod_clave,
												    usr.strEmpresa as cliente,
												    IF(usr.gold = 1,'NUFARM MAXX GOLD' , 'NUFARM MAXX') AS gold,
												    CONCAT(per.nombre,' ',per.apellido) as vendedor,
												    (SELECT total FROM ve_registro_anual WHERE fecha_inicio = :periodo_anterior AND id_cliente = fact.id_user) as ultimo_total
												FROM 
													facturacion as fact
												LEFT JOIN
													usuarios as usr ON usr.idUsuario = fact.id_user
												LEFT JOIN
													personal as per ON per.id = usr.vendedor
												WHERE
													fact.id_user = :id";
			const VE_ALL_CLIENTES_VENDEDORES   = "SELECT
													fact.id,
													fact.data as facturacion,
													fact.fact_total as total,
												    fact.fact_prod_clave as total_prod_clave,
												    usr.strEmpresa as cliente,
												    IF(usr.gold = 1,'NUFARM MAXX GOLD' , 'NUFARM MAXX') AS gold,
												    CONCAT(per.nombre,' ',per.apellido) as vendedor,
												    (SELECT total FROM ve_registro_anual WHERE fecha_inicio = :periodo_anterior AND id_cliente = fact.id_user) as ultimo_total
												FROM 
													facturacion as fact
												LEFT JOIN
													usuarios as usr ON usr.idUsuario = fact.id_user
												LEFT JOIN
													personal as per ON per.id = usr.vendedor";
			const VE_ALL_CLIENTES_VENDEDORES_BY_PERIOD = "SELECT ve.*,  IF(usr.gold = 1,'NUFARM MAXX GOLD' , 'NUFARM MAXX') AS gold FROM ve_registro_anual as ve LEFT JOIN usuarios as usr ON usr.idUsuario = ve.id_vendedor WHERE fecha_inicio = :inicio AND fecha_fin = :fin";
			const VE_CLIENTFACTBYIDROW         = "SELECT
													fact.id,
													fact.data as facturacion,
													fact.fact_total as total,
												    fact.fact_prod_clave as total_prod_clave,
												    usr.strEmpresa as cliente,
												    IF(usr.gold = 1,'NUFARM MAXX GOLD' , 'NUFARM MAXX') AS gold,
												    CONCAT(per.nombre,' ',per.apellido) as vendedor,
												    (SELECT total FROM ve_registro_anual WHERE fecha_inicio = :periodo_anterior AND id_cliente = fact.id_user) as ultimo_total
												FROM 
													facturacion as fact
												LEFT JOIN
													usuarios as usr ON usr.idUsuario = fact.id_user
												LEFT JOIN
													personal as per ON per.id = usr.vendedor
												WHERE
													fact.id = :id";
			const VE_CLIENTFACTBYIDVENDEDOR = "SELECT 
													fact.id,
													fact.data as facturacion,
													fact.fact_total as total,
												    fact.fact_prod_clave as total_prod_clave,
												    usr.strEmpresa as cliente,
												    IF(usr.gold = 1,'NUFARM MAXX GOLD' , 'NUFARM MAXX') AS gold,
												    CONCAT(per.nombre,' ',per.apellido) as vendedor,
												    (SELECT total FROM ve_registro_anual WHERE fecha_inicio = :periodo_anterior AND id_cliente = fact.id_user) as ultimo_total,
												    (SELECT total_prod_clave FROM ve_registro_anual WHERE fecha_inicio = :periodo_anterior AND id_cliente = fact.id_user) as ultimo_prod_clave
												FROM 
													facturacion as fact
												LEFT JOIN
													usuarios as usr ON usr.idUsuario = fact.id_user
												LEFT JOIN
													personal as per ON per.id = usr.vendedor
												WHERE
													fact.id_vendedor = :id";
			const VE_TOTAL_BY_PERIOD 		= "SELECT SUM(total) as total, SUM(total_prod_clave) as producto_clave FROM ve_registro_anual WHERE id_vendedor = :id AND fecha_inicio >= :inicio AND fecha_fin <= :fin";
			const VE_TOTAL_BY_CURRENT_PERIOD 		= "SELECT SUM(fact_total) as total, SUM(fact_prod_clave) as producto_clave FROM facturacion WHERE id_vendedor = :id";
			const VE_UPDATE_CURRENT_PERIOD_BYID = "UPDATE facturacion SET data = :data , fact_total = :total, fact_prod_clave = :fact_prod_clave WHERE id = :id";
			const VE_SEL_FACT_BY_ID 			= "SELECT * FROM facturacion WHERE id = :id";
			const VE_ALL_CLIENTES 				= "SELECT idUsuario AS id, strEmpresa FROM usuarios ";
			const VE_SEL_FACT_BY_IDUSER 		= "SELECT * FROM facturacion WHERE id_user = :id";
			const VE_CATEGORY_OLD_PERIOD_BY_USER = "SELECT 
				  ROUND( ( ve.total_prod_clave / ve.total ) * 100 ) as porcentaje
			FROM 
				ve_registro_anual as ve 
			WHERE 
				ve.id_cliente = :id AND ve.fecha_inicio = :fecha_inicio ";
					}


		?>

