<?php 
/**
* 
*/
class PDOConfig extends PDO
{
	private $dbname = "nmaxx_develop";
	private $dbuser = "nmaxx_pnufarm";
	private $dbpass = "K[^Xc0lsU1T(";
		
	function __construct()
	{
		parent::__construct('mysql:host=localhost;dbname='.$this->dbname, $this->dbuser, $this->dbpass);
	}
}


 ?>