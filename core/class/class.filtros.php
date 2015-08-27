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

		public function getCompras($array = array()){

			$qAll = self::COMPRA_ALL;
			$i = 0;
			$empty = true;
			$compras = array();
			/**
			 * Detemino array vacio
			 * @return [BOOLEAN]
			 */
			foreach($array as $key => $val):
				if(!empty($val)):
					$empty = false;
					break;
				endif;
			endforeach;
			/**
			 * Si el array no esta vacio seteo where
			 * @var string
			 */
			$where = ($empty ? '' : ' WHERE ');
			/**
			 * Seteo WHERE statement
			 * @return [STRING]
			 */
			foreach($array as $key => $val):
				if($i == 0):
					if(!empty($val)):
						$where .= $key." = '".$val."' ";
						$i++;
					endif;
				else:
					if(!empty($val)):
						$where .= " AND ".$key." = '".$val."' ";
					endif;
				endif;
			endforeach;
			$query = $qAll.$where;
			
			$sel = $this->query($query);
			$collection = $sel->fetchAll();

			foreach($collection as $key => $val):
				$compras[$val->id_compra][] = $val;
			endforeach;

			return array_reverse($compras);
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