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

		public static function method($name = null){
			$class = __CLASS__;
			$instance = new $class();
			if(is_null($name)):
				return $instance;
			else:
				return $instance->{$name}();			
			endif;
		}
	}

 ?>