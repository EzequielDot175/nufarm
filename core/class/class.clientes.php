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
			$sel = $this->query(self::CLIENTE_OPTIONS);
			$sel->execute();

			return $sel->fetchAll();
		}

		public function basicsById($id){
			if(!empty($id)):
				$sel = $this->prepare(self::CLIENTE_BYVENDEDOR);
				$sel->bindParam(':id',$id, PDO::PARAM_INT);
				$sel->execute();
				return $sel->fetchAll();
			else:
				return $this->basics();
			endif;
		}

		public function basicsVe(){
			return $this->query(self::VE_ALL_CLIENTES)->fetchAll();
		}

		public static function byVendedor($id){
			return self::method('basicsById',$id);
		}

		public static function options($selected = null){
			$collection = self::method('basics');

			$html = "";
			foreach($collection as $key => $val):
				if(!empty($val->strEmpresa)):
					if(!is_null($selected)):
						if($selected == $val->id):

							
							$html .= '<option value="'.$val->id.'">'.strtoupper($val->strEmpresa).'</option>';
						else:
							$html .= '<option value="'.$val->id.'">'.strtoupper($val->strEmpresa).'</option>';
						endif;
					else:
						$html .= '<option value="'.$val->id.'">'.strtoupper($val->strEmpresa).'</option>';
					endif;
				endif;
			endforeach;
			echo($html);
		}

		public static function optionsCombo($id){
			$collection = self::method('basicsById',$id);

			$html = '<option value="">CLIENTE</option>';
			foreach($collection as $key => $val):
				$html .= '<option value="'.$val->id.'">'.strtoupper($val->strEmpresa).'</option>';
			endforeach;
			echo($html);
		
		}
	}
 ?>