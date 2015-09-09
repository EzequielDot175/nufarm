<?php 
	/**
	* @internal Clase controladora de usuario
	*/
	class Usuario extends DB
	{
		use Facade;

		public $error = ""; 
		
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


		public static function getById($id){
			return self::method('byId', $id);
		}
	}
 ?>