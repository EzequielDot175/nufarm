<?php 
	/**
	* @internal [<description>]
	*/
	class VendedorEstrella extends DB
	{
		
		public function __construct()
		{
			parent::__construct();
		}

		// public function byDate

		public function getByVendedor($id,$date){

		}

		public function getByCliente($id,$date){

		}


		private static function isGold($num) {
			switch ($num) {
				case '1':
					return 'NUFARM MAXX GOLD';
					break;
				case '0':
					return 'NUFARM MAXX';
					break;
				
				default:
					return '';
					break;
			}
		}
	}
 ?>