<?php 

	/**
	* 
	*/
	class Ajax
	{
		
		public static function get($param){
			self::{$param}();
			die();
		}

		public static function call($use){
			self::{$use}();
			die();	
		}


		public static function vendedores(){
			$vendedores = new Vendedor();
			$all = $vendedores->basics();
			echo json_encode($all);
		}

		public static function clientes(){
			$clientes = new Cliente();
			if(is_null(self::post('id'))):
				$all = $clientes->basics();
				echo json_encode($all);
			else:
				$all = $clientes->basicsById(self::post('id'));
				echo json_encode($all);
			endif;
		}

		public static function filter(){
			$params = self::post('params');
			$ve = new VendedorEstrella();
			// $ve->

			print_r($params);
		}

		/**
		 * Seteo las condiciones para que angular js pueda hacer post a php normal
		 */
		public static function Angular(){
			if(isset($_SERVER["CONTENT_TYPE"]) && strpos($_SERVER["CONTENT_TYPE"], "application/json") !== false) {
			    $_POST = array_merge($_POST, (array) json_decode(trim(file_get_contents('php://input')), true));
			}
		}


		public static function post($name){
			return ( isset($_POST[$name]) && !empty($_POST[$name]) ? $_POST[$name] : null ) ;
		}

	}







 ?>