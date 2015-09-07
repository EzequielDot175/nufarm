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

			// $qAll = self::COMPRA_ALL;
			// $i = 0;
			// $empty = true;
			// $compras = array();
			


			// /**
			//  * Detemino array vacio
			//  * @return [BOOLEAN]
			//  */
			// foreach($array as $key => $val):
			// 	if(!empty($val)):
			// 		$empty = false;
			// 		break;
			// 	endif;
			// endforeach;
			// /**
			//  * Si el array no esta vacio seteo where
			//  * @var string
			//  */
			// $where = ($empty ? '' : ' WHERE ');
			// /**
			//  * Seteo WHERE statement
			//  * @return [STRING]
			//  */
			// foreach($array as $key => $val):
			// 	if($i == 0):
			// 		if(!empty($val)):
			// 			$where .= $key." = '".$val."' ";
			// 			$i++;
			// 		endif;
			// 	else:
			// 		if(!empty($val)):
			// 			$where .= " AND ".$key." = '".$val."' ";
			// 		endif;
			// 	endif;
			// endforeach;
			// $query = $qAll.$where;
			
			// $sel = $this->query($query);
			// $collection = $sel->fetchAll();

			// foreach($collection as $key => $val):
			// 	$compras[$val->id_compra][] = $val;
			// endforeach;

			// return array_reverse($compras);
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