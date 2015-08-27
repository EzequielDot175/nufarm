<?php 
	/**
	* @internal
	* class Cliente
	*/
	class Cliente extends DB
	{
		use Facade;

		function __construct()
		{
			parent::__construct();
		}


		public function basics(){
			$sel = $this->prepare(self::CLIENTE_OPTIONS);
			$sel->execute();
			return $sel->fetchAll();
		}

		public static function options(){
			$collection = self::method('basics');
			$html = "";
			foreach($collection as $key => $val):
				if(!empty($val->nombre) && !empty($val->apellido)):
					$html .= '<option value="'.$val->id.'">'.strtoupper($val->nombre).' '.strtoupper($val->apellido).'</option>';
				endif;
			endforeach;
			echo($html);
		}
	}
 ?>