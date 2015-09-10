<?php 
	/**
	* @internal Clase de filtros
	*/
	class Filter extends DB
	{
		use Facade;

		function __construct()
		{
			parent::__construct();
		}

		public function format(){

		}

		public function all($estado = null){
			if(empty($estado)):
				return $this->query(self::COMPRA_ALL)->fetchAll();
			else:
				$sel = $this->prepare(self::COMPRA_ALL_BY_STATE);
				$sel->bindParam(':estado', $estado, PDO::PARAM_INT);
				$sel->execute();
				return $this->groupByIdCompra($sel->fetchAll());
			endif;
		}

		public function groupByIdCompra($collection){

			$groupBy = array();
			foreach($collection as $key => $val):
				$groupBy[$val->id_compra][] = $val;
			endforeach;

			return $groupBy;
		}

		public function byVendedor($id, $estado = null){
			if(empty($estado)):
				$sel = $this->prepare(self::COMPRA_ALL_BY_VENDEDOR);
				$sel->bindParam(':id',$id, PDO::PARAM_INT);
				$sel->execute();
				return $this->groupByIdCompra($sel->fetchAll());
			else:
				$sel = $this->prepare(self::COMPRA_ALL_BY_VENDEDOR_BY_STATE);
				$sel->bindParam(':id',$id, PDO::PARAM_INT);
				$sel->bindParam(':estado',$estado, PDO::PARAM_INT);
				$sel->execute();
				return $this->groupByIdCompra($sel->fetchAll());
				
			endif;
		}

		public function byCliente($id, $estado = null){
			
			if(empty($estado)):
				$sel = $this->prepare(self::COMPRA_ALL_BY_CLIENTE);
				$sel->bindParam(':id',$id, PDO::PARAM_INT);
				$sel->execute();
				return $this->groupByIdCompra($sel->fetchAll());
			else:
				$sel = $this->prepare(self::COMPRA_ALL_BY_CLIENTE_BY_STATE);
				$sel->bindParam(':id',$id, PDO::PARAM_INT);
				$sel->bindParam(':estado',$estado, PDO::PARAM_INT);
				$sel->execute();
				return $this->groupByIdCompra($sel->fetchAll());
			endif;
		}

		public function getCompras($array = array()){

			$obj = (Object)$array;

			if(empty($obj->cliente) && empty($obj->vendedor)):
				
				return $this->all($obj->estado);
				
			elseif (empty($obj->cliente) && !empty($obj->vendedor)):
				
				return $this->byVendedor($obj->vendedor, $obj->estado);
			
			elseif ( !empty($obj->cliente) && empty($obj->vendedor) || !empty($obj->cliente) && !empty($obj->vendedor) ):
				
				return $this->byCliente($obj->cliente,$obj->estado);
		
			else:
				return $this->all($obj->estado);
		
			endif;
		}


		public function historial($option){
			$historial = new Historial();
			switch ($option):
				case '1':
					$historial->basicsProductos();
					break;
				case '2':
					echo Estado::optionEstados();
					break;
				case '3':
					echo $historial->basicsRemitos();
					break;
				
				default:
					# code...
					break;
			endswitch;
		}




		public static function Compras($where){
			return self::method('getCompras',$where);
		}


		public static function idSelected($post){
			$post = $_POST[$post];
		
			if(isset($post) && is_numeric($post)):
				return $post;
			else:
				return null;
			endif;
		}
	}

 ?>