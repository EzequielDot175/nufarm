<?php 
	/**
	* TempMaxCompra
	*
	* @author     Ezequiel Romero
	* @version    1.0
	* ...
	*/
	/**
	* Controlador de compra max de productos
	*/
	class TempMaxCompra extends PDOConfig implements SqlConstant
	{	
		/**
		* @todo trait de constantes
		*/

		use Helpers;


		private $user;
		private $prod;


		public function __construct()
		{
			parent::__construct();
			$this->setInitsData();
		}

		/**
		* @todo INICIAL
		*/
		public function init(){
			$this->start();
			$this->getMax();
			$this->verify(self::session('logged_id'));
		}
		/**
		========= PUBLIC METHODS =========
		*/

		/**
		* @todo Metodo que verifica si el usuario tiene limite para este producto,
		* si el usuario no tiene limite,
		* vuelve a verificar en la base de datos para evitar la desactualizacion
		*/
		public function haveMaxCompra(){
			$have = $this->prepare(self::MAXCOMPRA_HAVELIMITCOMPRA);
			$have->bindParam(':user',$this->user, PDO::PARAM_INT);
			$have->bindParam(':prod',$this->prod, PDO::PARAM_INT);
			$have->execute();
			$result = $have->fetch(PDO::FETCH_OBJ);
			if(is_null($result->cant)):
				$this->verifyProd($user,$prod);
			endif;
		}
		/**
		* @todo Metodo para obtener el maximo de compra en ver productos
		*/
		public function getMaxCompra($prod){
			$max = $this->prepare(self::MAXCOMPRA_GETMAXCOMPRA);
			$max->bindParam(':user',$this->user, PDO::PARAM_INT);
			$max->bindParam(':prod',(!empty($this->prod) ? $this->prod : $prod ), PDO::PARAM_INT);
			$max->execute();
			$result = $max->fetch(PDO::FETCH_OBJ);
			return $result->cant;
		}
		/**
		* @todo Metodo para setear la nueva cantidad del producto por usuario
		*/
		public function updateMaxCompra($prod,$cant){
			$upd = $this->prepare(self::MAXCOMPRA_UPDATEMAXCOMPRA);
			$upd->bindParam(':cant',$cant,PDO::PARAM_INT);
			$upd->bindParam(':prod',$prod,PDO::PARAM_INT);
			$upd->bindParam(':user',$this->user,PDO::PARAM_INT);
			$upd->execute();
		}





		/**
		========= PRIVATE METHODS =========
		*/

		/**
		* @internal Provee de session si este no esta inicializado
		*/
		private function start(){
			if(!isset($_SESSION)):
				session_start();
			endif;
		}

		/**
		* @internal Trae los maximos de cada producto en la base de datos siempre y cuando tengan stock
		*/
		private function getMax(){
			return $this->result(self::MAXCOMPRA_ALL);
		}
		/**
		* @internal Comprueba si tiene o no un registro guardado en la tabla
		*/
		private function verify($id){
			$verify = (		$this->get(self::MAXCOMPRA_VERIFY.$id)->sum > 0 ? true : false	);
			if(!$verify):
				$this->set($id);
			endif;
		}
		/**
		* @internal setea el registro del usuario
		*/
		private function set($id){
			$collection = $this->getMax();
			$insert = self::MAXCOMPRA_INSERT;
			$values = $this->formatInit($collection);
			$this->exec($insert.$values);
		}

		/**
		* @param array from collection max int prod
		* @internal formatea los values
		*/
		private function formatInit($array){
			$values = "";
			$user = self::session('logged_id');
			$i = 0;
			foreach($array as $k => $v):
				if($i == 0):
					$values .= "(".$user.",".$v->id.",".(is_null($v->max) ? "NULL" : $v->max).")";
					$i++;
				else:
					$values .= ",(".$user.",".$v->id.",".(is_null($v->max) ? "NULL" : $v->max).")";
				endif;
			endforeach;
			return $values;
		}

		/**
		* @internal si el limite actual es null,
		* consulta nuevamente el limite del producto,
		* si es distinto de null lo actualiza para que el usuario
		* no tenga compras infinitas
		*/
		private function verifyProd($user,$prod){
			$limit = $this->prepare(self::MAXCOMPRA_LIMITBYPROD);
			$limit->bindParam(':prod',$prod);
			$limit->execute();
			$result = $limit->fetch(PDO::FETCH_OBJ);

			if(!is_null($result->result)):
				$newLimit = $this->prepare(self::MAXCOMPRA_UPDATELIMIT);
				$newLimit->bindParam(':cant',$result->result,PDO::PARAM_INT);
				$newLimit->bindParam(':user',$user,PDO::PARAM_INT);
				$newLimit->bindParam(':prod',$prod,PDO::PARAM_INT);
				$newLimit->execute();
			endif;
		}
		/**
		* @todo Metodo para iniciar @param user id y @param producto id
		*/
		private function setInitsData(){
			$this->user = self::session('logged_id');
			$this->prod = (isset($_GET['recordID']) ? $_GET['recordID'] : '');
		}


		/**
		========= END PRIVATE METHODS =========
		*/



	}


 ?>