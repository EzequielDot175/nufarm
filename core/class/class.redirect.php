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
			ob_start();
			@header('location: '.$header);
			exit();
		}
	}

 ?>