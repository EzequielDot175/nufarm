<?php 
	/**
	* @internal Clase controladora de autenticación
	*/
	class Auth
	{
		public function __construct()
		{
			$this->start();
		}


		public static function check(){
			if(isset($_SESSION['logged_id'])):
				header('location: index.php');
			endif;
		}



	}

 ?>