<?php 
	/**
	* 
	*/
	class Color
	{
			

		public function __construct()
		{

		}

		public static function get($color){
			$colores = array(
				'verde' => "#009448",
				'negro' => "#000000",
				'gris oscuro' => "#414141",
				'verde seco' => "#54B649"
			);

			return ( isset($colores[strtolower($color)]) ? "style='background-color: ".$colores[strtolower($color)]."!important;'" : ''	);
		}


	}

 ?>