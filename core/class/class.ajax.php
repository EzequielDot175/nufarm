<?php 

	/**
	* 
	*/
	class Ajax
	{
		
		public static function get($param){
			self::{$param}();

			die();
		}

		public static function comboHistorial(){
			echo("asd");
		}

	}


	// Utils::POST('ajax_event',function(){
	// 	Ajax::get($_POST['ajax_event']);
	// });









 ?>