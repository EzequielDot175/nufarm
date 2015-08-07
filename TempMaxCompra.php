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
			$this->verify($this->user);
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
			/**
			 * @internal  verifico si el producto existe en la tabla tempmaxcompra, sino, lo creo
			 */
			$this->haveProductHistory($this->user,$this->prod);
			$have = $this->prepare(self::MAXCOMPRA_HAVELIMITCOMPRA);
			$have->bindParam(':user',$this->user, PDO::PARAM_INT);
			$have->bindParam(':prod',$this->prod, PDO::PARAM_INT);
			$have->execute();
			$result = $have->fetch(PDO::FETCH_OBJ);
			
			if(is_null($result->cant)):
				$this->verifyProd($this->user,$this->prod);
			elseif(is_numeric($result->cant)):
				$this->verifyProdInt($this->user,$this->prod);
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

			if($result->cant != 0 && !is_null($result->cant) ):
				return $result->max;
			else:
				return 'notlimit';
			endif;
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
		 * @todo  Metodo para sumar cantidad de productos pedidos por el usuario
		 */
		public function storeSum($prod,$cant){
			$upd = $this->prepare(self::MAXCOMPRA_STORESUM);
			$upd->bindParam(':used',$cant,PDO::PARAM_INT);
			$upd->bindParam(':prod',$prod,PDO::PARAM_INT);
			$upd->bindParam(':user',$this->user,PDO::PARAM_INT);
			$upd->execute();
		}
		/**
		* @todo Metodo que hace exactamente lo contrario a storeSum, resta cantidades agregadas a la cantidad de compra total
		* @param id_carrito
		*/	
		public function storeRemains($carr){
			$data = $this->storeData($carr);
			$upd = $this->prepare(self::MAXCOMPRA_STOREMAINS);
			$upd->bindParam(':used',$data->intCantidad,PDO::PARAM_INT);
			$upd->bindParam(':prod',$data->idProducto,PDO::PARAM_INT);
			$upd->bindParam(':user',$data->idUsuario,PDO::PARAM_INT);
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
			$user = $this->user;
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
		 * @internal metodo que verifica el limite del producto distinto de null,
		 * si es distinto de null este verifica que el limite numerico corresponda
		 * al actual de la base de datos, manteniendo los limites de compra en todo momento
		 */
		private function verifyProdInt($user,$prod){

			$result = $this->prepare(self::MAXCOMPRA_VERIFYCURRENTLIMIT);
			$result->bindParam(':prod',$prod,PDO::PARAM_INT);
			$result->bindParam(':user',$user,PDO::PARAM_INT);
			$result->execute();

			if ( !(Boolean)$result->fetch(PDO::FETCH_OBJ)->result ) {
				$update = $this->prepare(self::MAXCOMPRA_UPDATELIMITFROMPROD);
				$update->bindParam(':prod',$prod,PDO::PARAM_INT);
				$update->bindParam(':user',$user,PDO::PARAM_INT);
				$update->execute();
			}
		}
		/**
		* @todo Metodo para iniciar @param user id y @param producto id
		*/
		private function setInitsData(){
			$this->user = self::session('MM_IdUsuario');
			$this->prod = (isset($_GET['recordID']) ? $_GET['recordID'] : '');
		}
		/**
		 * @todo Es posible que si el producto no exista en el registro de la tabla,
		 * se produsca un error, por ello, este metodo comprueba que exista el producto,
		 * y si no existe lo setea.
		 */
		private function haveProductHistory($user,$prod){
			$exist = $this->prepare(self::MAXCOMPRA_PRODUCTROWEXIST);
			$exist->bindParam(':prod',$prod,PDO::PARAM_INT);
			$exist->bindParam(':user',$user,PDO::PARAM_INT);
			$exist->execute();
			$exist = ($exist->fetch(PDO::FETCH_OBJ)->result > 0 ? true : false);
			if(!$exist):
				$insert = $this->prepare(self::MAXCOMPRA_INSERTFROMPROD);
				$insert->bindParam(':prod',$prod,PDO::PARAM_INT);
				$insert->bindParam(':user',$user,PDO::PARAM_INT);
				$insert->execute();
			endif;
		}

		/**
		 * @internal obtiene datos del carrito id dado
		 * @param carrito id
		 */
		private function storeData($carr){
			$sel = $this->prepare(self::CARRITO_BYID);
			$sel->bindParam(':id',$carr,PDO::PARAM_INT);
			$sel->execute();
			return $sel->fetch(PDO::FETCH_OBJ);
		}

		/**
		========= END PRIVATE METHODS =========
		*/



	}


 ?>