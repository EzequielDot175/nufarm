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


		private static function vendedores(){
			$user = self::post('user');

			switch ($user['role']) {
				case '1':
				case '2':
					$vendedores = new Vendedor();
					$all = $vendedores->basics();
					echo json_encode($all);
					break;

				default:
					
					break;
			}
			
		}

		private static function clientes(){
			$user = self::post('user');
			$clientes = new Cliente();

			switch ($user['role']) {
				case '1':
				case '2':
						if(is_null(self::post('id'))):
							$all = $clientes->basics();
							echo json_encode($all);
						else:
							$all = $clientes->basicsById(self::post('id'));
							echo json_encode($all);
						endif;
					break;
				default:
				// print_r($_POST);
					$all = $clientes->basicsById($user['id']);
					echo json_encode($all);
					break;
			}
			
			// $clientes = new Cliente();
			// if(is_null(self::post('id'))):
			// 	$all = $clientes->basics();
			// 	// echo json_encode($all);
			// else:
			// 	$all = $clientes->basicsById(self::post('id'));
			// 	// echo json_encode($all);
			// endif;
		}

		private static function filter(){
			$filter = self::post('params');
			$user = self::post('user');
			$ve = new VendedorEstrella();
			$ve->role = $user['role'];
			$collection = $ve->getResults($filter);
			echo json_encode($collection);
		}

		private static function myData(){
			$ve = new VendedorEstrella();
			$collection = $ve->getFacturacion(self::post('id'));
			print_r($collection);
		}

		private static function Periodos(){
			$ve = new VendedorEstrella();
			$collection = $ve->periodos();
			echo json_encode($collection);
		}

		private static function User(){
			$user = Auth::userAdmin();
			print_r($user);
		}

		private static function catPremios(){
			$ve = new VendedorEstrella();
			$collection = $ve->categoriasPremios();
			echo json_encode($collection);
		}

		private static function post($name){
			return ( isset($_POST[$name]) && !empty($_POST[$name]) ? $_POST[$name] : null ) ;
		}

		/**
		 * Seteo las condiciones para que angular js pueda hacer post a php normal
		 */
		public static function Angular(){
			if(isset($_SERVER["CONTENT_TYPE"]) && strpos($_SERVER["CONTENT_TYPE"], "application/json") !== false) {
			    $_POST = array_merge($_POST, (array) json_decode(trim(file_get_contents('php://input')), true));
			}
		}

	}







 ?>