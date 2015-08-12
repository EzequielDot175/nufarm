<?php 
	/**
	* 
	*/



	class PDOConfig extends PDO implements SqlConstant
	{
		private $dbname = "nmaxx_develop";
		private $dbuser = "nmaxx_pnufarm";
		private $dbpass = "K[^Xc0lsU1T(";

		public function __construct()
		{
			parent::__construct('mysql:host=localhost;dbname='.$this->dbname, $this->dbuser, $this->dbpass);
		}

		/**
		* @param sql string
		* @return SQL results (many)
		*/
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