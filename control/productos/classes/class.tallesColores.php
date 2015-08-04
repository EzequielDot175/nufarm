<?php
// error_reporting(E_ALL);
// ini_set('display_error', 'on');
	class tallesColores extends PDO
	{
		private $dbname = "nmaxx_develop";
		private $dbuser = "nmaxx_pnufarm";
		private $dbpass = "K[^Xc0lsU1T(";
		private $stockProd = 0;

		public $usuario;
		public $producto;
		public $cantidad;
		public $talle;
		public $color;

		// public from prod
		public $strNombre;
		public $strDetalle;
		public $dblPrecio;
		public $intMinCompra;
		public $intCategoria;
		public $destacado;
		public $idProducto;
		public $intMaxCompra;
		public $intStock;





		public function __construct(){
			parent::__construct('mysql:host=localhost;dbname='.$this->dbname, $this->dbuser, $this->dbpass);
		}

		public function exist($prod,$color){
			$sql = " SELECT COUNT(id) as exist FROM colores_talles WHERE id_producto = ".$prod." && id_color = ".$color;
			$result = $this->query($sql)->fetch(PDO::FETCH_OBJ);
			return ($result->exist > 0 ? true : false);
		}
		public function update($prod, $color, $val){
			$sql = "";
			$i = 0;
			foreach($val as $k => $v):
				if($v > 0):
				$sql .= "UPDATE colores_talles SET cantidad = ".(int)$v." WHERE id_producto = ".$prod." && id_color = ".$color." && id_talle = ".$k.";";
				endif;
			endforeach;
			return true;
		}
		public function all($prod = null){
			if(is_null($prod)):
				$result = $this->query("SELECT * FROM colores_talles")->fetchAll(PDO::FETCH_OBJ);
			else:
				$result = $this->query("SELECT * FROM colores_talles WHERE id_producto = ".$prod)->fetchAll(PDO::FETCH_OBJ);
				
			endif;
			$array = array();
			foreach($result as $k => $v):
				$array[$v->id_color]['talle'][$v->id_talle] = $v->cantidad;
			endforeach;
			return $array;
		}
		public function execProdStock($id_prod){
			$sql = "UPDATE productos SET intStock = ".$this->stockProd." WHERE idProducto = ".$id_prod;

			$this->query($sql);
			
		}
		private function setStock($talles,$id_prod){
			foreach($talles as $k => $v):
				$this->stockProd += (int)$v;
			endforeach;


		}
		public function delete($prod,$color = null){

			if(!is_null($color)):
				$select = "SELECT COUNT(id) as cant FROM colores_talles WHERE id_color = ".$color." && id_producto = ".$prod;
				$select = $this->query($select)->fetch(PDO::FETCH_OBJ)->cant;
				$sql = "DELETE FROM colores_talles WHERE id_producto = ".$prod." && id_color = ".$color;
				if($select > 0):
					var_dump($this->exec($sql));
				endif;
			endif;
		}
		public function talles(){
			$format = array();
			$var = $this->query("SELECT * FROM talles")->fetchAll(PDO::FETCH_OBJ);
			foreach($var as $k => $v):
				$format[$v->id_talle] = $v->nombre_talle;
			endforeach;
			return $format;
		}
		public function colores(){
			$format = array();
			$var = $this->query("SELECT * FROM colores")->fetchAll(PDO::FETCH_OBJ);
			foreach($var as $k => $v):
				$format[$v->id_color] = $v->nombre_color;
			endforeach;
			return $format;
		}
		public function setEnabled($count){
			echo ($count > 0 ? '' : 'disabled=""');
		}
		public function setClassEnabled($count){
			echo ($count > 0 ? '' : 'box-disabled');
		}
		public function insert(){
			
			$sql = "INSERT INTO carrito (idUsuario,idProducto,intCantidad,talle,color) VALUES (".$this->usuario.", ".$this->producto." , ".$this->cantidad." , ".$this->talle." , ".$this->color.")";

			$this->exec($sql);

		}
		public function add($val,$prod,$color){
			$sql = "INSERT INTO colores_talles (id_producto,id_color,id_talle,cantidad) VALUES ";
			$i = 0;
			if(!$this->exist($prod,$color)):
				foreach($val['talle'] as $k => $v):
					if ($i == 0) {
						$sql .= "(".$prod.", ".$color.",".$k.",".(int)$v.")";
						$i++;
					}else{
						$sql .= ",(".$prod.", ".$color.",".$k.",".(int)$v.")";
					}
				endforeach;
				$this->setStock($val['talle'],$prod);


				if ($this->exec($sql) == 0):
					throw new Exception("No se puede insertar el nuevo color y talle", 1);
				endif;
			else:
				$this->setStock($val['talle'],$prod);
				if (!$this->update($prod, $color, $val['talle'])) {
					throw new Exception("Error al intentar actualizar los talles", 1);
				}
			endif;
			
		}

		private function attributes(){
			$attr = new ReflectionClass(__CLASS__);
			$attr = $attr->getProperties(ReflectionProperty::IS_PUBLIC);
			$format = new stdClass();
			foreach ($attr as $k => $v) {
				if (!empty($this->{$v->name})) {
				 	$format->{$v->name} = $this->{$v->name};
				 } 
			}

			return $format;
			
		}
		public function save(){
			$sql = "UPDATE productos ";
			$attr = $this->attributes();
			$id = $attr->idProducto;
			unset($attr->idProducto);
			$i = 0;
			foreach ($attr as $k => $v):
				if ($i == 0) {
					$sql .= " SET ".$k." = '".$v."'";
					$i++;
				}else{
					$sql .= ", ".$k." = '".$v."'";
				}
			endforeach;
			
			$sql .= " WHERE idProducto = ".$id;

			$this->exec($sql);
		}

	}

 ?>