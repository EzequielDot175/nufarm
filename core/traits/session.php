<?php 
	/**
			* @abstract Esta clase supone reemplazar los sql escritos por todo el sitio, definidos como constantes
			*/
			trait Helpers{

				public static function session($param){
					return $_SESSION[$param];
				}
			// public static function getPost()

			}
			

 ?>