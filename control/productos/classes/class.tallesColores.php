<?php

	class tallesColores extends PDO
	{
		private $dbname = "nmaxx_productosnufarm";
		private $dbuser = "nmaxx_pnufarm";
		private $dbpass = "K[^Xc0lsU1T(";

		public $usuario;
		public $producto;
		public $cantidad;
		public $talle;
		public $color;



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
				$sql .= "UPDATE colores_talles SET cantidad = ".(int)$v." WHERE id_producto = ".$prod." && id_color = ".$color." && id_talle = ".$k.";";
			endforeach;

			return ($this->exec($sql) > 0 ? true : false );
		}
		public function all(){
			$result = $this->query("SELECT * FROM colores_talles")->fetchAll(PDO::FETCH_OBJ);
			$array = array();
			foreach($result as $k => $v):
				$array[$v->id_color]['talle'][$v->id_talle] = $v->cantidad;
			endforeach;
			return $array;
		}
		private function setStock($talles,$id_prod){
			$i = 0;
			foreach($talles as $k => $v):
				$i += (int)$v;
			endforeach;
			$sql = "UPDATE productos SET intStock = ".$i." WHERE idProducto = ".$id_prod;
			if ($this->exec($sql) == 0) {
				throw new Exception("Error al intentar actualizar stock de producto", 1);
			}
		}
		public function delete($prod,$color){
			$sql = "DELETE FROM colores_talles WHERE id_producto =".$prod." && id_color = ".$color;
			echo($sql);
			// return ($this->exec($sql) > 0 ? true : false );
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

	}

 ?>