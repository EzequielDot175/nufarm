<?php 
	/**
	* @internal Clase controladora de usuario
	*/
	class Usuario extends DB
	{
		
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
	}
 ?>