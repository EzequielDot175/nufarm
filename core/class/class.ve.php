<?php 
	/**
	* @internal [<description>]
	*/
	class VendedorEstrella extends DB
	{
		public $role = Null;
		
		public function __construct()
		{
			parent::__construct();
		}

		// public function byDate

		public function getByVendedor($id,$date){
			print_r($id);
			print_r($date);
		}

		public function getByCliente($obj){
			// $date = explode("_", $obj->date);

			if($this->checkClosedPeriod($obj->date)):
				/**
				 * Si el periodo existe..
				 */
				$date = explode('_', $obj->date);
				$sel = $this->prepare(self::VE_ALL_DATE_BY_CLIENT);
				$sel->bindParam(':id',$obj->cliente, PDO::PARAM_INT);
				$sel->bindParam(':inicio',$date[0], PDO::PARAM_STR);
				$sel->bindParam(':fin',$date[1], PDO::PARAM_STR);
				$sel->execute();
				$from_reg_anual = $sel->fetchAll();
				return $from_reg_anual;
			else:
							
			endif;

		}

		public function getAllByAuth(){
			$id = Auth::idAdmin();
			// Periodos existentes que ya fueron cerrados y guardados en ve_registro_anual
			$periodo = $_POST['params']['date'];

			/**
			 * Compruebo que no sea un periodo cerrado y guardado en base de datos
			 */
			if($this->checkClosedPeriod($periodo)):
				if(empty($periodo)):
					$sel = $this->prepare(self::VE_ALL_NO_DATE);
					$sel->bindParam(':id', $id, PDO::PARAM_INT);
					$sel->execute();
					$from_reg_anual = $sel->fetchAll();
					return $from_reg_anual;
				else:
					$date = explode('_', $_POST['params']['date']);
					$sel = $this->prepare(self::VE_ALL_DATE);
					$sel->bindParam(':id',$id, PDO::PARAM_INT);
					$sel->bindParam(':inicio',$date[0], PDO::PARAM_STR);
					$sel->bindParam(':fin',$date[1], PDO::PARAM_STR);
					$sel->execute();
					$from_reg_anual = $sel->fetchAll();
					return $from_reg_anual;
					
				endif;
			else:
				/**
				 * @internal Significa que el periodo no esta 
				 * registrado en la base de datos por lo tanto 
				 * busco en los resultados creados en la base de datos
				 */


			endif;
		}


		public function getResults($params){
			$obj = (Object)$params;
			$date = (empty($obj->date) ? 'all' : $obj->date);
			
			if($_POST['user']['role'] != 3):
				if(empty($obj->vendedor) && empty($obj->cliente)):
					return $this->getAll();
				elseif (empty($obj->vendedor) && !empty($obj->cliente)):
					return $this->getByVendedor($obj);
				elseif (!empty($obj->vendedor) && empty($obj->cliente)):
					return $this->getByCliente($obj);
				endif;
			else:
				if(empty($obj->cliente)):
					return $this->getAllByAuth();
				else:
					return $this->getByCliente($obj);
				endif;
			endif;

		}

		public function setInit(){


			echo "<pre>";
			print_r($var);
			echo "</pre>";
			die();
			$id = Auth::id();
			$year = 2015;
			$periodo = $this->nextPer();
			$data = json_encode($this->initDataFacturacion());
			if(!$this->hasFacturacion()):
				$ins = $this->prepare(self::VE_INSERT);
				$ins->bindParam(':id', $id, PDO::PARAM_INT);
				$ins->bindParam(':start', $periodo->inicio, PDO::PARAM_INT);
				$ins->bindParam(':end', $periodo->fin, PDO::PARAM_INT);
				$ins->bindParam(':data', $data, PDO::PARAM_INT);
				var_dump($ins->execute());
			endif;

		}

		public function periodos(){
			$periodos = $this->query(self::VE_ANUAL)->fetchAll();
			$last = array_pop($periodos);
			array_push($periodos, $last);
			$next = $this->nextPer($last);
			array_push($periodos, $next);

			return $periodos;
		}

		public function periodosReales(){
			$periodos = $this->query(self::VE_ANUAL)->fetchAll();
			return $periodos;	
		}

		/**
		 * Verifica si hay registros sobre el periodo creado en la base de datos,
		 * de lo contrario significa que tiene que buscar en el periodo actual, el cual no esta registrado aún
		 */
		public function checkClosedPeriod($date){
			$existe = false;

			$inicio = false;
			$fin = false;
			if(!empty($date)):
				$periodos = $this->periodosReales();
				$date = explode("_", $date);

				foreach($periodos as $key => $val):
					/**
					 * Separo la fecha en 2 partes,
					 * el año y el mes,
					 * si coinciden se considera que el periodo ya tiene registros en la base y se toma como valido
					 * de lo contrario el periodo no tiene registros y aun esta en desarrollo hasta que finalize el periodo
					 */
					$inicio_std = explode("-",$val->inicio);
					array_pop($inicio_std);

					$fin_std = explode("-", $val->fin);
					array_pop($fin_std);

					/**
					 * Preparo los datos para poder comparar
					 */
					$inicio_data = explode("-", $date[0]);
					array_pop($inicio_data);

					$fin_data = explode("-", $date[1]);
					array_pop($fin_data);

					$ini_diference = empty(array_diff($inicio_std, $inicio_data));
					$end_diference = empty(array_diff($fin_std, $fin_data));
					if($ini_diference && $end_diference):
						$existe = true;
						break;
					endif;

				endforeach;
				return $existe;
			endif;
		}


		public function getFacturacion($id){
			$sel = $this->prepare(self::VE_GETFACTURACION);
			$sel->bindParam(':id', $id, PDO::PARAM_INT);
			$sel->execute();
			echo json_encode($sel->fetch());
		}

		public function hasFacturacion(){
			$id = Auth::id();
			$result = $this->prepare(self::VE_HASFACTURACION);
			$result->bindParam(':id', $id, PDO::PARAM_INT);
			$result->execute();
			$resultado = $result->fetch();

			return (Boolean)$resultado->result;
			
		}

		public function isAdmin(){
			$role = Auth::userAdmin()->role;
			if($role == 1 || $role == 2):
				return true;
			else:
				return false;
			endif;
		}


		public function periodExist(){

		}

		private static function isGold($num) {
			switch ($num) {
				case '1':
					return 'NUFARM MAXX GOLD';
					break;
				case '0':
					return 'NUFARM MAXX';
					break;
				
				default:
					return '';
					break;
			}
		}

		private function nextPer($ultimo_periodo){
			$inicio = new DateTime($ultimo_periodo->inicio);
			$fin = new DateTime($ultimo_periodo->fin);
			$inicio =  $inicio->add(new DateInterval('P1Y'))->format('Y-m-d');
			$fin = $fin->add(new DateInterval('P1Y'))->format('Y-m-d');

			$proximoPeriodo = new stdClass();
			$proximoPeriodo->inicio = $inicio;
			$proximoPeriodo->fin = $fin;

			return $proximoPeriodo;
		}

		public function categoriasPremios(){
			return $this->query(self::VE_CATPREMIOS)->fetchAll();
		}

		private function initDataFacturacion(){
			return array ( 
				'Agosto' =>	array ( 'facturacion_total' => 0, 'facturacion_prod_clave' => 0 ), 
				'Septiembre' =>	array ( 'facturacion_total' => 0, 'facturacion_prod_clave' => 0 ), 
				'Octubre' =>	array ( 'facturacion_total' => 0, 'facturacion_prod_clave' => 0 ), 
				'Noviembre' =>	array ( 'facturacion_total' => 0, 'facturacion_prod_clave' => 0 ), 
				'Diciembre' =>	array ( 'facturacion_total' => 0, 'facturacion_prod_clave' => 0 ), 
				'Enero' =>	array ( 'facturacion_total' => 0, 'facturacion_prod_clave' => 0 ), 
				'Febrero' =>	array ( 'facturacion_total' => 0, 'facturacion_prod_clave' => 0 ), 
				'Marzo' =>	array ( 'facturacion_total' => 0, 'facturacion_prod_clave' => 0 )
			);

		}


	}
 ?>