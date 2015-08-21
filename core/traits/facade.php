<?php 

	/**
	* @internal Facade: Sirve para llamar clases de forma statica
	*/
	trait Facade
	{
		
		public function __construct()
		{

		}

		public function __call($name,$arguments){
			$this->{$name}($arguments);
		}
	}

 ?>