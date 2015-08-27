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
	}
 ?>