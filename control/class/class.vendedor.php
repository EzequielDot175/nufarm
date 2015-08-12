<?php 

	/**
	* 
	*/
	class Vendedor extends Personal
	{
		protected $role = 3;

		public function __construct()
		{
			parent::__construct();
		}

		public function all(){
			$all = $this->prepare(self::PERSONAL_BYROLE);
			$all->bindParam(':role',$this->role,PDO::PARAM_INT);
			$all->execute();
			return $all->fetchAll();
		}

		public function options(){
			$format = array();
			foreach($this->all() as $k => $v):
				$obj = new stdClass();
				$format[$k] = $obj;
				$format[$k]->value = (int)$v->id;
				$format[$k]->text = $v->nombre." ".$v->apellido;
			endforeach;

			echo json_encode($format);
			// Template::get('option',$format);
		}

		public function allCompras($filters = array()){
			$sel = $this->prepare(self::PERSONAL_ALLCOMPRAS);
			if (count($filters)):
				
			endif;
		}
	}

 ?>