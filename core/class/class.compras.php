<?php 

	/**
	* @internal Clase que controla las compras
	*/

if(!class_exists('compra')):


	class Compra extends DB
	{
		
		public function __construct()
		{
			parent::__construct();
		}
		public function byId(){

		}

		/**
		 * @param :num {Numero del total} 
		 * @param :user {id User} 
		 * @param :id {id compra} 
		 */
		public function setTotal($num, $user, $id){
			$upd = $this->prepare(self::DTCOMPRA_SET_TOTAL);
			$upd->bindParam(':num', $num,PDO::PARAM_INT);
			$upd->bindParam(':user', $user,PDO::PARAM_INT);
			$upd->bindParam(':id', $id,PDO::PARAM_INT);
			if(!$upd->execute()):
				throw new PDOException("Error, setTotal not work", 1);
			endif;
		}

		/**
		 * @internal id : id compra
		 */
		public function delete($id){
			$del = $this->prepare(self::COMPRA_DELETE);
			$del->bindParam(':id', $id, PDO::PARAM_INT);
			if(!$del->execute()):
				throw new PDOException("Error, no se pudo borrar la compra id".$id, 1);
			endif;
		}

		public function isEmpty($id){
			$sel = $this->prepare(self::COMPRA_EMPTY);
			$sel->bindParam(':id', $id, PDO::PARAM_INT);
			$sel->execute();
			return (Boolean)$sel->fetch(PDO::FETCH_OBJ)->empty;
		}
	}


endif;

if(!class_exists('DetalleCompra')):

	/**
	 * @internal Clase controladora de los items individuales por compra
	 */
	class DetalleCompra extends DB{

		public function __construct()
		{
			parent::__construct();
		}

		public function refund($id){
			$compra = new Compra();
			$usuario = new Usuario();
			$stock = new Stock();
			$info = $this->joinCompra($id);
			/**
			 * @internal Resto de la compra
			 * @param num
			 * @param user
			 * @param id
			 */
			$newTotal = $info->total - $info->pagado;
			
			try {
				$compra->setTotal($newTotal, $info->user , $info->compra);
				$usuario->sumarCredito($info->pagado,$info->user);
				$stock->sumStock($info->talle,$info->color,$info->cantidad,$info->producto);
				$this->delete($id);
				if($compra->isEmpty($info->compra)):
					$compra->delete($info->compra);
				endif;

				header('location: '.$_SESSION['last_page']);
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
			

		}

		public function delete($id){
			$del = $this->prepare(self::DTCOMPRA_DELETE);
			$del->bindParam(':id',$id,PDO::PARAM_INT);
			if(!$del->execute()):
				throw new PDOException("Error, no se pudo borrar el detalle de la compra", 1);
			endif;
		}
		public function byId($id){
			$sel = $this->prepare(self::DTCOMPRA_BYID);
			$sel->bindParam(':id',$id,PDO::PARAM_INT);
			$sel->execute();
			return $sel->fetch(PDO::FETCH_OBJ);
		}
		public function joinCompra($id){
			$sel = $this->prepare(self::DTCOMPRA_JOINCOMPRA);
			$sel->bindParam(':id',$id,PDO::PARAM_INT);
			$sel->execute();
			return $sel->fetch(PDO::FETCH_OBJ);
		}
	}

endif;

 ?>