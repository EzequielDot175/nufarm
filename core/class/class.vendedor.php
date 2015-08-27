<?php 
	/**
	* @internal
	*/
	class Vendedor extends DB
	{
		use Facade;

		public function __construct()
		{
			parent::__construct();
		}

		public function basics(){
			$sel = $this->prepare(self::VENDEDOR_OPTIONS);
			$sel->execute();
			return $sel->fetchAll();

			// echo "<pre>";
			// var_dump($sel->execute());
			// echo "</pre>";
			// return $sel->fetchAll();
		}

		public static function options($selected = null){
			$collection = self::method('basics');
			$html = "";
			foreach($collection as $key => $val):
				if(!empty($val->nombre) && !empty($val->apellido)):
					if(!is_null($selected)):
						if($selected == $val->id):
							$html .= '<option selected="" value="'.$val->id.'">'.strtoupper($val->nombre).' '.strtoupper($val->apellido).'</option>';
						else:
							$html .= '<option value="'.$val->id.'">'.strtoupper($val->nombre).' '.strtoupper($val->apellido).'</option>';
						endif;
					else:
						$html .= '<option value="'.$val->id.'">'.strtoupper($val->nombre).' '.strtoupper($val->apellido).'</option>';
					endif;
				endif;
			endforeach;
			echo($html);
		}
	}

 ?>