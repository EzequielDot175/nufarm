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
	}
 ?>