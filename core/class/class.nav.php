<?php 
	/**
	* 
	*/
	class Nav
	{
		
		function __construct()
		{
		}

		public static function active($name){
			$script = $_SERVER['SCRIPT_NAME'];
			$info = pathinfo($script);
			
			if($name == $info['filename']):
				echo('nav-link-active');			
			endif;
		}

		public static function titulo($name){

			switch ($name) {
				case 'catalogo.php':
					$valor= ['CATÁLOGO', 'DE PRODUCTOS'];
					break;

				case 'historial.php':
					$valor= ['HISTORIAL DE CANJES REALIZADOS', 'VERIFIQUE EL ESTADO DE SUS CANJES'];
					break;

				case 'carrito.php':
					$valor= ['CARRITO', 'CONFIRMAR CANJES'];
					break;
				
				default:
					$valor= ['CATÁLOGO', 'DE PRODUCTOS'];
					break;	
			}

			return $valor;

		}
	}
 ?>