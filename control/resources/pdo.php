<?php
/**
 * 
 */
 class DBModel 
 {
 	protected $host = "localhost";
	protected $password = "K[^Xc0lsU1T(";
	protected $user = "nmaxx_pnufarm";
	protected $database = "nmaxx_develop";  
 	protected $db;
 	
 	public function __construct()
 	{
 		$this->db = new PDO('mysql:host=localhost;dbname='.$this->database, $this->user, $this->password);
 	}
 
 	public function query($sql){
 		$row = $this->db->query($sql);
 		return $row->fetchAll();
 	}
 	public function exist($array = array()){
 		$sql = "SELECT ".$array[0]." FROM ".$this->table." WHERE ".$array[0]." = ".$array[1];
 		$exec = $this->db->query($sql)->rowCount();
 		return ($exec > 0 ? true : false);
 	}

 	public function attributes($id = null){
 		$attributes = new ReflectionClass($this);
 		$attr = $attributes->getProperties(ReflectionProperty::IS_PUBLIC);
 		$props = [];
 		foreach ($attr as $key => $value) {
 			$props[$value->name] = $this->{$value->name};
 		}
 		return $props;
 	}
 	public function insert(){
 		$sql = "INSERT INTO ".$this->table;
 		$columns = " (";
 		$i= 0;
 		foreach ($this->attributes() as $k => $v) {
 			if ($i == 0) {
 				$columns .= $k;
 				$i++;
 			}else{
 				$columns .= ",".$k;
 			}
 		}
 		$columns .= ")";
		$values = "(";
		$i = 0;

		foreach ($this->attributes() as $k => $v) {
 			if ($i == 0) {
 				$values .= "'".$v."'";
 				$i++;
 			}else{
 				$values .= ", '".$v."' ";
 			}
 		}
 		$values .= ")";

 		$sql .= $columns." VALUES ".$values;
 		$exec = $this->db->exec($sql);
 		return ($exec > 0 ? true : false);
 	}
 	public function update($array){
 		$sql = "UPDATE ".$this->table." SET ";
 		$i = 0;
 		foreach ($this->attributes() as $k => $v) {
 			if ($i == 0) {
 				$sql .= $k." = '".$v."'";
 				$i++;
 			}else{
 				$sql .= ",".$k." = '".$v."'";
 			}
 		}
 		$sql .= " WHERE ".$array[0]." ".$array[1]." '".$array[2]."'";
 		$exec = $this->db->exec($sql);
 		return ($exec > 0 ? true : false);
 	}
 	public function select($array){
 		$sql = "SELECT * FROM ".$this->table." WHERE ".$array[0]." ".$array[1]." '".$array[2]."'";
 		$result = $this->db->query($sql)->fetchAll();
 		return $result[0];
 	}

 }
 

 ?>