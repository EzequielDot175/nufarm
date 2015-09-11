<?php 
	/**
	* @internal Clase controladora de usuario
	*/
	class Usuario extends DB
	{
		use Facade;

		public $error = "";
		private $limit;
		private $offset;
		
		public function __construct()
		{
			parent::__construct();
		}



		/**
		 * @param num
		 * @param user
		 * Suma al monto actual
		 */
		public function sumarCredito($num,$user){
			$upd = $this->prepare(self::USUARIO_SUMCREDITO);
			$upd->bindParam(':num',$num, PDO::PARAM_INT);
			$upd->bindParam(':user',$user, PDO::PARAM_INT);
			if(!$upd->execute()):
				throw new PDOException("Error, setCredito", 1);
			endif;
		}

		public function getAll($page = 0,$limit = 20){
			$page = (isset($_GET['page']) && !empty($_GET['page']) ? $_GET['page'] : 0);
			$offset = ($page != 1 && $page != 0 ? $page*$limit : 0);

			$this->limit = $limit;
			$this->offset = $offset;

			$sel = $this->prepare(self::USUARIO_ALL);
			$sel->bindParam(':lim', $limit, PDO::PARAM_INT);
			$sel->bindParam(':off', $offset, PDO::PARAM_INT);
			$sel->execute();

			return $sel->fetchAll(); 
			
		}

		public function byId($id){
			$sel = $this->prepare(self::USUARIO_BY_ID);
			$sel->bindParam(':id', $id, PDO::PARAM_INT);
			$sel->execute();
			return $sel->fetchAll();
		}

		private static function formatBirthDay($collection){

			if(!empty($collection['cumpleanos'])):
				preg_match('/([0-9].*\/[0-9].*\/[0-9].*[0-9])/', $collection['cumpleanos'],$matches);
				$date = array_pop($matches);
				$data = str_replace('/', '-', $date);
				try {
					$newDate = new DateTime($data);
					$newDate = $newDate->format('Y-m-d');
					return $newDate;
				} catch (Exception $e) {
					return '';
				}
			endif;
			
		}

		public function edit($collection){
			$collection['cumpleanos'] = self::formatBirthDay($collection);
			$query = "UPDATE usuarios ";
			$i     = 0; 
			foreach($collection as $key => $val):
				if(!empty($val)):
					if($i == 0):
						$query .= "SET ".$key." = '".$val."'";
						$i++;
					else:
						$query .= ",".$key." = '".$val."'";
					endif;
				endif;
			endforeach;
			$query .= " WHERE idUsuario = :id";

			
			$id = Auth::id();
			$upd = $this->prepare($query);
			$upd->bindParam(':id', $id, PDO::PARAM_INT);
		
			try {
				$upd->execute();
			} catch (Exception $e) {
				$this->error = "Error al actualizar el usuario";
			}
		}


		public function updateDblConsumido(){
			$id = Auth::id();
			$upd = $this->prepare(self::USUARIO_SUM_DBLCONSUMIDO_FROM_SHOP);
			$upd->bindParam(':id',$id,PDO::PARAM_INT);
			$upd->execute();
		}
		public function setLimit(int $limit){
			$this->limit = $limit;
		}

		public function byFilter(){
			if(empty($_POST['vendedor']) && !empty($_POST['cliente'])):
				return $this->filterByVendedor($_POST['vendedor']);
			elseif(!empty($_POST['vendedor']) && empty($_POST['cliente'])):
				return $this->filterByCliente($_POST['cliente']);
			else:
				return $this->getAll();
			endif;
		}

		public function filterByVendedor(int $id){
			$sel = $this->prepare(self::USUARIOS_BY_VENDEDOR);
			$sel->bindParam(':id', $id, PDO::PARAM_INT);
			$sel->execute();

			return $sel->fetchAll();
		}

		public function filterByCliente(int $id){
			$sel = $this->prepare(self::USUARIOS_BY_CLIENTE);
			$sel->bindParam(':id', $id, PDO::PARAM_INT);
			$sel->execute();

			return $sel->fetchAll();
		}

		public function getPages(){

			$sel = $this->prepare(self::USUARIO_PAGES);
			$sel->bindParam(':lim', $this->limit);
			$sel->execute();

			return $sel->fetch()->pages;
		}

		public static function all($page = 0, $limit = 20){
			return self::method('getAll',$page,$limit);
		}

		public static function sumConsumido(){
			return self::method('updateDblConsumido');
		}

		public static function getById($id){
			return self::method('byId', $id);
		}

		public static function pages(){
			return self::method('getPages');
		}

	}
 ?>