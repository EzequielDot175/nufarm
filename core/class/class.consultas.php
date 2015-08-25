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

		public function consultaByAuth(){
			$id = Auth::id();
			$sel = $this->prepare(self::CONSULTA_GET);
			$sel->bindParam(':id', $this->auth, PDO::PARAM_INT );
			$sel->execute();
			return $sel->fetchAll();
		}

		public function respuestas(){
			
		}

		public function lastConsulta(){
			$sel = $this->prepare(self::CONSULTA_LAST);
			$sel->bindParam(':id',$this->auth, PDO::PARAM_INT);
			$sel->execute();
			return $sel->fetch();
		}

		public static function last(){
			return self::method('lastConsulta');
		}

		public function all(){

		}
	}

 ?>