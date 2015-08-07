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
		const CARRITO_BYID                  = "SELECT * FROM carrito WHERE intContador = :id";
		
		
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


	}



 ?>