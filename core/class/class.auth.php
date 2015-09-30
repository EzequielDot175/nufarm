<?php 
ob_start();
	/**
	* @internal Clase Auth para autenticar la session del usuario
	*/
	class Auth extends DB
	{

		use Facade;



		private $id;


		public function __construct()
		{
			parent::__construct();
			self::start();
		}

		public static function startSession(){
			if(!isset($_SESSION)):
				@session_start();				
			endif;
		}

		public static function start(){
			if(!isset($_SESSION["MM_Username"])):
				@session_start();
			endif;
		}
		public static function startAdmin(){
			if(!isset($_SESSION["logged_id"])):
				@session_start();
			endif;
		}

		public static function check(){
			self::start();

			if(empty($_SESSION["MM_Username"])):
				@header('location: login.php');
				exit();
			endif;
		}

		public static function checkAdmin(){
			self::startAdmin();
			@ob_start();
			if(empty($_SESSION["logged_id"])):
				@header('location: ./');
				exit();
			endif;
		}

		public static function idAdmin(){
			self::startSession();

			return (int)$_SESSION['logged_id'];
		}

		public static function id(){
			self::start();
			return (int) (isset($_SESSION['MM_IdUsuario']) ? $_SESSION['MM_IdUsuario'] : '');
		}


		public function getUser(){
			$id = self::id();
			$user = $this->prepare(self::AUTH_USER);
			$user->bindParam(':id', $id, PDO::PARAM_INT);
			$user->execute();
			return $user->fetch();
		}
		
		public function getUserAdmin(){
			$id = self::idAdmin();
			$user = $this->prepare(self::AUTH_USERADMIN);
			$user->bindParam(':id', $id, PDO::PARAM_INT);
			$user->execute();
			return $user->fetch();
		} 

		public function puntosConsumidos(){
			$id = self::id();
			$sel = $this->prepare(self::AUTH_USEDPOINTS);
			$sel->bindParam(':id', $id, PDO::PARAM_INT);
			$sel->execute();
			return $sel->fetch()->total;
		}


		public static function consumido(){
			return self::method('puntosConsumidos');
		}

		public static function User(){
			$user = new Auth();
			return $user->getUser();
		}

		public static function UserAdmin(){
			return self::method('getUserAdmin'); 
		}

		public static function BirthDay($dat){
			$date = new DateTime($dat);
			return $date->format('d/m/Y');
		}



	}

 ?>