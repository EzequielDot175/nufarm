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
		* @param class TempMaxCompra
		*/
		const MAXCOMPRA_ALL =  "SELECT idProducto as id,intMaxCompra as max FROM productos WHERE intStock > 0";
		const MAXCOMPRA_VERIFY =  "SELECT COUNT(id) as sum FROM tempmaxcompra WHERE user = ";
		const MAXCOMPRA_INSERT =  "INSERT INTO tempmaxcompra (user,prod,cant) VALUES ";
		const MAXCOMPRA_HAVELIMITCOMPRA = "SELECT cant FROM tempmaxcompra WHERE user = :user AND prod = :prod";
		const MAXCOMPRA_LIMITBYPROD = "SELECT intMaxCompra as result FROM productos WHERE idProducto = :prod";
		const MAXCOMPRA_UPDATELIMIT = "UPDATE tempmaxcompra SET cant = :cant WHERE user = :user AND prod = :prod";
		const MAXCOMPRA_GETMAXCOMPRA = "SELECT cant FROM tempmaxcompra WHERE user = :user AND prod = :prod";
		const MAXCOMPRA_UPDATEMAXCOMPRA = "UPDATE tempmaxcompra  SET cant = cant - :cant  WHERE user = :user AND prod = :prod";


	}



 ?>