<?php 

	/**
	* @internal 
	* Class: Historial
	*/
	class Historial extends DB
	{
		use Facade;

		public function __construct(){
			parent::__construct();
			$this->id = Auth::id();
		}




		public function getById(){
			$sel = $this->prepare(self::HISTORIAL_GET);
			$sel->bindParam(':id', $this->id, PDO::PARAM_INT);
			$sel->execute();
			$collection = $sel->fetchAll();
			$compra = array();
			$totales = array();
		
			foreach($collection as $key => $val):
				$compra[$val->idCompra][] = $val;
				$totales[$val->idCompra] = 0;
			endforeach;

			foreach($collection as $key => $val):
				$totales[$val->idCompra] += (int)$val->precio_pagado;
			endforeach;
		
			$return = new stdClass();
			$return->{'compras'} = $compra;
			$return->{'totales'} = $totales;
			return $return;
		}

		public function basicsProductos(){
			$sel = $this->prepare(self::HISTORIAL_OPTIONS_PRODUCTOS);
			$sel->bindParam(':id', $this->id, PDO::PARAM_INT);
			$sel->execute();
			echo(json_encode($sel->fetchAll()));
		}

		public function basicsRemitos(){
			$sel = $this->prepare(self::HISTORIAL_REMITOS_BY_AUTH);
			$sel->bindParam(':id', $this->id, PDO::PARAM_INT);
			$sel->execute();
			echo json_encode($sel->fetchAll());
		}

		public function filtrarHistorial(){
			$obj = (Object)$_POST;

			if(isset($obj->producto)):
				/**
				 * Busca por id loggin && id producto
				 */
				return $this->byAuthAndProd($obj->producto);
			
			elseif(isset($obj->estado)):
				/**
				 * Busca por id loggin && id estado
				 */
				return $this->byAuthAndState($obj->estado);
			elseif(isset($obj->remito)):
				/**
				 * Busca por id loggin && id remito
				 */
				return $this->byAuthAndReference($obj->remito);
				
			elseif(isset($obj->date)):
				/**
				 * Busca por id loggin && id fecha
				 */
				return $this->byAuthAndDate($obj->date);
				
			endif;

		}


		public function byAuthAndProd($id){
			$sel = $this->prepare(self::HISTORIAL_AUTH_BY_PROD);
			$sel->bindParam(':id', $this->id, PDO::PARAM_INT);
			$sel->bindParam(':id_prod', $id, PDO::PARAM_INT);
			$sel->execute();

			return self::formatByCompra($sel->fetchAll());
		}

		public function byAuthAndState($id){
			$sel = $this->prepare(self::HISTORIAL_AUTH_BY_STATE);
			$sel->bindParam(':id', $this->id, PDO::PARAM_INT);
			$sel->bindParam(':id_state', $id, PDO::PARAM_INT);
			$sel->execute();

			return self::formatByCompra($sel->fetchAll());
		}

		public function byAuthAndReference($ref){
			$sel = $this->prepare(self::HISTORIAL_AUTH_BY_REF);
			$sel->bindParam(':id', $this->id, PDO::PARAM_INT);
			$sel->bindParam(':id_ref', $ref, PDO::PARAM_INT);
			$sel->execute();

			return self::formatByCompra($sel->fetchAll());
		}

		public function byAuthAndDate($fecha){
			$like = "%".$fecha."%";
			$sel = $this->prepare(self::HISTORIAL_AUTH_BY_DATE);
			$sel->bindParam(':id', $this->id, PDO::PARAM_INT);
			$sel->bindParam(':fecha', $like , PDO::PARAM_STR);
			$sel->execute();
			
			return self::formatByCompra($sel->fetchAll());
		}


		public static function formatByCompra($collection){
			$compra = array();
			$totales = array();
		
			foreach($collection as $key => $val):
				$compra[$val->idCompra][] = $val;
				$totales[$val->idCompra] = 0;
			endforeach;

			foreach($collection as $key => $val):
				$totales[$val->idCompra] += (int)$val->precio_pagado;
			endforeach;
		
			$return = new stdClass();
			$return->{'compras'} = $compra;
			$return->{'totales'} = $totales;
			return $return;
		}

		public static function filtrar(){
			return self::method('filtrarHistorial');
		} 


	}

 ?>