<?php 
	namespace core;
	/**
	* Class: UPLOAD
	*/
	class Upload
	{
		public static $dir = "";
		public static $name = "";
		public static $randomName = false;

		/**
		 * Sugerencias de direcciones $dir
		 */
		public static $DIR_IMG_PROD;
		// const DIR_IMG_PROD = APP_DIR."/images_productos";
		
		const JPG = "image/jpeg";
		const PNG = "image/png";
		const GIF = "image/gif";


		public function __construct($index = null)
		{
			self::$DIR_IMG_PROD = APP_DIR."/images_productos";
		}


		public function uploadFile($file = null){
			$type = self::type($file['type']);
			if($type):
				$name = (self::$randomName ? $this->random() : self::$name);
				$move = (move_uploaded_file($tmp, self::$dir."/".$name.".".$type) ? true : false);
				if($move):
					// return throw new Exception("Error Processing Request", 1);
					return true;			
				else:
					 throw new Exception("Error, no se pudo guardar la imagen en destino indicado", 1);
				endif;
			else:
				 throw new Exception("Error Processing Request", 1);
			endif;
		}

		public static function ifExist($param, $callback, $else = null){
			if(isset($_FILES[$param])):
				$nameClass = __CLASS__;
				$class = new $nameClass();
				call_user_func($callback, $class);
			else:
				if(!is_null($else)):
					call_user_func($else);				
				endif;
			endif;
		}

		public static function file($param){
			return (isset($_FILES[$param]) ? $_FILES[$param] : null);
		}



		public static function type($type){
			switch ($type):
					case self::JPG:
							return 'jpg';
						break;
					case self::PNG:
							return 'png';
						break;
					case self::GIF:
							return 'gif';
						break;
					
					default:
						return false;
						break;
				endswitch;	
		}

	}

 ?>