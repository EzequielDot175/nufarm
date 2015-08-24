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
	}

 ?>