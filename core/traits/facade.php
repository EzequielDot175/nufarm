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

		public static function method($name = null,$arguments = null){
			$class = __CLASS__;
			$instance = new $class();
			if(is_null($name)):
				return $instance;
			else:
				if(is_null($arguments)):
					return $instance->{$name}();			
				else:
					return $instance->{$name}($arguments);			
				endif;
			endif;
		}

		public static function getPost($name){
			return (isset($_POST[$name]) ? $_POST[$name] : '');
		}

		public static function postHas($name){
			return (isset($_POST[$name]) ? true : false);
		}
	}

 ?>