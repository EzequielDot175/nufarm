<?php 
	/**
	* @internal Utils
	*/
	class Utils
	{
		
		public function __construct()
		{

		}


		/**
		 * Si existe el indice en la variable post se ejecuta el callback
		 */
		public static function POST($var,$callback){
			if(isset($_POST[$var])):
				call_user_func($callback);			
			endif;
		}


	}

 ?>