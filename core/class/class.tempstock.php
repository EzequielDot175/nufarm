<?php 
	// require_once(dirname(__FILE__).'/control/resources/pdo.php');

	class TempStock extends PDO
	{
		private $table = "stock";
		private $dbname = "nmaxx_develop";
		private $dbuser = "nmaxx_pnufarm";
		private $dbpass = "K[^Xc0lsU1T(";

		public function __construct(){
			parent::__construct('mysql:host=localhost;dbname='.$this->dbname, $this->dbuser, $this->dbpass);
		}
		
		public function setTalles($prod, $talles, $user){
			$insert_stock = "INSERT INTO stock (id_product,id_talle,cantidad,requiere_talle,date,id_user) VALUES ";
			$i = 0;
			$time = date('Y-m-d H:i:s');
			$talles_update = array();
			$total = 0;
			
			foreach($talles as $k => $v):
				if ($v > 0) {
					if ($i == 0) {
						$insert_stock .= "(".$prod.", ".$k.",".$v.", 1 , '".$time."' , ".$user.")";
						$talles_update[] = $this->updateTal($v,$prod,$k);
						$total += $v;
						$i++;
					}else{
						$insert_stock .= ",(".$prod.", ".$k.",".$v.", 1 , '".$time."' , ".$user.")";
						$total += $v;
						$talles_update[] = $this->updateTal($v,$prod,$k);
					}
				}
			endforeach;

			// $stockGeneral = ;

			if ($this->updateStockProd($total,$prod)) {
				$this->exec($insert_stock);
				foreach($talles_update as $k => $v):
					$this->exec($v);
				endforeach;
			}
		}
		public function setTallesColores($prod, $pedido, $user){
			
			$sql =	"INSERT INTO ".$this->table." (id_user,id_product,id_color,id_talle,cantidad,requiere_talle,date) VALUES ";
			$values = "";
			$time = date('Y-m-d H:i:s');
			$updates = array();
			$total = 0;
			
			// create history stock

			foreach($pedido as $k => $v):
					$value = "";
						foreach($v['talle'] as $kt => $vt):
							if ((int)$vt > 0):
								if ($i == 0):
									$sql .= "(".$user.",".$prod.",".$k.",".$kt.",".$vt.",3,'".$time."')";
									$total += $vt;
									$updates[] = $this->updateStockColorTalle($prod,$k,$kt,$vt);
									$i++;
								else:
									$sql .= ",(".$user.",".$prod.",".$k.",".$kt.",".$vt.",3,'".$time."')";
									$updates[] = $this->updateStockColorTalle($prod,$k,$kt,$vt);
									$total += $vt;

								endif;
							endif;
						endforeach;
				
			endforeach;


			
			
			if($this->updateStockProd($total,$prod)):
				if ($this->exec($sql) == 0):
					throw new Exception("Error al iniciar el guardado en stock temporal", 1);
				else:
					foreach($updates as $k => $v):
						if($this->exec($v) == 0):
							throw new Exception("Error al iniciar la actualizacion del stock en talles-colores", 1);
						endif;
					endforeach;
				endif;
			endif;


		}
		public function liberarStockColorTalle($id_carrito, $id_user){
			$carrito = $this->getCarrito($id_carrito);
			$this->updateAllStocksColorTalle($carrito->idProducto,$carrito->talle,$carrito->color,$id_user);
		}

		private function updateAllStocksColorTalle($prod,$talle,$color,$user){

			// stock original
			$intStock = "SELECT intStock FROM productos WHERE idProducto = ".$prod;
			$intStock = $this->result($intStock)->intStock;

			// stock de la tabla stock
			$currStock = "SELECT SUM(cantidad) as sum FROM stock WHERE id_user = ".$user." && requiere_talle = 3 && id_product = ".$prod." && id_talle = ".$talle." && id_color = ".$color;
			$addFromStock = $this->result($currStock)->sum;

			// Tomo la cantidad de stock de stocks y lo adhiero al stock principal del producto
			$newIntStock = $intStock + $addFromStock;
			/**
			* Update
			*/
			$update_producto = "UPDATE productos SET intStock = ".$newIntStock." WHERE idProducto = ".$prod;


			/**=====**/
			// stock de la tabla stock
			$stockTalleColor = "SELECT SUM(cantidad) as sum FROM stock WHERE id_user = ".$user." && requiere_talle = 3 && id_product = ".$prod." && id_talle = ".$talle." && id_color = ".$color;
			$stockTalleColor = $this->result($stockTalleColor)->sum;

			// stock original de color_talle
			$stockTalleProd = "SELECT cantidad FROM colores_talles WHERE id_producto = ".$prod." && id_talle = ".$talle." && id_color = ".$color;
			$stockTalleProd = $this->result($stockTalleProd)->cantidad;
			$newStockTalleColor = $stockTalleColor+$stockTalleProd;

			/**
			* Update
			*/

			$update_talleColor = "UPDATE colores_talles SET cantidad = ".$newStockTalleColor." WHERE id_producto = ".$prod." && id_talle = ".$talle." && id_color = ".$color;
			
			/**
			* Delete
			*/

			$delete_talle_stock = "DELETE FROM stock WHERE id_product = ".$prod." && id_talle = ".$talle." && id_user = ".$user." && id_color = ".$color;

			if(!$this->toBoolean($this->exec($update_producto))):
				throw new Exception("Error en update de stock del producto", 1);
			else:
				if(!$this->toBoolean($this->exec($update_talleColor))):
					throw new Exception("Error en update de talle", 1);
				else:
					if(!$this->toBoolean($this->exec($delete_talle_stock))):
						throw new Exception("Error en borrado temporal de stock", 1);
					endif;
				endif;
			endif;

		}



		
		public function liberarStockColor($id_carrito,$id_user){
			$carrito = $this->getCarrito($id_carrito);
			$this->updateStockColor($carrito->idProducto,$carrito->color,$id_user);
		}
		private function updateStockColorTalle($prod, $color, $talle, $cant){
			$update_talle_color = "UPDATE colores_talles SET cantidad = cantidad - ".$cant." WHERE id_producto = ".$prod." && id_color = ".$color." && id_talle = ".$talle;

			return $update_talle_color;
		}
		private function result($sql){
			return $this->query($sql)->fetch(PDO::FETCH_OBJ);
		}
		private function updateStockTalle($prod,$talle,$user){

			$intStock = "SELECT intStock FROM productos WHERE idProducto = ".$prod;
			$intStock = $this->result($intStock)->intStock;
			$currStock = "SELECT SUM(cantidad) as sum FROM stock WHERE id_user = ".$user." && requiere_talle = 1 && id_product = ".$prod." && id_talle = ".$talle;
			$addFromStock = $this->result($currStock)->sum;

			// Tomo la cantidad de stock de stocks y lo adhiero al stock principal del producto
			$newIntStock = $intStock + $addFromStock;
			/**
			* Update
			*/
			$update_producto = "UPDATE productos SET intStock = ".$newIntStock." WHERE idProducto = ".$prod;


			/**=====**/

			$stockTalle = "SELECT SUM(cantidad) as sum FROM stock WHERE id_user = ".$user." && requiere_talle = 1 && id_product = ".$prod." && id_talle = ".$talle;
			$stockTalle = $this->result($stockTalle)->sum;

			$stockTalleProd = "SELECT cantidad FROM talles_productos WHERE id_producto = ".$prod." && id_talle = ".$talle;
			$stockTalleProd = $this->result($stockTalleProd)->cantidad;
			$newStockTalle = $stockTalle+$stockTalleProd;

			/**
			* Update
			*/
			$update_talle = "UPDATE talles_productos SET cantidad = ".$newStockTalle." WHERE id_producto = ".$prod." && id_talle = ".$talle;
			
			/**
			* Delete
			*/

			$delete_talle_stock = "DELETE FROM stock WHERE id_product = ".$prod." && id_talle = ".$talle." && id_user = ".$user;

			if(!$this->toBoolean($this->exec($update_producto))):
				throw new Exception("Error en update de stock del producto", 1);
			else:
				if(!$this->toBoolean($this->exec($update_talle))):
					throw new Exception("Error en update de talle", 1);
				else:
					if(!$this->toBoolean($this->exec($delete_talle_stock))):
						throw new Exception("Error en borrado temporal de stock", 1);
					endif;
				endif;
			endif;
		
		}
		public function liberarStockTalle($id_carrito,$user){
			$carrito = $this->getCarrito($id_carrito);
			$this->updateStockTalle($carrito->idProducto,$carrito->talle,$user);
		}
		private function updateStockColor($prod,$color,$user){
			$update_productos = "UPDATE productos SET intStock = intStock + (
					SELECT SUM(cantidad) FROM stock WHERE id_user = ".$user." && requiere_talle = 2 && id_product = ".$prod." && id_color = ".$color." LIMIT 1
					    )
					WHERE idProducto = ".$prod;
			$update_color = "UPDATE colores_productos SET cantidad = cantidad + (
					SELECT SUM(cantidad) FROM stock WHERE id_user = ".$user." && requiere_talle = 2 && id_product = ".$prod." && id_color = ".$color." LIMIT 1
					    )
					WHERE id_producto = ".$prod." && id_color =".$color;
			$delete_color_stock = "DELETE FROM stock WHERE id_product = ".$prod." && id_color =".$color." && id_user = ".$user;
			if ($this->exec($update_productos) == 0) {
				throw new Exception("Error en el update de stock", 1);
			}
			if ($this->exec($update_color) == 0) {
				throw new Exception("Error en el update de color", 1);
			}
			if ($this->exec($delete_color_stock) == 0) {
				throw new Exception("Error en el borrado temporal de stock", 1);
			}
		}
		
		private function getCarrito($id){
			return $this->query("SELECT * FROM carrito WHERE intContador = ".$id)->fetch(PDO::FETCH_OBJ);
		}
		
		private function updateTal($cantidad,$id_prod,$id_talle){
			return "UPDATE talles_productos as tp SET tp.cantidad = tp.cantidad - ".$cantidad." WHERE id_producto = ".$id_prod." && id_talle = ".$id_talle;
		}
		private function updateCol($cantidad,$id_prod,$id_color){
			$sql = "UPDATE colores_productos as cp SET cp.cantidad = cp.cantidad - ".$cantidad." WHERE id_producto = ".$id_prod." && id_color = ".$id_color;

			return $sql;

		}
		private function toBoolean($result){
			return (boolean)$result;
		}
		private function updateStockProd($integer,$id_prod){
			$stock = $sql = "SELECT intStock FROM productos WHERE idProducto = ".$id_prod;
			$stock = $this->query($stock)->fetch(PDO::FETCH_OBJ)->intStock;
			$newStock = $stock - $integer;
			$update = "UPDATE productos as prod SET prod.intStock = ".$newStock." WHERE idProducto = ".$id_prod;


			if($newStock >= 0):
				return $this->toBoolean($this->exec($update));
			else:
				throw new Exception("Ya no hay stock de este producto", 1);
			endif;
		}
		/**
		 * example of basic @ TempStock
		 * @param $userid 
	 	 * @param $idProd 
		 * @param $talle
		 * @param $color 
		 * @param $tipo 
		 * @return nothing on success, throw on error 
		 */
		public function removeTempStock($userid,$idProd,$talle = null ,$color = null,$tipo = null){
			$sql = "DELETE FROM stock WHERE id_product = ".$idProd
			.(!is_null($talle) ? " && id_talle = ".$talle : '')
			.(!is_null($color) ? " && id_color = ".$color : '')
			.(!is_null($tipo) ? " && requiere_talle = ".$tipo : ' requiere_talle = "0" ')
			." && id_user = ".$userid;

			if ($this->exec($sql) == 0) {
				throw new Exception("Error al eliminar stock del producto", 1);
			}
		}
		public function colores($id,$colores){
			$sql =	"INSERT INTO ".$this->table." (id_user,id_product,id_color,cantidad,requiere_talle,date) VALUES ";
			$values = "";
			$i = 0;
			$time = date('Y-m-d H:i:s');
			$updates = array();
			$total = 0;
			
			foreach($colores as $k => $v):
				if ($v > 0) {
					if ($i == 0) {
						$values .= "(".$_SESSION['MM_IdUsuario'].", ".$id.", ".$k.",".$v.",2,'".$time."')";
						$updates[] = $this->updateCol($v,$id,$k);
						$total += $v;
						$i++;
					}else{
						$values .= ",(".$_SESSION['MM_IdUsuario'].", ".$id.", ".$k.",".$v.",2,'".$time."')";
						$total += $v;
						$updates[] = $this->updateCol($v,$id,$k);
					}
				}
			endforeach;

			// create history stock
			$sql = $sql.$values;
		
			
			if (!$this->updateStockProd($total,$id)):
				throw new Exception("Error al crear el stock", 1);
			else:
				if($this->exec($sql) == 0):
					throw new Exception("Error al insertar stock temporal", 1);
				else:
					foreach($updates as $k => $v):
						if($this->exec($v) == 0):
							throw new Exception("Error al actualizar el stock del color", 1);
						endif;
					endforeach;
				endif;
			endif;

		}



		public function setComunes($prod,$cant,$user){
			$values = "";
			$time = date('Y-m-d H:i:s');
			$updates = array();
			$insert_stock =	"INSERT INTO 
						stock (id_user,id_product,cantidad,requiere_talle,date)
					 VALUES 
						(".$user.", ".$prod." , ".$cant." , 0 , '".$time."')";

			$update_stock_prod = "UPDATE productos SET intStock = intStock - ".$cant;
			
			// create history stock


			if ($this->exec($insert_stock) == 0):
				throw new Exception("Error al iniciar el guardado en stock temporal", 1);
			else:
				if ($this->exec($update_stock_prod) == 0):
					throw new Exception("Error al iniciar la actualizacion del stock en productos", 1);
				endif;
			endif;
		}



		public function liberarStockComunes($carritoid, $userid){
			$carrito = "SELECT * FROM carrito WHERE intContador = ".$carritoid;
			$carr = $this->query($carrito)->fetch(PDO::FETCH_OBJ);
			$prod_id = $carr->idProducto;
			
			/**
			*	@query select from stock table
			*/
			$stocks_from_user = "SELECT SUM(cantidad) as sum FROM stock WHERE id_product = ".$prod_id." AND id_user = ".$userid;
			$stocks_from_user = $this->result($stocks_from_user)->sum;
			
			/**
			*	@param query select count 
			*/

			$prodIntStock = $this->query("SELECT intStock FROM productos WHERE idProducto = ".$prod_id)->fetch(PDO::FETCH_OBJ)->intStock;
			$carritoStockSum = $carr->intCantidad;
			
			$resultProdStock = $prodIntStock + $stocks_from_user;

			$update =  "UPDATE productos SET intStock = ".$resultProdStock." WHERE idProducto = ".$prod_id;


			/**
			*	@param query select count 
			*/
			$delete_rows_from_stock = "DELETE FROM stock WHERE id_product = ".$prod_id." && id_user = ".$userid;





			// echo "<pre>";
			// print_r($delete_rows_from_stock);
			// echo "</pre>";
			// die();
			if($resultProdStock >= 0):
				if($this->exec($update) == 0):
					throw new Exception("Error actualizando el stock del producto", 1);
				else:
					$this->exec($delete_rows_from_stock);
				endif;
			endif;
			
			// $update_productos = "UPDATE productos SET intStock = intStock + (
			// 		SELECT SUM(cantidad) FROM stock WHERE id_user = ".$userid." && requiere_talle = 0 && id_product = ".$prod_id." LIMIT 1
			// 		    )
			// 		WHERE idProducto = ".$prod_id;
			// $delete_stock = "DELETE FROM stock WHERE id_product = ".$prod_id." && requiere_talle = 0 && id_user = ".$userid;

			
			// if($this->exec($update_productos) == 0):
			// 	throw new Exception("Error al actualizar el stock del producto", 1);
			// 	if($this->exec($delete_stock) == 0):
			// 		throw new Exception("Error al borrar el stock temporal", 1);
			// 	endif;
			// endif;
		}




		public function fechaVencimiento($user){
			$result = $this->query("SELECT vigencia_credito FROM usuarios WHERE idUsuario = ".$user)->fetch(PDO::FETCH_OBJ)->vigencia_credito;
			$actual = date('Y-m-d');
			$vencimiento = new DateTime($result);
			$vencimiento = $vencimiento->format('Y-m-d');
			return ($vencimiento <  $actual ? true : false);
		}
	}


 ?>