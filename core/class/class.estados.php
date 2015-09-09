<?php 
	/**
	* @internal Clase simple para identificar los estados
	*/
	class Estado 
	{
		
		public function __construct(){}

		public static function get($id){
			$estados = array(
				'REALIZADO',
				'EN PROCESO',
				'ENVIADO',
				'ENTREGADO'
				);
			
			return (isset($estados[$id]) ? $estados[$id] : '');
		}

		public static function optionEstados(){
			$estados = array(
				(Object)array('text' => 'REALIZADO', 'value' => 1),
				(Object)array('text' => 'EN PROCESO', 'value' => 2),
				(Object)array('text' => 'ENVIADO', 'value' => 3),
				(Object)array('text' => 'ENTREGADO', 'value' => 4)
			);

			return json_encode($estados);
		}
	}
 ?>