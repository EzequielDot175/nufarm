<?php 
	/**
	* 
	*/
	class Filtro
	{
		/**
		 * @param private:filters
		 */
		private $filters = array(); 
		private $clientes;
		private $empty = false;
		private $where = "";

		/**
		* @internal
		* Voy a separar la busqueda en dos modelos
		* Uno para vendedores
		* Otro para clientes
		* Si bien son dos busquedas distintas se aplican los mismos modificadores como fecha, cantidad de puntos, etc.
		*/
		public function __construct($params = array(),Cliente $cliente)
		{	
			/**
			 * @internal  Llamo al constructor de PDO
			 */
			$this->clientes = $cliente;
			$this->filters  = $params;
			$this->isEmpty($params);
		}


		public function results(){
			if($this->empty):
				echo json_encode($this->clientes->allCompras());
			else:
				$filters = array();
				$this->clientes->allComprasFilter($this->setFinal());


			endif;
		}

		





		private function setFinal(){
			$where = " WHERE ";
			$func = array('byId','byPuntos','byProd','byState','byDate');
			$i = 0;
			foreach($func as $key => $val):
				if($this->e($this->{$val}())):
					if($i == 0):
						$where .= $this->{$val}();
						$i++;
					else:
						$where .= " AND ".$this->{$val}(); 
					endif;
				endif;
			endforeach;

			return $where;
		}

		/**
		 * @internal WHERE statements
		 */

		private function byId(){
			if( !empty($this->filters['clientes']) ):
				return " usr.idUsuario = ".$this->filters['clientes'];
			else:
				return "";
			endif;
		}

		private function byPuntos(){
			if(!empty($this->filters['punt_disponibles'])):
				switch ($this->filters['punt_disponibles']) {
					case '0':
						return " usr.dblCredito BETWEEN 0 AND 1000 ";
						break;
					case '1':
						return " usr.dblCredito BETWEEN 1000 AND 2000 ";
						break;
					case '2':
						return " usr.dblCredito BETWEEN 2000 AND 3000 ";
						break;
					case '3':
						return " usr.dblCredito BETWEEN 3000 AND 4000 ";
						break;
					case '4':
						return " usr.dblCredito BETWEEN 4000 AND 5000 ";
						break;
					case '5':
						return " usr.dblCredito > 5000 ";
						break;
					
					default:
						return "";
						break;
				}
			else:
			
			endif;
		}

		private function byProd(){
			if($this->e($this->filters['prod_canjeado'])):
				return " dt.id_producto = ".$this->filters['prod_canjeado'];
			else:
				return "";
			endif;
		}

		private function byState(){
			if($this->e($this->filters['estado'])):
				return " dt.estado_producto = ".$this->filters['estado'];
			else:
				return "";
			endif;
		}

		private function byDate(){
			$byDate = "";


			if($this->e($this->filters['typeSearch'])  ):
				
				$date = new DateTime();
				switch ($this->filters['typeSearch']):
					case 'byWeek':
						$date->modify('-7 days');
						$byDate .= " compra.fthCompra < '".$date->format('Y-m-d')."'";
						break;
					case 'byMonth':
						$date->modify('-30 days');
						$byDate.= " compra.fthCompra < '".$date->format('Y-m-d')."'";
						break;
					
					default:
						return "";
						break;
				endswitch;

			elseif(		$this->e($this->filters['desde']) && $this->e($this->filters['hasta'])	):
				$desde = new DateTime($this->filters['desde']);
				$hasta = new DateTime($this->filters['hasta']);
				$byDate .= "  compra.fthCompra BETWEEN '".$desde->format('Y-m-d')."' AND ".$hasta->format('Y-m-d');
			
			elseif($this->e($this->filters['desde']) && !$this->e($this->filters['hasta']) ):
				
				$desde = new DateTime($this->filters['desde']);
				$byDate.=  "  compra.fthCompra > ".$desde->format('Y-m-d');
			
			elseif($this->e(!$this->filters['desde']) && $this->e($this->filters['hasta']) ):
				$hasta = new DateTime($this->filters['hasta']);
				$byDate.=  "  compra.fthCompra < ".$hasta->format('Y-m-d');
			endif;

			return $byDate;
		}

		private function e($param){
			return  ( (!empty($param) && !is_null($param)) ? true : false );
		}
		/**
		 * @internal  Final where 
		 */

		private function isEmpty($param){
			$i = 0;
			foreach($param as $key => $val):
			if(empty($val) || is_null($val)):
				$i++;
			endif;
			endforeach;

			if($i == count($param)):
				$this->empty            = true;
			endif;
		}
	}
 ?>