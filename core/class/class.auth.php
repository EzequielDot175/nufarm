<?php 
	/**
	* @internal Clase Auth para autenticar la session del usuario
	*/
	class Auth extends DB
	{
		private $id;


		public function __construct()
		{
			parent::__construct();
			self::start();
		}

		public static function start(){
			if(!isset($_SESSION["MM_Username"])):
				session_start();
			endif;
		}	

		public static function check(){
			self::start();

			if(empty($_SESSION["MM_Username"])):
				// Redirect::to('');	
				header('location: login.php');
				exit();
			endif;
		}

		public static function id(){
			return (int)$_SESSION['MM_IdUsuario'];
		}


		public function getUser(){
			$id = self::id();
			$user = $this->prepare(self::AUTH_USER);
			$user->bindParam(':id', $id, PDO::PARAM_INT);
			$user->execute();
			return $user->fetch();
		}

		public static function User(){
			$user = new Auth();
			return $user->getUser();
		}



	}

 ?>