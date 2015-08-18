<?php 

	/**
	* 
	*/
	class Cliente extends DB
	{
		protected $table = "usuarios";
		
		public function __construct()
		{
			parent::__construct();
		}

		public function options($id){

			$format = array();
			if($id == 'all'):
				$data = $this->getRows(self::CLIENTE_BASICS);
			else:
				$data = $this->prepare(self::CLIENTE_BASICSBYVENDEDOR);
				$data->bindParam(':id',$id,PDO::PARAM_INT);
				$data->execute();
				$data = $data->fetchAll();
			endif;
			foreach($data as $k => $v):
				if(!empty($v->strNombre)):
					$format[$k] = new stdClass();
					$format[$k]->value = (int)$v->idUsuario;
					$format[$k]->text = $v->strNombre." ".$v->strApellido;
				endif;
			endforeach;
			echo json_encode($format);
			
		}


		public function basics(){
			$sel = $this->prepare();
		}

		public function allCompras(){
			return $this->getRows(self::CLIENTE_ALLCOMPRAS);
		}
		/**
		 * [allComprasFilter description]
		 * Genera el sql de para realizar busquedas de compras por filtrado
		 * @param  String  $where [description]
		 * @return [JSON]  resultados
		 */
		public function allComprasFilter($where){
			
			if(!empty($where)):
				/**
				 * @param
				 */
				
				echo(json_encode($this->getRows(self::CLIENTE_ALLCOMPRAS.$where)));


			endif;

		}
	}

 ?>