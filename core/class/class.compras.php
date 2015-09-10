<?php 

	/**
	* @internal Clase que controla las compras
	*/

if(!class_exists('compra')):


	class Compra extends DB
	{
		use Facade;
		
		public function __construct()
		{
			parent::__construct();

			/**
			 * @param [INT] $[limit] [LIMIT {n}]
			 */
			$this->limit = 25;
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

		public function allCompras(){
			$compras = array();
			$collection = $this->query(self::COMPRA_ALL.$this->orderBy().$this->paginator())->fetchAll();

			foreach($collection as $key => $val):
				$compras[$val->id_compra][] = $val;
			endforeach;

			return array_reverse($compras);
		}

		public function paginator(){
			
			if(isset($_GET['page'])):
				$page = ( $_GET['page'] > 1 ? $_GET['page'] : 0);
				return ' LIMIT '.$this->limit*$page.','.$this->limit;
			else:
				return ' LIMIT 0,'.$this->limit;
			endif;
		}

		public function barPag(){
			$paginas = ($this->cantidad() / $this->limit);
			return round($paginas);

		}

		public function cantidad(){
			return $this->query(self::COMPRA_COUNT)->fetch()->count;
		}

		public function estados(){
			return array(
            	'1' =>  'PEDIDO REALIZADO',
            	'2' =>  'PEDIDO EN PROCESO',
            	'3' =>  'PEDIDO ENVIADO',
            	'4' =>  'PEDIDO ENTREGADO'
			);
		}

		public function orderBy(){
			return " ORDER BY idCompra DESC ";
		}

		public static function all(){
			return self::method('allCompras');
		}

		public static function optionsEstado($selected = null){
			$array = self::method('estados');
			$html = "";
			foreach($array as $key => $val):
				if(!is_null($selected)):
					if($selected == $key):
						$html .= '<option selected="" value="'.$key.'">'.$val.'</option>';
					else:
						$html .= '<option value="'.$key.'">'.$val.'</option>';
					endif;
				else:
					$html .= '<option value="'.$key.'">'.$val.'</option>';
				endif;
			endforeach;
			echo($html);
		}

		public static function sBarPag(){
			return self::method('barPag');
		}


	}


endif;

if(!class_exists('DetalleCompra')):


	/**
	 * @internal Clase controladora de los items individuales por compra
	 */
	class DetalleCompra extends DB{

		use Facade;


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

				@header('location: v_compras.php?activo=1&sub=c');
				exit();
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


		public function updEstado($params){
			$estado = (int)$params->estado;
			$id = (int)$params->id;
			$remito = (int)$params->remito;
			$upd = $this->prepare(self::DTCOMPRA_UPDESTADO);
			$upd->bindParam(':estado', $estado);
			$upd->bindParam(':remito', $remito);
			$upd->bindParam(':dtid', $id);
			$upd->execute();
			return $upd->execute();
		}

		public static function upd($estado,$id,$remito){


			$params = new stdClass();
			$params->{'remito'} = $remito;
			$params->{'estado'} = $estado;
			$params->{'id'} = $id;
			return self::method('updEstado',$params);
		}
	}

endif;

 ?>