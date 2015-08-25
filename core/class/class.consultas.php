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
			$sel->bindParam(':id', $this->auth, PDO::PARAM_INT );
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

		/**
		 * @internal public method
		 */

		public function lastConsulta(){
			$sel = $this->prepare(self::CONSULTA_LAST);
			$sel->bindParam(':id',$this->auth, PDO::PARAM_INT);
			$sel->execute();
			return $sel->fetch();
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

		
	}

 ?>