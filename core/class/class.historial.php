<?php 

	/**
	* @internal 
	* Class: Historial
	*/
	class Historial extends DB
	{
		use Facade;

		public function __construct(){
			$this->id = Auth::id();
		}




		public function get($arguments,$other){
			echo($other);
		}
	}

 ?>