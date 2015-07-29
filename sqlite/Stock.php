<?php 
	
	/**
	* 
	*/
	class Stock extends PDO
	{
		public function __construct()
		{
			parent::__construct('sqlite:stocks');
		}

		public function set(){
			$x = $this->query("SELECT * FROM temp");
			var_dump($x);
		}
		public function touch($id){
			
		}
	}


 ?>