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
			return $this->fetchAll();
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