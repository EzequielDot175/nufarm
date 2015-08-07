<?php 
	/**
	* 
	*/
	class DB extends PDO implements DB
	{
		private $dbname = "nmaxx_develop";
		private $dbuser = "nmaxx_pnufarm";
		private $dbpass = "K[^Xc0lsU1T(";

		public function __construct()
		{
			parent::__construct('mysql:host=localhost;dbname='.$this->dbname, $this->dbuser, $this->dbpass);
			parent::setFetchMode(PDO::FETCH_OBJ);
		}

		/**
		 * @internal Method: Trae los atributos definidos por la clase que no esten vacios y sean publicos
		 */

		private function getAttributes(){
			$attributes = new ReflectionClass($this);
	 		$attr = $attributes->getProperties(ReflectionProperty::IS_PUBLIC);
	 		$props = [];
	 		foreach ($attr as $key => $value) {
	 			$props[$value->name] = $this->{$value->name};
	 		}
	 		return $props;
		}

		public function select(){
			$all = $this->prepare(self::ALL);
			$all->bindParam(':table',$this->table,PDO::PARAM_STR);
		}

	}
 ?>