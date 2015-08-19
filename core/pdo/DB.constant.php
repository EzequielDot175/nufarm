<?php 
	/**
	* 
	*/
	class DB extends PDO implements DBInterface
	{
		private $dbname = "nmaxx_develop";
		private $dbuser = "nmaxx_pnufarm";
		private $dbpass = "K[^Xc0lsU1T(";
		

		public function __construct()
		{
			parent::__construct('mysql:host=localhost;dbname='.$this->dbname, $this->dbuser, $this->dbpass,array(
			    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
			  ));
			// parent::setFetchMode(PDO::FETCH_OBJ);
			$this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		}

		/**
		 * @internal Method: Trae los atributos definidos por la clase que no esten vacios y sean publicos
		 */

		protected function getAttributes(){
			$attributes = new ReflectionClass($this);
	 		$attr = $attributes->getProperties(ReflectionProperty::IS_PUBLIC);
	 		$props = [];
	 		foreach ($attr as $key => $value) {
	 			$props[$value->name] = $this->{$value->name};
	 		}
	 		return $props;
		}

		protected function select(){
			$all = $this->prepare(self::QUERY_ALL_TABLE);
			$all->bindParam(':tb',$this->table,PDO::PARAM_STR);
			$all->execute();
			return $all->fetchAll();
		}

		/**
		 * @return: Devuelve un resultado
		 */
		protected function getRow($sql){
			$sel = $this->prepare($sql)->execute()->fetch();
		}
		/**
		 * @return: Devuelve todos los resultados
		 */
		protected function getRows($sql){
			$sel = $this->prepare($sql);
			$sel->execute();
			return $sel->fetchAll();
		}

		protected function result($sql){
			return $this->query($sql)->fetchAll(PDO::FETCH_OBJ);
		}
		/**
		* @param sql string
		* @return SQL result (one)
		*/
		protected function get($sql){
			return $this->query($sql)->fetch(PDO::FETCH_OBJ);
		}



	}
 ?>