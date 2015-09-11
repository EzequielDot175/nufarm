<?php 
	
	/**
	* @internal Comentarios del usuario
	*/
	class Consulta extends DB
	{

		/**
		 * Traits
		 */
		use Facade;

		private $auth;

		public function __construct()
		{
			parent::__construct();
			$this->auth = Auth::id();
		}

		/**
		 * @internal public method
		 */
		public function consultaByAuth(){
			$id = Auth::id();
			$sel = $this->prepare(self::CONSULTA_GET);
			$sel->bindParam(':id', $id, PDO::PARAM_INT );
			$sel->execute();

			return $sel->fetchAll();
		}

		public function respuestas($id){
			$sel = $this->prepare(self::CONSULTA_GETRESPONSE);
			$sel->bindParam(':id', $id, PDO::PARAM_INT);
			$sel->execute();
			return $sel->fetch();
		}

		public function create($vars){
			$consulta = (Object)$vars;
			$ins = $this->prepare(self::CONSULTA_NEW);
			$ins->bindParam(':asunto',$consulta->asunto,PDO::PARAM_STR);
			$ins->bindParam(':id',$this->auth,PDO::PARAM_INT);
			$ins->bindParam(':campo',$consulta->descripcion,PDO::PARAM_STR);
			$ins->execute();
		}

		public function getById($id){
			$sel = $this->prepare(self::CONSULTA_BY_ID);
			$sel->bindParam(':id',$id,PDO::PARAM_INT);
			$sel->execute();
			return $sel->fetch();
		}

		public function getAdmin(){
			$consultas = array();
			$sel = $this->query(self::CONSULTA_ALL)->fetchAll();

			foreach($sel as $key => $val):
				if($val->tipo == 1):
					$consultas[$val->idConsulta] = $val;
					$consultas[$val->idConsulta]->{'respuestas'} = array();
				endif;
			endforeach;

			foreach($sel as $key => $val):
				if($val->tipo == 2):
					$consultas[$val->respuesta_de]->{'respuestas'}[] = $val;
				endif;
			endforeach;

			return $consultas;
			
		}

		public function getAdminByVendedor($id,$estado){
			$collection = $this->getAdmin(); 
			$byVendedor = array();

			
			foreach($collection as $key => $val):
			
				if($estado != ""):
					
					if($val->vendedor == $id && $val->respondido == (int)$estado):
						$byVendedor[$key] = $val;
					endif;
				else:
					if($val->vendedor == $id):
						$byVendedor[$key] = $val; 
					endif;
				endif;
			endforeach;


			return $byVendedor;
		}


		public static function formatDate($input){
			$date = new DateTime($input);
			echo $date->format('d/m/Y');
		}

		public static function formatTime($input){
			$date = new DateTime($input);
			echo $date->format('H:i:s');
		}

		/**
		 * @internal public method
		 */

		public function lastConsulta(){

			$sel = $this->prepare(self::CONSULTA_LAST);
			$sel->bindParam(':id',$this->auth, PDO::PARAM_INT);
			$sel->execute();
			return $sel->fetch();
		}

		public function userByConsulta($id){
			$sel = $this->prepare(self::CONSULTA_GET_USER_BY_CONS);
			$sel->bindParam(':id',$id, PDO::PARAM_INT);
			$sel->execute();
			return $sel->fetch();
		}

		public function filtro(){
			if(self::postHas('vendedores') && self::postHas('estado')):

			
				if(empty(self::getPost('vendedores'))):
					return $this->getAdmin();
				else:
					return $this->getAdminByVendedor(self::getPost('vendedores'),self::getPost('estado'));
				endif;
			endif;
		}


		/**
		 * @internal INTERFAZ STATICA
		 */


		/**
		 * @internal public static method from create
		 */
		public static function newConsulta($vars){
			return self::method('create', $vars);
		}
		/**
		 * @internal public static method from lastConsulta
		 */

		public static function all(){
			return self::method('consultaByAuth');
		}
		/**
		 * @internal public static method from lastConsulta
		 */
		public static function respuesta($id){
			return self::method('respuestas',$id);
		}

		/**
		 * @internal public static method from lastConsulta
		 */
		public static function last(){
			return self::method('lastConsulta');
		}
		/**
		 * @internal public static method from lastConsulta
		 */
		public static function getUserByConsulta($id){
			return self::method('userByConsulta', $id);
		}

		/**
		 * @internal public static method from lastConsulta
		 */
		public static function byId($id){
			return self::method('getById', $id);
		}
		
	}

 ?>