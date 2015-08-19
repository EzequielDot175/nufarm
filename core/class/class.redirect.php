<?php 
	/**
	* @internal Clase controladora de las redirecciones
	*/
	class Redirect 
	{
		
		function __construct()
		{
		}


		public static function to($header){
			header('location: '.$header);
			exit();
		}
	}

 ?>