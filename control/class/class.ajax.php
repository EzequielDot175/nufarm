<?php
	/**
	* @internal Controlador ajax 
	*/
	class Ajax
	{
		private $call;
		
		public function __construct($request)
		{
			/**
			 * @internal: Selecciono el metodo
			 */
			$this->call = (String)$request;
		}

		/**
		 * @internal
		 * Llamo a la funcion interna privada de la clase media el string
		 */
		public function init(){
			$this->{'get'.$this->call}();
		}

		private function getVendedores(){
			$vendedores = new Vendedor();
			$vendedores->options();
		}
		private function getClientes(){
			$cliente = new Cliente();
			$cliente->options(self::post('id'));
		}
		private function getProdOptions(){
			$compra = new Compra();
			$compra->productosOptions();
		}

		/**
		 * @internal
		 * @param seteo los modelos a utilizar en el constructor
		 * @param Vendedor
		 * @param Cliente
		 */
		private function getFiltrado(){
			$cliente = new Cliente();
			$filtrado = new Filtro(self::post('parameters'),$cliente);
			$filtrado->results();
		}



		private static function post($name){
			return $_POST[$name];
		}

		/**
		 * @internal array to object
		 */
		
		public static function Angular(){
			if(isset($_SERVER["CONTENT_TYPE"]) && strpos($_SERVER["CONTENT_TYPE"], "application/json") !== false) {
			    $_POST = array_merge($_POST, (array) json_decode(trim(file_get_contents('php://input')), true));
			}
		}
	}



	if(isset($_POST['request'])):
		$ajax = new Ajax($_POST);
	endif;


	// print_r($_POST);
 ?>