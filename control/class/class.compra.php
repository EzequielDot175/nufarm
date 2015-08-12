<?php 
	/**
	* 
	*/
	class Compra extends DB
	{
		
		public function __construct()
		{
			parent::__construct();
		}

		public function productos(){
			$sel = $this->getRows(self::COMPRAS_SEL_PROD);
			return $sel;
		}

		public function productosOptions(){
			$format = array();
			$data = $this->productos();
			foreach($data as $k => $v):
				if(!empty($v->strNombre)):
					$format[$k] = new stdClass();
					$format[$k]->value = $v->idProducto;
					$format[$k]->text = $v->strNombre;
				endif;
			endforeach;
			echo json_encode($format);
			
		}
	}
 ?>