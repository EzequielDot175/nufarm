<?php 
	
	/**
	* @internal Class provincias 
	*/
	class Provincia
	{
		
		public function __construct(){}

		public static function all(){
			return Array("Buenos Aires",
			"Buenos Aires Capital",
			"Catamarca",
			"Chaco",
			"Chubut",
			"Cordoba",
			"Corrientes",
			"Entre Rios",
			"Formosa",
			"Jujuy",
			"La Pampa",
			"La Rioja",
			"Mendoza",
			"Misiones",
			"Neuquen",
			"Rio Negro",
			"Salta",
			"San Juan",
			"San Luis",
			"Santa Cruz",
			"Santa Fe",
			"Santiago del Estero",
			"Tierra del Fuego",
			"Tucuman");
		}

		public static function options($selected = null){
			$collection = self::all();
			$html = "";
			foreach($collection as $key => $val):
				if(strtolower($selected) == strtolower($val) ):
					$html .= '<option selected value="'.$val.'">'.$val.'</option>';
				else:
					$html .= '<option value="'.$val.'">'.$val.'</option>';
				endif;
			endforeach;
			echo($html);
		}
	}

 ?>